export default function getLoader() {
  const loading = document.getElementById('loading-box');
  const loadingTitle = document.getElementById('loading-title');
  const loadingDescription = document.getElementById('loading-description');

  function show(title, description) {
    loading.classList.remove('hidden');
    loading.classList.add('flex');
    title ? loadingTitle.classList.remove('hidden') : loadingTitle.classList.add('hidden');
    description ? loadingDescription.classList.remove('hidden') : loadingDescription.classList.add('hidden');
    loadingTitle.innerHTML = title ?? '';
    loadingDescription.innerHTML = description ?? '';
  }
  function hide() {
    loading.classList.remove('flex');
    loading.classList.add('hidden');
    loadingTitle.classList.add('hidden')
    loadingDescription.classList.add('hidden')
  }
  return {
    show,
    hide
  }
}

window.showLoading = (title, description) => getLoader().show(title, description);
window.hideLoading = () => getLoader().hide()