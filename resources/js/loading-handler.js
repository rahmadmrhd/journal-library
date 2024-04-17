export default function getLoader() {
  const loading = document.getElementById('loading-box');
  const loadingTitle = document.getElementById('loading-title');
  const loadingDescription = document.getElementById('loading-description');

  function show(title, description) {
    loading.classList.remove('hidden');
    loading.classList.add('flex');
    loadingTitle.innerHTML = title;
    loadingDescription.innerHTML = description;
  }
  function hide() {
    loading.classList.remove('flex');
    loading.classList.add('hidden');
    loadingTitle.innerHTML = '';
    loadingDescription.innerHTML = '';
  }
  return {
    show,
    hide
  }
}