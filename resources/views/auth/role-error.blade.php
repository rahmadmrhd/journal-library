@php
  $error = request()->get('role_error');
@endphp
<div class="card">
  <div class="mb-6 mt-4">
    <div class="mb-3 flex items-center justify-between">
      <h1 class="text-3xl font-bold">Can't access this page</h1>
    </div>
    <div class="text-sm text-gray-600 dark:text-gray-400">
      {{ $error['message'] }}
    </div>

    <div class="mt-6 flex items-center justify-between">
      <form class="w-full" action="{{ route('role.update', $subGate->slug, absolute: false) }}" method="POST">
        @csrf
        @method('PUT')

        <x-text-input type="select" name="roleId" onchange="this.form.submit()" label="Recommended Role"
          class="max-w-96 w-full" description="Please select a role to continue">
          <option value="" disabled selected>-- Select Role --</option>
          @foreach ($error['role_recomended'] as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
        </x-text-input>

        <div class="mt-3 flex flex-col gap-x-6 gap-y-2 sm:flex-row">

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
