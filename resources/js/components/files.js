import $ from 'jquery';

window.registerDropboxFile = (element, $dispatch, files, readOnly) => {
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
  const listFile = element.querySelector('#table-file #list-file');
  const rowListExample = listFile.querySelector('#row-example');

  function getAllFile() {
    const filesEL = [...listFile.querySelectorAll('[role="file"] input[name="filesId[]"]')].map(el => el.value);
    return filesEL;
  }

  dropboxFile.changeDropboxView = () => {
    if (window.innerWidth < 640) return false
    const files = getAllFile();
    if (files.length > 0) return false
    else return true;
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

  function attachFile(parent, file) {
    parent.classList.remove('hidden');
    parent.setAttribute('role', 'file')
    const delBtn = parent.querySelector('#delete-btn')
    if (delBtn) {
      delBtn.onclick = () => deleteFile(parent, $dispatch);
    }
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

    dropboxFile.rowFiles[inputId.value] = {
      ...dropboxFile.rowFiles[inputId.value],
      rowList: parent,
    }

  }

  if (files) {
    files.forEach(file => {
      const rowList = rowListExample.cloneNode(true);
      attachFile(rowList, file);
      setProgress(rowList, false);
      listFile.appendChild(rowList);
    });
  }

  if (!readOnly) {
    /// crud file
    function typeValidation(type) {
      if (listTypes[type]) return true;
      return false;
    }
    function uploadFile(file, $dispatch) {
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
              rowList.remove();
              const index = [...inputFile.files].findIndex(el => el.name == file.name);
              [...inputFile.files].splice(index, 1);
              $dispatch('dropbox')
              return;
            }
            attachFile(rowList, response.file);
            showAlert('success', {
              messages: 'File uploaded successfully',
              closeable: true,
              timeout: 5000,
            });
          } catch (error) {
            console.log(error)
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
        setProgress(rowList, false, 100);
      }
      http.upload.onprogress = (e) => {
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