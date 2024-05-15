import $ from 'jquery';

const browseBtn = document.querySelector('#browse-btn');
const dropzone = document.getElementById('dropzone-file');
const inputFile = document.querySelector('#dropzone-file input[type="file"]');
const tableFile = document.querySelector('#table-file table > tbody');
const listFile = document.querySelector('#table-file #list-file');
const rowTableExample = tableFile.querySelector('#row-example');
const rowListExample = listFile.querySelector('#row-example');

window.getAllFile = function getAllFile() {
  const filesEL = [...tableFile.querySelectorAll('[role="file"] input[name="filesId[]"]')].map(el => el.value);
  return filesEL;
}

window.changeDropboxView = () => {
  if (window.innerWidth < 640) return false
  const files = getAllFile();
  if (files.length > 0) return false
  else return true;
}
window.rowFiles = {};

window.onload = () => {
  rowListExample.querySelector('select[name="file_type"]').required = false;
}

function setProgress(parent, isLoad, progress) {
  if (isLoad) {
    parent.querySelector('#delete-btn')?.classList.add('hidden');
    parent.querySelector('#loader')?.classList.remove('hidden');
    if (!progress) return;
    parent.querySelector('#progress')?.classList.remove('hidden');
    const progressBar = parent.querySelector('#progress-bar')
    if (progressBar)
      progressBar.style.width = progress + '%';
  } else {
    parent.querySelector('#delete-btn')?.classList.remove('hidden');
    parent.querySelector('#loader')?.classList.add('hidden');
    parent.querySelector('#progress')?.classList.add('hidden');
  }
}
function attachFile(parent, file, file_types, isList) {
  parent.classList.remove('hidden');
  parent.setAttribute('role', 'file')
  const delBtn = parent.querySelector('#delete-btn')
  if (delBtn)
    delBtn.onclick = () => deleteFile(parent, $dispatch);
  parent.querySelector('select[name="file_type"]').required = true;
  parent.querySelector('#file-name').innerHTML = file.name ?? '';
  parent.querySelector('#file-ext').innerHTML = file.extension ?? '';
  const inputId = parent.querySelector('input[name="filesId[]"]');
  inputId.value = file.id ?? generateRandom(5);
  inputId.disabled = false;
  parent.querySelector('a').href = '/' + file.path;

  const selectFileType = parent.querySelector('select[name="file_type"]');
  file_types.forEach((type) => {
    const option = document.createElement('option');
    option.value = type.id;
    option.innerHTML = (type.required ? '** ' : '') + type.name;
    selectFileType.appendChild(option);
  });
  if (file.file_type_id) selectFileType.value = file.file_type_id;
  if (!isList) {
    rowFiles[inputId.value] = {
      ...rowFiles[inputId.value],
      rowTable: parent,
    }
    selectFileType.onchange = (e) => {
      const selectFileTypeList = rowFiles[inputId.value].rowList.querySelector('select[name="file_type"]');
      selectFileTypeList.value = e.currentTarget.value;
      updateData(inputId.value, e.currentTarget.value)
    }
  }
  else {
    rowFiles[inputId.value] = {
      ...rowFiles[inputId.value],
      rowList: parent,
    }
    selectFileType.onchange = (e) => {
      const selectFileTypeTable = rowFiles[inputId.value].rowTable.querySelector('select[name="file_type"]');
      selectFileTypeTable.value = e.currentTarget.value;
      updateData(inputId.value, e.currentTarget.value)
    }
  }
}
window.getFilesManuscript = ($dispatch, files, file_types, isDraft) => {
  if (!files || !file_types) return;
  files.forEach(file => {
    const rowTable = rowTableExample.cloneNode(true);
    attachFile(rowTable, file, file_types);
    setProgress(rowTable, false);
    tableFile.appendChild(rowTable);

    const rowList = rowListExample.cloneNode(true);
    attachFile(rowList, file, file_types, true);
    setProgress(rowList, false);
    listFile.appendChild(rowList);
  });
  if (!isDraft)
    window.dataForm = window.form?.serialize();
  $dispatch('dropbox')
}
function updateData(fileId, file_type) {
  const selectFileTypeTable = rowFiles[fileId].rowTable;
  const selectFileTypeList = rowFiles[fileId].rowList;
  setProgress(selectFileTypeTable, true);
  setProgress(selectFileTypeList, true);
  $.ajax({
    url: `/files/${fileId}`,
    type: "POST",
    cache: false,
    data: {
      _token: $('meta[name="csrf-token"]').attr("content"),
      _method: "PUT",
      file_type_id: file_type,
    },
    success: function (response) {
      if (!response.success) return;
      selectFileTypeTable.querySelector('select[name="file_type"]').value = response.file.file_type_id;
      selectFileTypeTable.querySelector('input[name="file_type_before"]').value = response.file.file_type_id;
      selectFileTypeList.querySelector('input[name="file_type_before"]').value = response.file.file_type_id;
      setProgress(selectFileTypeTable, false);
      setProgress(selectFileTypeList, false);
      showAlert('success', {
        messages: 'File updated successfully',
        closeable: true,
        timeout: 5000,
      });

      if (document.getElementById('manuscript-id').value)
        window.dataForm = window.form?.serialize();
    },
    error: function (error) {
      setProgress(selectFileTypeTable, false);
      setProgress(selectFileTypeList, false);
      selectFileTypeTable.querySelector('select[name="file_type"]').value = selectFileTypeTable.querySelector('select[name="file_type_before"]').value;
      selectFileTypeList.querySelector('select[name="file_type"]').value = selectFileTypeTable.querySelector('select[name="file_type_before"]').value;
      showAlert('error', {
        messages: 'File update failed',
        closeable: true,
        timeout: 5000,
      });

      $dispatch('dropbox')
    }
  })
}


if (!window.isReview) {
  /// crud file
  function typeValidation(type) {
    if (type == "application/pdf" ||
      type == "application/msword" ||
      type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
      type == "application/rtf") {
      return {
        accept: true,
        isImage: false,
      }
    }
    else if (type == "image/png" || type == "image/jpg" || type == "image/jpeg" || type == "image/gif") {
      return {
        accept: true,
        isImage: true,
      }
    }
    return {
      accept: false,
      isImage: false,
    };
  }
  function uploadFile(file, $dispatch) {
    const rowTable = rowTableExample.cloneNode(true);
    rowTable.classList.remove('hidden');
    rowTable.setAttribute('role', 'file')
    rowTable.querySelector('#file-name').innerHTML = file.name;
    tableFile.appendChild(rowTable);


    const rowList = rowListExample.cloneNode(true);
    rowList.classList.remove('hidden');
    rowList.setAttribute('role', 'file')
    rowList.querySelector('#file-name').innerHTML = file.name;
    listFile.appendChild(rowList);

    const http = new XMLHttpRequest();
    const data = new FormData();
    data.append('file', file);
    data.append('_token', document.head.querySelector('meta[name="_token"]').content);
    $dispatch('dropbox')

    http.onreadystatechange = function () {
      if (this.readyState == XMLHttpRequest.DONE) {
        try {
          const response = JSON.parse(this.response);
          if (!response.success) {
            rowTable.remove();
            rowList.remove();
            const index = [...inputFile.files].findIndex(el => el.name == file.name);
            [...inputFile.files].splice(index, 1);
            $dispatch('dropbox')
            return;
          }
          attachFile(rowTable, response.file, response.file_types);
          attachFile(rowList, response.file, response.file_types, true);
          showAlert('success', {
            messages: 'File uploaded successfully',
            closeable: true,
            timeout: 5000,
          });
        } catch (error) {
          rowTable.remove();
          rowList.remove();
          showAlert('error', {
            messages: 'File upload failed',
            closeable: true,
            timeout: 5000,
          });
        }
        finally {
          $dispatch('dropbox')
          inputFile.value = '';
        }
      }
    }
    http.onload = () => {
      setProgress(rowTable, false, 100);
    }
    http.upload.onprogress = (e) => {
      setProgress(rowTable, true, (e.loaded / e.total) * 100);
    }
    http.open('POST', '/files');
    http.send(data);

  }

  window.deleteFile = (parent, $dispatch) => {
    setProgress(parent, true);
    $.ajax({
      url: `/files/${parent.querySelector('input[name="filesId[]"]').value}`,
      type: "POST",
      cache: false,
      data: {
        _token: $('meta[name="csrf-token"]').attr("content"),
        _method: "DELETE",
      },
      success: function (response) {
        if (response.success) {
          parent.remove();
          showAlert('success', {
            messages: 'File deleted successfully',
            closeable: true,
            timeout: 5000,
          });
        }
        $dispatch('dropbox')
      },
      error: function (error) {
        setProgress(parent, false);
        showAlert('error', {
          messages: 'File delete failed',
          closeable: true,
          timeout: 5000,
        });
        $dispatch('dropbox')
      }
    })
  }
  ///end crud line

  /// dropbox
  dropzone.onclick = () => inputFile.click();
  browseBtn.onclick = () => inputFile.click();
  window.fileChange = (e, $dispatch) => {
    [...inputFile.files].forEach(file => {
      // if (!typeValidation(file.type).accept) return;
      uploadFile(file, $dispatch);
    })
  }

  window.dropboxOndrop = (e, $dispatch) => {
    e.preventDefault();
    // dropzone.classList.remove('hover');
    if (e.dataTransfer.items) {
      [...e.dataTransfer.items].forEach(item => {
        if (item.kind != 'file') return;
        const file = item.getAsFile();
        if (!typeValidation(file.type).accept) return;
        uploadFile(file, $dispatch);
      })
    } else {
      [...e.dataTransfer.files].forEach(file => {
        if (!typeValidation(file.type).accept) return;
        uploadFile(file, $dispatch);
      })
    }
  }
  /// end dropbox
}