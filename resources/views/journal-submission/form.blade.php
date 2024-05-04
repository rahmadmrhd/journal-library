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
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Nama penulis" name="nama" required
            autofocus autocomplate="nama" type="text" id="nama" :status="$errors->has('nama') ? 'error' : ''" :messages="$errors->get('nama')"
            :value="old('nama')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Afiliasi Penulis" name="afiliasi"
            required autofocus autocomplate="afiliasi" type="text" id="afiliasi" :status="$errors->has('afiliasi') ? 'error' : ''" :messages="$errors->get('afiliasi')"
            :value="old('afiliasi')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Abstrak" name="abstrak" required
            autofocus autocomplate="abstrak" type="text" id="abstrak" :status="$errors->has('abstrak') ? 'error' : ''" :messages="$errors->get('abstrak')"
            :value="old('abstrak')" />
          <x-text-input class="col-span-12 sm:col-span-6 lg:col-span-4" label="Kata kunci" name="kunci" required
            autofocus autocomplate="kunci" type="text" id="kunci" :status="$errors->has('kunci') ? 'error' : ''" :messages="$errors->get('kunci')"
            :value="old('kunci')" />
          <x-text-input class="col-span-12 sm:col-span-6" label="File Upload" name="file" required type="file"
            id="file_uploader" :status="$errors->has('file') ? 'error' : ''" :messages="$errors->get('file')" />
        </div>
        <div class="col-span-12 sm:col-span-6">
          <x-text-input class="col-span-12 sm:col-span-6" label="File Upload" name="upload" type="file"
            id="file_uploader" :status="$errors->has('upload') ? 'error' : ''" :messages="$errors->get('upload')" />
          <x-text-input type="select" label="Kategori" name=kategori :status="$errors->has('kategori') ? 'error' : ''" :messages="$errors->get('kategori')">
            <x-slot name="options">
              <option value="klirens_etik">Klirens Etik</option>
              <option value="persetujuan_responden">Persetujuan Responden</option>
              <option value="dokumen_tambahan">Dokumen tambahan terkait dengan artikel</option>
            </x-slot>
          </x-text-input>

          <button type="submit"
            class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
            Upload
          </button>
      </form>
    </div>
  </div>

</x-app-layout>
