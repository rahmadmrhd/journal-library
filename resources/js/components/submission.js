import $ from 'jquery';
window.scrollTo(0, 0);

window.form = $('#manuscript-form');
window.dataForm = form?.serialize();


function windowOnBeforeUnload(e) {
  if (window.dataForm != window.form?.serialize()) {
    e.preventDefault();
  }
}
document.getElementById('manuscript-form')?.addEventListener('submit', (event) => {
  const id = document.getElementById('manuscript-id').value;
  if (!id && (!window.form || window.form.serialize() == window.dataForm)) {
    showAlert('error', { messages: 'Please upload a file first!', closeable: true, timeout: 5000 });
    event.preventDefault();
    return;
  }
  window.removeEventListener('beforeunload', windowOnBeforeUnload);
  return true;
})


window.addEventListener('beforeunload', windowOnBeforeUnload);

window.changeStep = (e, $dispatch) => {
  e.preventDefault();
  if (e.currentTarget.getAttribute('disabled')) return;
  const id = document.getElementById('manuscript-id').value;

  if (!window.form || window.form.serialize() == window.dataForm) {
    if (!id) {
      showAlert('error', { messages: 'Please upload a file first!', closeable: true, timeout: 5000 });
      return;
    }
    onSubmitChangeStep(e.currentTarget);
    return;
  }

  if (!id) {
    $dispatch('open-modal', 'confirmation-change-step');
    $dispatch('confirm-change-step', {
      targetStep: e.currentTarget.querySelector('input[name="step"]').value
    });
    return
  }

  $dispatch('open-modal', 'confirmation-change-step');
  $dispatch('confirm-change-step', {
    form: e.currentTarget,
    targetStep: e.currentTarget.querySelector('input[name="step"]').value
  });
}

window.onSubmitChangeStep = (form) => {
  window.removeEventListener('beforeunload', windowOnBeforeUnload);
  form.submit();
}