let showBox = document.getElementById('show-box');

if (!!showBox) {
  showBox.addEventListener('change', e => {
    let choice = e.target.value;
    if (!choice) return;

    let url = new URL(window.location.href);
    url.searchParams.set('show', choice);
    // console.log(url);
    window.location.href = url; // reloads the page
  });
}