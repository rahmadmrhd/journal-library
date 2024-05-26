import $ from 'jquery';

window.registerFileManuscript = (element, $dispatch, files, file_types, readOnly, isDraft) => {

  const dropboxFile = { rowFiles: {} };

  const listTypes = {
    'application/pdf': '#F40F02',
    'application/msword': '#2b579a',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': '#2b579a',
    'application/rtf': '#2b579a',
    'application/vnd.ms-excel': '#217346',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': '#217346',
    'text/plain': '#555555',
    'image/png': '#ff6a00',
    'image/jpg': '#ff6a00',
    'image/jpeg': '#ff6a00',
    'image/gif': '#ff6a00',
  }

  const browseBtn = element.querySelector('#browse-btn');
  const dropzone = element.querySelector('#dropzone-file');
  const inputFile = element.querySelector('#dropzone-file input[type="file"]');
  const tableFile = element.querySelector('#table-file table > tbody');
  const listFile = element.querySelector('#table-file #list-file');
  const rowTableExample = tableFile.querySelector('#row-example');
  const rowListExample = listFile.querySelector('#row-example');

  function getAllFile() {
    const filesEL = [...tableFile.querySelectorAll('[role="file"] input[name="filesId[]"]')].map(el => el.value);
    return filesEL;
  }

  dropboxFile.changeDropboxView = () => {
    if (window.innerWidth < 640) return false
    const files = getAllFile();
    if (files.length > 0) return false
    else return true;
  }

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
    parent.querySelector('#file-name').onclick = () => {
      window.showFile(`/${file.path}`, file.mime_type)
    }
    parent.querySelector('#file-ext').innerHTML = file.extension ?? '';
    parent.querySelector('#file-ext').closest('div').style.backgroundColor = listTypes[file.mime_type]
    const inputId = parent.querySelector('input[name="filesId[]"]');
    inputId.value = file.id ?? generateRandom(5);
    inputId.disabled = false;
    parent.querySelector('a').href = '/' + file.path;
    parent.querySelector('a').download = file.name;

    const selectFileType = parent.querySelector('select[name="file_type"]');
    if (!file_types) {
      file_types = file.file_type ? [file.file_type] : [];
    }
    // console.log(file)
    file_types.forEach((type) => {
      const option = document.createElement('option');
      option.value = type.id;
      option.innerHTML = (type.required ? '** ' : '') + type.name;
      selectFileType.appendChild(option);
    });
    if (file.file_type_id) selectFileType.value = file.file_type_id;
    if (!isList) {
      dropboxFile.rowFiles[inputId.value] = {
        ...dropboxFile.rowFiles[inputId.value],
        rowTable: parent,
      }
      selectFileType.onchange = (e) => {
        const selectFileTypeList = dropboxFile.rowFiles[inputId.value].rowList.querySelector('select[name="file_type"]');
        selectFileTypeList.value = e.currentTarget.value;
        updateData(inputId.value, e.currentTarget.value)
      }
    }
    else {
      dropboxFile.rowFiles[inputId.value] = {
        ...dropboxFile.rowFiles[inputId.value],
        rowList: parent,
      }
      selectFileType.onchange = (e) => {
        const selectFileTypeTable = dropboxFile.rowFiles[inputId.value].rowTable.querySelector('select[name="file_type"]');
        selectFileTypeTable.value = e.currentTarget.value;
        updateData(inputId.value, e.currentTarget.value)
      }
    }
  }
  if (files) {
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
  }
  function updateData(fileId, file_type) {
    const selectFileTypeTable = dropboxFile.rowFiles[fileId].rowTable;
    const selectFileTypeList = dropboxFile.rowFiles[fileId].rowList;
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



  if (!readOnly) {
    /// crud file
    function typeValidation(type) {
      if (listTypes[type]) return true;
      return false;
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
        setProgress(rowList, false, 100);
      }
      http.upload.onprogress = (e) => {
        setProgress(rowTable, true, (e.loaded / e.total) * 100);
        setProgress(rowList, true, (e.loaded / e.total) * 100);
      }
      http.open('POST', '/files');
      http.send(data);

    }

    dropboxFile.deleteFile = (parent, $dispatch) => {
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
    dropboxFile.fileChange = (e, $dispatch) => {
      [...inputFile.files].forEach(file => {
        if (!typeValidation(file.type)) return;
        uploadFile(file, $dispatch);
      })
    }

    dropboxFile.dropboxOndrop = (e, $dispatch) => {
      e.preventDefault();
      // dropzone.classList.remove('hover');
      if (e.dataTransfer.items) {
        [...e.dataTransfer.items].forEach(item => {
          if (item.kind != 'file') return;
          const file = item.getAsFile();
          if (!typeValidation(file.type)) return;
          uploadFile(file, $dispatch);
        })
      } else {
        [...e.dataTransfer.files].forEach(file => {
          if (!typeValidation(file.type)) return;
          uploadFile(file, $dispatch);
        })
      }
    }
    /// end dropbox
  }
  return dropboxFile;
}