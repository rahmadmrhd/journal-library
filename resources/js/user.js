import { Modal } from "flowbite";
import getLoader from "./loading-handler";
import $ from "jquery";
window.$ = $;

window.deleteUser = (id, e, $dispatch) => {
  $dispatch('open-modal', 'confirm-user-deletion');
  const form = document.querySelector('#confirm-user-deletion-form');
  const idInput = form.querySelector('input[name="id"]');
  idInput.value = id;
  form.action = `/users/${id}`;
}
window.showUpdateUser = (id, e, $dispatch) => {
  showLoading();
  const _baseUrl = document.head.querySelector(
    'meta[name="base-url"]',
  ).content;
  const form = document.querySelector('#user-form');
  const idInput = form.querySelector('input[name="id"]');
  idInput.value = id;
  form.action = `/users/${id}`;
  $.ajax({
    url: `/users/${id}/edit`,
    type: "GET",
    cache: false,
    success: function (response) {
      form.querySelector('#user-credentials').classList.add('hidden');
      form.querySelector('input[name="_method"]').value = 'PUT';
      form.querySelector('input[name="title"]').value = response.data.title;
      form.querySelector('input[name="first_name"]').value = response.data.first_name;
      form.querySelector('input[name="last_name"]').value = response.data.last_name;
      form.querySelector('input[name="degree"]').value = response.data.degree;
      form.querySelector('input[name="preferred_name"]').value = response.data.preferred_name;
      form.querySelector('input[name="email"]').value = response.data.email;
      const rolesInput = form.querySelectorAll('input[name="roles[]"]')
      rolesInput.forEach((el) => {
        if (response.data.roles.some(role => role.id == el.value)) {
          el.checked = true;
          return;
        }
      })

      $dispatch('open-modal', 'add-user-modal');
      hideLoading();
    },
    error: function (error) {
      if (error.status == 401) {
        window.location.reload();
      }
      hideLoading();
    }
  });
}
window.onCloseForm = () => {
  console.log('close form');
  const form = document.querySelector('#user-form');
  form.querySelector('input[name="id"]').value = '';
  form.querySelector('input[name="_method"]').value = 'POST';
  form.querySelector('input[name="title"]').value = '';
  form.querySelector('input[name="first_name"]').value = '';
  form.querySelector('input[name="last_name"]').value = '';
  form.querySelector('input[name="degree"]').value = '';
  form.querySelector('input[name="preferred_name"]').value = '';
  form.querySelector('input[name="email"]').value = '';
  const rolesInput = form.querySelectorAll('input[name="roles[]"]')
  rolesInput.forEach((el) => {
    el.checked = false;
  })
  form.querySelectorAll('ul[role="alert"]').forEach(el => el.classList.add('hidden'));
  form.querySelector('#user-credentials').classList.remove('hidden');
}
window.onCloseDeleteForm = () => {
  const form = document.querySelector('#confirm-user-deletion-form');
  const idInput = form.querySelector('input[name="id"]');
  idInput.value = '';
  form.action = '';
}

window.showConfirmDeleteModal = (id, e, $dispatch) => {
  $dispatch('open-modal', 'modal-confirm-reset-password');
  const confirmBox = document.querySelector('#confirm-reset-password');
  confirmBox.setAttribute('data-id', id);
}

window.onCloseConfirm = () => {
  const confirmBox = document.querySelector('#confirm-reset-password');
  confirmBox.removeAttribute('data-id');
}

window.generateNewPassword = (e, $dispatch) => {
  $dispatch('open-modal', 'modal-new-password');
  const confirmBox = document.querySelector('#confirm-reset-password');
  const id = confirmBox.getAttribute('data-id');

}


