

function alert(type, options = { title, messages, closeable, timeout }) {
  const div = document.createElement('div')
  const element = `
    <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
      viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">${type}</span>
    <div class="ms-3">
      ${options.title ? `<span class="block font-medium">${options.title}</span>` : ''}

      ${Array.isArray(options.messages) ?
      `<ul class="${options.title ? 'mt-1.5' : ''} list-inside list-disc">
          ${messages.forEach(message => `<li class="text-sm font-normal">${message}</li>`)}
          </ul>`:
      `<span class=${options.title ? ' text-sm font-normal ' : ' font-medium '
      } ">${options.messages}</span>`}
    </div>
    ${options.closeable ?
      `<button type="button" x-init="setTimeout(() => show = false, ${options.timeout ?? 3000})"
        class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg p-1.5 focus:ring-2"
        x-on:click="show = false" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>` : ''}`;
  div.innerHTML = element;
  div.setAttribute('class', 'alert ' + type);
  div.setAttribute('role', 'alert');
  div.setAttribute('x-show', 'show');
  div.setAttribute('x-data', '{show:true}');
  div.setAttribute('x-ref', 'alert');
  div.setAttribute('x-init', "$watch('show', () => { setTimeout(() => $refs.alert.remove(), 500) })");
  div.setAttribute('x-transition.duration.500ms', '');

  return div;
}

window.showAlert = (type, options = { title, messages, closeable, timeout }) => {
  const alertGroup = document.querySelector('#alert-group');
  if (!alertGroup) {
    console.log('Element $alert-group not found');
    return;
  }
  alertGroup?.appendChild(alert(type, options));
}