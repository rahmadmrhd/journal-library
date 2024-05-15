<form id="manuscript-form" action="{{ route('manuscripts.storeAuthors', $manuscript->id) }}" method="POST"
  class="{{ $manuscript->isReview ? '' : 'card' }} flex flex-col gap-y-3 pt-6" x-data="{
      show: @js(old('isSoleAuthor', $manuscript->isSoleAuthor ?? true)) ? 1 : '',
      authors: Object.values(@js($manuscript->authors ?? [])),
      listAuthor: [],
      inputFocused: false,
      dropdownFocused: false,
      search: '',
  }"
  x-init="$watch('search', val => searchAuthors(val, (result) => listAuthor = result));
  console.log(authors);" x-on:submit-sole-author.window="show = 1; authors = []">
  @csrf
  @method('PUT')

  {{-- CONFIRM AUTHOR --}}

  <div class="">
    <x-text-input :disabled="$manuscript->isReview" x-model="show" type="radio" :options="[
        [
            'label' => 'I am the sole Author',
            'value' => true,
        ],
        [
            'label' => 'I have a Co-Author',
            'value' => false,
        ],
    ]"
      label="Please confirm that you have entered the details of all your co-authors as these cannot be added to a paper once submitted or post-acceptance."
      id="isSoleAuthor" name="isSoleAuthor" required
      x-on:click="
        if(event.target.value == 1 && authors.length > 0) {
          $dispatch('open-modal','modal-confirm-sole-author');
          event.preventDefault();
        }
      "></x-text-input>

    {{-- SEARCH AUTHORS --}}
    <div x-show="!show" class="relative mt-6 w-full">
      <x-text-input class="col-span-12 xl:col-span-12" type="search" label="Add Author" id="search_author"
        placeholder="Search Authors" description="Search by name, email, username, or ORCID" name="search_author"
        x-on:focus="inputFocused=true" x-on:focusout="inputFocused=false" x-model.debounce.500ms="search" x-ref="search"
        x-on:keydown="
            inputFocused=true;
            if(event.keyCode==13) { // 13 = enter
              event.preventDefault();
            }">
        @slot('icon')
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M15.5 12c2.5 0 4.5 2 4.5 4.5c0 .88-.25 1.71-.69 2.4l3.08 3.1L21 23.39l-3.12-3.07c-.69.43-1.51.68-2.38.68c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5m0 2a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5M10 4a4 4 0 0 1 4 4c0 .91-.31 1.75-.82 2.43c-.86.32-1.63.83-2.27 1.47L10 12a4 4 0 0 1-4-4a4 4 0 0 1 4-4M2 20v-2c0-2.12 3.31-3.86 7.5-4c-.32.78-.5 1.62-.5 2.5c0 1.29.38 2.5 1 3.5z" />
          </svg>
        @endslot
        {{-- @slot('ext')
        <button type="button" class="button primary">Add Manually</button>
      @endslot --}}
      </x-text-input>
      {{-- dropdown --}}
      <div focusable x-show="(dropdownFocused||inputFocused) && listAuthor.length > 0"
        x-on:mouseover="dropdownFocused=true" x-on:mouseleave="dropdownFocused=false"
        class="absolute z-10 mt-1 h-auto w-full rounded-lg bg-gray-50 px-4 pb-2 shadow-md dark:bg-gray-700">
        <x-table :columns="[
            ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
            ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
        ]">
          <template x-for="author in listAuthor.filter(key => authors.indexOf(key) < 0)">
            <tr
              class="cursor-pointer border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600"
              x-on:click.prevent.stop="
              if(authors.findIndex(key => key.id == author.id) < 0 && author.id != @js(request()->user()->id)){
              authors.push(author); 
              $refs.search.value=''; 
              $refs.search.focus();
            }else{
              showAlert('error', { messages: 'Author has already been added!', closeable: true, timeout: 5000 });
            }">
              <td valign="top" class="max-w-64px truncate px-6 py-2">
                <div class="flex flex-col items-start">
                  <h3 class="text-base font-bold" x-text="author.full_name"></h3>
                  <p class="mt-4 text-sm font-normal" x-text="author.email"></p>
                  <template x-if="author.orcid_id">
                    <div class="mt-2 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                      </svg>
                      <p x-text="author.orcid_id" class="text-sm font-normal">
                      </p>
                    </div>
                  </template>
                </div>
              </td>
              <td valign="top" class="px-6 py-2">
                <div class="flex flex-col items-start">
                  <p class="text-sm font-bold"
                    x-text="`${author.institution ? `${author.institution}, ` : ''}${author.department ? `${author.department}, ` : ''}${author.position??''}`">
                  </p>
                  <p class="text-sm font-normal" x-text="author.address"></p>
                  <p class="text-sm font-normal"
                    x-text="`${author.city ? `${author.city}, ` : ''}${author.province ? `${author.province}, ` : ''}${author.country ? `${author.country}, ` : ''}${author.postal_code ? `ID ${author.postal_code}` : ''}`">
                  </p>
                </div>
              </td>
            </tr>
          </template>
        </x-table>
      </div>
    </div>

  </div>

  {{-- LIST AUTHORS --}}
  <x-table :columns="[
      ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
      ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
      ...$manuscript->isReview ? [] : [['label' => ' ', 'isSortable' => false]],
  ]">
    <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
      @php
        $user = Auth::user();
      @endphp
      <td valign="top" class="max-w-64px truncate px-6 py-2">
        <div class="flex flex-col items-start">
          <h3 class="text-base font-bold">{{ $user->getFullName() }}</h3>
          <p class="text-sm italic">(Corresponding Author)</p>
          <a class="mt-4 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">{{ $user->email }}
          </a>
          @if ($user->orcid_id)
            <div class="mt-2 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
              </svg>
              <a href="https://orcid.org/"
                class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                {{ $user->orcid_id }}
              </a>
            </div>
          @endif
        </div>
      </td>
      <td valign="top" class="px-6 py-2">
        <div class="flex flex-col items-start">
          <p class="text-sm font-bold">
            {{ $user->institution ? $user->institution . ',' : '' }}
          </p>
          <p class="text-sm">
            {{ $user->department ? $user->department . ',' : '' }}
            {{ $user->position }}
          </p>
          <p class="mt-5 text-sm font-normal">{{ $user->address }}
          </p>
          <p class="text-sm font-normal">
            {{ $user->city ? $user->city . ',' : '' }}
            {{ $user->province ? $user->province . ',' : '' }}
            {{ $user->country?->name ? $user->country?->name . ',' : '' }}
            {{ $user->postal_code ? 'ID ' . $user->postal_code : '' }}
          </p>
        </div>
      </td>
      @if (!isset($manuscript->isReview))
        <td class="w-[100px] space-x-1 whitespace-nowrap p-4"></td>
      @endif
    </tr>
    <template x-for="(author, index) in authors">
      <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
        <td valign="top" class="max-w-64px truncate px-6 py-2">
          <div class="flex flex-col items-start">
            <input type="hidden" name="authorsId[]" x-model="author.id">
            <h3 class="text-base font-bold" x-text="author.full_name"></h3>
            <p class="mt-6 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"
              x-text="author.email"></p>
            <template x-if="author.orcid_id">
              <div class="mt-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                </svg>
                <p x-text="author.orcid_id"
                  class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                </p>
              </div>
            </template>
          </div>
        </td>
        <td valign="top" class="px-6 py-2">
          <div class="flex flex-col items-start">
            <p class="text-sm font-bold" x-text="`${author.institution ? `${author.institution}, ` : ''}`">
            </p>
            <p class="text-sm" x-text="`${author.department ? `${author.department}, ` : ''}${author.position??''}`">
            </p>
            <p class="mt-3 text-sm font-normal" x-text="author.address"></p>
            <p class="text-sm font-normal"
              x-text="`${author.city ? `${author.city}, ` : ''}${author.province ? `${author.province}, ` : ''}${author.country?.name ? `${author.country?.name}, ` : ''}${author.postal_code ? `ID ${author.postal_code}` : ''}`">
            </p>
          </div>
        </td>
        @if (!isset($manuscript->isReview))
          <td class="w-[100px] space-x-1 whitespace-nowrap p-4">
            <button type="button" class="button error !p-2"
              x-on:click.stop="authors.splice(authors.findIndex((f)=>f.id == author.id), 1)">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
              </svg>
            </button>
          </td>
        @endif
        {{-- <td class="w-[100px] space-x-1 whitespace-nowrap p-4">
          <div x-data="{ dropdownInstance: null, dropdown: null, dropdownBtn: null }">
            <button title="More" class="button secondary !p-2" type="button" x-init="dropdownBtn = $el;">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M16 12a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2m-6 0a2 2 0 0 1 2-2a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2" />
              </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-bind:id="`more-dropdown-${author.id}`" x-init="dropdown = $el;
            $nextTick(() => {
                dropdownInstance = registerMoreDropdown(dropdownBtn, dropdown, author.id);
            })"
              class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                <li>
                  <button type="button"
                    class="flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    Edit
                  </button>
                </li>
                <li class="border-t border-gray-100 dark:border-gray-600">
                  <button type="button" x-on:click="authors.splice(index, 1)"
                    {{ $user->readonly ? 'disabled' : '' }}
                    class="flex w-full items-center gap-3 px-4 py-2 text-red-700 hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-400">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                    </svg>
                    <span>Delete Account</span>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </td> --}}
      </tr>
    </template>
  </x-table>

</form>

{{-- MODAL ADD Co-Author MANUALLY --}}
<x-modal name="add-coauthor-manually" focusable>

  <div class="md:min-w-96 relative w-full self-start sm:max-h-full sm:self-center lg:w-[760px]">
    <div class="relative h-full bg-white shadow dark:bg-gray-800 sm:max-h-full sm:rounded-lg">
      <form id="funder-form" action="" method="POST" x-data="{
          index: -1,
          name: '',
          grants: [''],
      }" x-init="$watch('show', value => {
          if (!show) {
              name = '';
              grants = [''];
              index = -1;
          }
      });
      $watch('index', value => {
          console.log(value)
      })"
        x-on:edit-funding.window="name = $event.detail.name; grants = $event.detail.grants; index = $event.detail.index; console.log('edit', $event.detail)"
        x-on:submit.prevent="
        index >= 0 ? $dispatch('update-funding', {name:name, grants:[...grants]}) :
        $dispatch('add-funding', {name:name, grants:[...grants], index:index});
        $dispatch('close')">
        {{-- Modal header  --}}
        <div
          class="flex w-full items-start justify-between rounded-t border-b p-5 dark:border-gray-700 dark:bg-gray-800">
          <h3 id="modal-title" class="text-xl font-semibold dark:text-white"
            x-text="index >= 0 ? 'Edit Funder' : 'Add Funder'"></h3>
        </div>

        {{-- Modal body  --}}
        <div class="mt-0 space-y-6 p-6">

          <form action="{{ route('profile.update', absolute: false) }}" method="POST" class="space-y-6">
            <div class="card divide-y-2 divide-gray-200 dark:divide-gray-700">
              <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  {{ __('Personal Information') }}
                </h2>

              </header>
              <div class="grid max-w-screen-xl grid-cols-12 gap-x-6 gap-y-2 pt-6">
                @csrf
                @method('PUT')
                <x-text-input class="col-span-12 sm:col-span-4 xl:col-span-2" :label="__('Title')" id="title"
                  name="title" type="text" :value="old('title', $user->title)" placeholder="(Dr., Mr., Mrs., etc.)"
                  autocomplete="title" :messages="$errors->get('title')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-8 xl:col-span-4" :label="__('First Name')" id="first_name"
                  name="first_name" type="text" :value="old('first_name', $user->first_name)" required autocomplete="first_name"
                  :messages="$errors->get('first_name')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-8 xl:col-span-4" :label="__('Last Name')" id="last_name"
                  name="last_name" type="text" :value="old('last_name', $user->last_name)" required autocomplete="last_name"
                  :messages="$errors->get('last_name')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-4 xl:col-span-2" :label="__('Degree')" id="degree"
                  name="degree" type="text" :value="old('degree', $user->degree)" autocomplete="degree" :messages="$errors->get('degree')"
                  placeholder="(Ph.D., M.D., etc.)"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-9 xl:col-span-7" :label="__('Preferred Name (nickname)')" id="preferred_name"
                  name="preferred_name" type="text" :value="old('preferred_name', $user->preferred_name)" autocomplete="preferred_name"
                  :messages="$errors->get('preferred_name')"></x-text-input>
              </div>

            </div>

            <div class="card divide-y-2 divide-gray-200 dark:divide-gray-700">
              <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  {{ __('Institution Related Information') }}
                </h2>
              </header>

              <div class="grid max-w-screen-xl grid-cols-12 gap-x-6 gap-y-2 pt-6">
                <x-text-input class="col-span-12 sm:col-span-9 xl:col-span-7" :label="__('Institution')" id="institution"
                  name="institution" type="text" :value="old('institution', $user->institution)" required autocomplete="institution"
                  :messages="$errors->get('institution')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-6" :label="__('Department')" id="department" name="department"
                  type="text" :value="old('department', $user->department)" required autocomplete="department"
                  :messages="$errors->get('department')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-6" :label="__('Position')" id="position" name="position"
                  type="text" :value="old('position', $user->position)" autocomplete="position" :messages="$errors->get('position')"></x-text-input>

                <x-text-input class="col-span-12" :label="__('Address')" id="address" name="address" type="textarea"
                  :value="old('address', $user->address)" rows="2" required autocomplete="address" :messages="$errors->get('address')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-6 xl:col-span-4" :label="__('City')" id="city"
                  name="city" type="text" :value="old('city', $user->city)" required autocomplete="city"
                  :messages="$errors->get('city')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-6 xl:col-span-4" :label="__('State or Province')" id="province"
                  name="province" type="text" :value="old('province', $user->province)" required autocomplete="province"
                  :messages="$errors->get('province')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-6 xl:col-span-4" :label="__('Postal Code or Zip')" id="postal_code"
                  name="postal_code" type="text" :value="old('postal_code', $user->postal_code)" required autocomplete="postal_code"
                  :messages="$errors->get('postal_code')"></x-text-input>

                <x-text-input class="col-span-12 sm:col-span-9 xl:col-span-7" :label="__('Country')" id="country"
                  name="country" type="select" :value="old('country', $user->country)" required autocomplete="country"
                  :messages="$errors->get('country')">
                  <option value="" selected disabled>-- {{ __('Select Country') }} --</option>
                  @foreach ($countries ?? [] as $country)
                    <option value="{{ $country['code'] }}"
                      {{ old('country', $user->country) == $country['code'] ? 'selected' : '' }}>
                      {{ $country['name'] }}
                    </option>
                  @endforeach
                </x-text-input>

              </div>

            </div>
            <div class="divide-y-2 divide-gray-200 dark:divide-gray-700">
              <div class="flex items-center gap-4">
                <button class="button primary">Save</button>
              </div>
            </div>
          </form>

        </div>

        {{-- Modal footer  --}}
        <div class="flex items-center gap-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-700">
          <button id="submit-modal-btn" class="button primary" type="submit">
            Add
          </button>
          <button type="button" x-on:click.prevent="$dispatch('close')" class="button secondary">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>

</x-modal>

{{-- MODAL CONFIRM SOLE AUTHOR --}}
<x-modal name="modal-confirm-sole-author" focusable>
  <div class="max-w-2xl p-4 text-center md:p-5">
    <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
      {{ __('Are you sure you are the sole Author? If so, all Co-Authors you have added will be removed.') }}
    </h3>
    <div class="flex justify-center gap-3">
      <button id="submit-modal-btn" type="button" class="button primary"
        x-on:click="$dispatch('close'); $dispatch('submit-sole-author')">
        {{ __('Yes, I am the sole Author') }}
      </button>
      <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
        {{ __('Cancel') }}
      </button>
    </div>
  </div>
</x-modal>

@vite('resources/js/form-submission/authors-institutions.js')
