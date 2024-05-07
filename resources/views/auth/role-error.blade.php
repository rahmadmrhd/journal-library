@php
  $error = request()->get('role_error');
@endphp
<div class="card">
  <div class="mb-6 mt-4">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">Can't access this page</h1>
    </div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      The {{ '"' . Auth::user()->getCurrentRole()->name . '"' }} role is not authorized to access this page.
    </div>

    <div class="mt-4 flex items-center justify-between">
      <form action="{{ route('role.update', absolute: false) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="roleId" value="{{ $error['right_role']->id ?? '' }}">

        <div class="flex flex-col gap-x-6 gap-y-2 sm:flex-row">
          @isset($error['right_role'])
            <button type="submit"
              class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out focus:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
              Continue & Change the role to {{ '"' . $error['right_role']->name . '"' }}
            </button>
          @endisset

          @if ($error['url_back'] != url()->current())
            <a href="{{ $error['url_back'] }}"
              class="inline-flex items-center rounded-md border border-gray-400 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-900 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
              Back
            </a>
          @endif
        </div>
      </form>

    </div>
  </div>
</div>
