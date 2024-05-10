import $ from 'jquery';
window.scrollTo(0, 0);

window.form = $('#manuscript-form');
window.dataForm = form?.serialize();

window.onbeforeunload = (e) => {
  if (window.dataForm != window.form?.serialize()) {
    e.preventDefault();
  }
  // return true;
}
// document.getElementById('manuscript-form')?.addEventListener('submit', () => {
//   window.onbeforeunload = null;
// })

window.changeStep = (e, $dispatch) => {
  e.preventDefault();
  const id = document.getElementById('manuscript-id').value;
  if (!id) {
    showAlert('change-step', 'error', 'Please upload a file first!', true, 5000);
    return;
  }
  if (!window.form || window.form.serialize() == window.dataForm) {
    e.currentTarget.submit();
    return;
  };
  $dispatch('open-modal', 'confirmation-change-step');
  $dispatch('confirm-change-step', { form: e.currentTarget });
}