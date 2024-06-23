import { Dropdown } from 'flowbite';
import $ from 'jquery';
window.searchUsers = (subGate, search, without, role, callback) => {
  if (search && search.length > 0 && search.length < 3) {
    return;
  }
  $.ajax({
    url: `/${subGate.slug}/users/search/${role}/${!search ? 'recomended' : search}`,
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr("content"),
      without: without ?? []
    },
    cache: false,
    success: (result) => {
      callback(result);
    },
    error: (error) => {
      console.log(error);
    }
  });
}

window.registerMoreDropdown = (triggerEl, targetEl, id) => {

  // options with default values
  const options = {
    placement: 'bottom',
    triggerType: 'click',
    offsetSkidding: 20,
    delay: 300,
    ignoreClickOutsideClass: false,
    // onHide: () => {
    //   console.log('dropdown has been hidden');
    // },
    // onShow: () => {
    //   console.log('dropdown has been shown');
    // },
    // onToggle: () => {
    //   console.log('dropdown has been toggled');
    // },
  };

  // instance options object
  const instanceOptions = {
    id: id,
    override: true
  };

  const dropdown = new Dropdown(targetEl, triggerEl, options, instanceOptions);
  return dropdown;
}