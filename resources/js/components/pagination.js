function showOnChanged(e) {
  let choice = e.target.value;
  if (!choice) return;

  let url = new URL(window.location.href);
  url.searchParams.set('show', choice);
  window.location.href = url; // reloads the page
}
window.showOnChanged = showOnChanged