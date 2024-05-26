window.onload = () => {
  const rows = document.querySelectorAll('tr[href]').forEach((tr) => {
    tr.classList.add('cursor-pointer');
    tr.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = tr.getAttribute('href');
    })
  })
}