import $ from 'jquery';

const browseBtn = document.querySelector('#browse-btn');
const dropzone = document.getElementById('dropzone-file');
const inputFile = document.querySelector('#dropzone-file input[type="file"]');
const tableFile = document.querySelector('#table-file table > tbody');
const rowExample = tableFile.querySelector('#row-example');

window.getAllFile = function getAllFile() {
  const filesEL = [...tableFile.querySelectorAll('[role="file"] input[name="id"]')].map(el => el.value);
  return filesEL;
}

window.changeDropboxView = () => {
  console.log('window resize')
  if (window.innerWidth < 640) return false
  const files = getAllFile();
  if (files.length > 0) return false
  else return true;
}


const manuscriptForm = document.getElementById('manuscript-form');
manuscriptForm.onsubmit = (e) => {
  const listFile = manuscriptForm.querySelector('input[name="fileIds"]');
  listFile.value = `[${getAllFile().join(',')}]`;
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

  http.onreadystatechange = function () {
    if (this.readyState == XMLHttpRequest.DONE) {
      const response = JSON.parse(this.response);
      console.log(response);
      if (!response.success) {
        row.remove();
        const index = [...inputFile.files].findIndex(el => el.name == file.name);
        [...inputFile.files].splice(index, 1);
        $dispatch('dropbox')
        return;
      }
      row.querySelector('#file-name').innerHTML = response.file.name ?? '';
      row.querySelector('#file-ext').innerHTML = response.file.extension ?? '';
      row.querySelector('input[name="id"]').value = response.file.id ?? '';
      const selectFileType = row.querySelector('select[name="file_type"]');
      response.file_types.forEach((type) => {
        const option = document.createElement('option');
        option.value = type.id;
        option.innerHTML = type.name;
        selectFileType.appendChild(option);
      })
      selectFileType.onchange = () => {
        updateData(row, `/files/${row.querySelector('input[name="id"]').value}`)
      }
      row.querySelector('a').href = '/' + response.file.path;
      $dispatch('dropbox')
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

function updateData(parent, url, data) {
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
      console.log(response);
      if (!response.success) return;
      parent.querySelector('select[name="file_type"]').value = response.file.file_type_id;
      setProgress(parent, false);
    },
  })
}
function deleteFile(parent, $dispatch) {
  setProgress(parent, true);
  $.ajax({
    url: `files/${querySelector('input[name="id"]').value}`,
    type: "POST",
    cache: false,
    data: {
      _token: $('meta[name="csrf-token"]').attr("content"),
      _method: "DELETE",
    },
    success: function (response) {
      if (response.success)
        tableFile.removeChild(parent);
      $dispatch('dropbox')
    },
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