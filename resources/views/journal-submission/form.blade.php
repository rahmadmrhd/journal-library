<x-app-layout>

  <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
      data-tabs-toggle="#default-tab-content" role="tablist">
      <li class="me-2" role="presentation">
        <button
          class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
          id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
          aria-selected="false">File upload</button>
      </li>
    </ul>
    <x-alert status="secondary" class="mt-6" clossable="false">
      <h1>Silahkan Isi file dengan benar</h1>
    </x-alert>
    @if (session('success'))
      <x-alert status="success" :messages="session('success')" />
    @elseif(session('error'))
      <x-alert status="error" :messages="session('error')" />
    @endif

    <div class="pt-6" id="settings" role="tabpanel" aria-labelledby="settings-tab">
      <form class="space-y-6" method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="card grid grid-cols-12 gap-x-6">
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Judul artikel" name="judul" required
            autofocus autocomplate="judul" type="text" id="judul" :status="$errors->has('judul') ? 'error' : ''" :messages="$errors->get('judul')"
            :value="old('judul')" />

          <x-text-input class="col-span-12 sm:col-span-6" label="File Upload" name="file" required type="file"
            id="file_uploader" :status="$errors->has('file') ? 'error' : ''" :messages="$errors->get('file')" />
        </div>
        <div class="card grid grid-cols-12 gap-x-6">

        </div>

        <button type="submit"
          class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
          Upload
        </button>
      </form>
    </div>
  </div>

</x-app-layout>
