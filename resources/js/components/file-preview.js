const listTypes = {
  'application/pdf': 'object',
  'application/msword': 'office',
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'office',
  'application/rtf': 'office',
  'application/vnd.ms-excel': 'office',
  'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'office',
  'text/plain': 'object',
  'image/png': 'object',
  'image/jpg': 'object',
  'image/jpeg': 'object',
  'image/gif': 'object',
}

window.showFile = (url, type) => {
  const container = document.querySelector('#container-file');
  if (listTypes[type] == 'object') {
    const object = document.createElement('object');
    object.data = url;
    object.type = type;
    object.classList.add('relative', 'h-full', 'w-full', 'object-cover');
    container.innerHTML = '';
    container.appendChild(object);
  }
  else {
    const office = document.createElement('iframe');
    office.src = `https://view.officeapps.live.com/op/embed.aspx?src=${url}`;
    office.classList.add('relative', 'h-full', 'w-full', 'object-cover');
    office.setAttribute('frameborder', 0);
    container.innerHTML = '';
    container.appendChild(office);
  }
  window.$dispatch('open-modal', 'file-preview')
}