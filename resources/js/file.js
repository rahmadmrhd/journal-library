import $ from 'jquery';

const browseBtn = document.querySelector('#browse-btn');
const dropzone = document.getElementById('dropzone-file');
const inputFile = document.querySelector('#dropzone-file input[type="file"]');
const tableFile = document.querySelector('#table-file table > tbody');
const rowExample = tableFile.querySelector('#row-example');

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
function attachFile(parent, file, file_types) {
  parent.querySelector('#file-name').innerHTML = file.name ?? '';
  parent.querySelector('#file-ext').innerHTML = file.extension ?? '';
  parent.querySelector('input[name="filesId[]"]').value = file.id ?? '';
  parent.querySelector('input[name="filesId[]"]').disabled = false;
  parent.querySelector('a').href = '/' + file.path;

  const selectFileType = parent.querySelector('select[name="file_type"]');
  file_types.forEach((type) => {
    const option = document.createElement('option');
    option.value = type.id;
    option.innerHTML = (type.required ? '** ' : '') + type.name;
    selectFileType.appendChild(option);
  });
  if (file.file_type_id) selectFileType.value = file.file_type_id
  selectFileType.onchange = () => {
    updateData(parent, `/files/${parent.querySelector('input[name="filesId[]"]').value}`)
  }
}
window.getFilesManuscript = ($dispatch, files, file_types, isDraft) => {
  if (!files || !file_types) return;
  files.forEach(file => {
    const row = rowExample.cloneNode(true);
    row.classList.remove('hidden');
    row.setAttribute('role', 'file')
    row.querySelector('#delete-btn').onclick = () => deleteFile(row, $dispatch);
    row.querySelector('select[name="file_type"]').required = true;
    attachFile(row, file, file_types);
    setProgress(row, false);
    tableFile.appendChild(row);
  });
  if (!isDraft)
    window.dataForm = window.form?.serialize();
  $dispatch('dropbox')
}

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
function setProgress(parent, isLoad, progress) {
  if (isLoad) {
    parent.querySelector('#delete-btn').classList.add('hidden');
    parent.querySelector('#loader').classList.remove('hidden');
    if (!progress) return;
    parent.querySelector('#progress').classList.remove('hidden');
    parent.querySelector('#progress-bar').style.width = progress + '%';
  } else {
    parent.querySelector('#delete-btn').classList.remove('hidden');
    parent.querySelector('#loader').classList.add('hidden');
    parent.querySelector('#progress').classList.add('hidden');
  }
}
function uploadFile(file, $dispatch) {
  const row = rowExample.cloneNode(true);
  row.classList.remove('hidden');
  row.setAttribute('role', 'file')
  row.querySelector('#delete-btn').onclick = () => deleteFile(row, $dispatch);
  row.querySelector('#file-name').innerHTML = file.name;
  row.querySelector('select[name="file_type"]').required = true;

  // row.querySelector('a').href = URL.createObjectURL(file);
  // row.querySelector('a').download = file.name;
  tableFile.appendChild(row);

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
          row.remove();
          const index = [...inputFile.files].findIndex(el => el.name == file.name);
          [...inputFile.files].splice(index, 1);
          $dispatch('dropbox')
          return;
        }
        attachFile(row, response.file, response.file_types);
        showAlert('success', {
          messages: 'File uploaded successfully',
          closeable: true,
          timeout: 5000,
        });
      } catch (error) {
        tableFile.removeChild(row);
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
    setProgress(row, false, 100);
  }
  http.upload.onprogress = (e) => {
    setProgress(row, true, (e.loaded / e.total) * 100);
  }
  http.open('POST', '/files');
  http.send(data);

}

function updateData(parent, url) {
  setProgress(parent, true);
  $.ajax({
    url: url,
    type: "POST",
    cache: false,
    data: {
      _token: $('meta[name="csrf-token"]').attr("content"),
      _method: "PUT",
      file_type_id: parent.querySelector('select[name="file_type"]').value,
    },
    success: function (response) {
      if (!response.success) return;
      parent.querySelector('select[name="file_type"]').value = response.file.file_type_id;
      parent.querySelector('input[name="file_type_before"]').value = response.file.file_type_id;
      setProgress(parent, false);
      showAlert('success', {
        messages: 'File updated successfully',
        closeable: true,
        timeout: 5000,
      });

      if (document.getElementById('manuscript-id').value)
        window.dataForm = window.form?.serialize();
    },
    error: function (error) {
      setProgress(parent, false);
      parent.querySelector('select[name="file_type"]').value = parent.querySelector('select[name="file_type_before"]').value;
      showAlert('error', {
        messages: 'File update failed',
        closeable: true,
        timeout: 5000,
      });

      $dispatch('dropbox')
    }
  })
}
function deleteFile(parent, $dispatch) {
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
        tableFile.removeChild(parent);
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
    if (!typeValidation(file.type).accept) return;
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