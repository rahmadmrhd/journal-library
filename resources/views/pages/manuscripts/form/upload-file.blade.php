@push('head')
  <meta name="_token" content="{{ csrf_token() }}">
@endpush
@vite('resources/css/file.css')
<form id="manuscript-form" class="" method="POST" action="">
  @csrf
  <div id="dropbox" x-data="{ show: true, hover: false }" x-on:drop="hover = false;dropboxOndrop($event, $dispatch);"
    class="min-h-72 group relative flex w-full items-center justify-center rounded-lg bg-white p-4 shadow-md dark:bg-gray-800">

    {{-- list file --}}
    <div id="table-file" class="top-0 h-full w-full self-start opacity-100 transition-all" x-show="!(show||hover)"
      x-on:dragover.prevent="hover = true" x-transition:enter="ease-out duration-200"
      x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0">
      <div class="mb-2 flex justify-between border-b border-gray-200 pb-4 dark:border-gray-700">
        <h3 class="text-2xl font-bold">File</h3>
        <button type="button" id="browse-btn" class="button primary cursor-pointer">Browse</button>
      </div>
      <x-table class="!text-xs" :columns="[
          [
              'label' => 'File',
              'name' => 'file',
              'isSortable' => false,
          ],
          [
              'label' => 'File Type',
              'name' => 'file_type',
              'isSortable' => false,
              'required' => true,
          ],
          [
              'label' => '',
              'name' => 'action',
              'isSortable' => false,
              'class' => 'border-r border-gray-200 dark:border-gray-800',
          ],
      ]">
        <tr id="row-example"
          class="hidden border-b bg-white !text-xs !font-normal hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
          <th class="max-w-48 px-2 py-2">
            <div class="flex w-full items-center gap-x-4">
              <p id="file-ext" class="button h-fit bg-orange-700 !px-2 !py-1 text-white">
                <svg id="loader" role="status" class="inline h-4 w-4 animate-spin text-white" viewBox="0 0 100 101"
                  fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="#E5E7EB" />
                  <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentColor" />
                </svg>
              </p>
              <a id="file-name"
                class="flex-grow cursor-pointer text-gray-800 underline-offset-1 hover:!text-blue-500 hover:underline dark:text-gray-200 dark:hover:!text-blue-400"></a>
              <input type="hidden" name="id" id="id">
            </div>
            <div id="progress" class="mt-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
              <div id="progress-bar" class="h-1 w-[1%] rounded-full bg-blue-600"></div>
            </div>
          </th>
          <th class="min-w-64 w-[10%] px-2 py-2">
            <x-text-input class="!mb-0 !p-1 !text-xs !font-light" type="select" name="file_type" autofocus>
              <option value="" disabled selected>-- Select File Type --</option>
            </x-text-input>
          </th>
          <td class="w-12 border-l border-gray-200 px-2 py-2 text-center dark:border-gray-700">
            <button type="button" id="delete-btn" class="button error hidden !p-2">
              <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            <svg id="loader" role="status" class="inline h-6 w-6 animate-spin text-white" viewBox="0 0 100 101"
              fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="#E5E7EB" />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentColor" />
            </svg>
          </td>
        </tr>
      </x-table>
    </div>
    {{-- dropzone --}}
    <div id="dropzone-file" class="dropzone-file absolute cursor-pointer transition-all" x-show="show||hover"
      x-on:dropbox.window="show=changeDropboxView()" x-on:resize.window="show=changeDropboxView()"
      x-on:dragover.prevent="hover = true" x-bind:class="(show ? 'show ' : '') + (hover ? 'hover ' : '')"
      x-on:dragleave="hover = false" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100 hover" x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100 hover" x-transition:leave-end="opacity-0">
      <div class="inner pointer-events-none">
        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
        </svg>
        <p class="mb-2 text-center text-base text-gray-500 dark:text-gray-400">
          <span class="font-semibold">Click</span> or <span class="font-semibold">Drag & Drop</span> here <br /> to
          upload files
        </p>
        <p class="hidden text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
      </div>
      <input id="dropzone-file" type="file" multiple class="hidden" x-on:change="fileChange($event, $dispatch)" />
    </div>
  </div>
</form>

@vite('resources/js/file.js')
