<form id="manuscript-form" action="" method="POST" class="grid grid-cols-12 pt-6 card gap-x-6 gap-y-2">
  @csrf
  @method('PUT')

  {{-- CONFIRM AUTHOR --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('confirm_author', $manuscript->confirm_author ?? '')) }">
    <x-text-input x-model="show" type="radio" :options="[
        [
            'label' => 'I am the sole author',
            'value' => false,
        ],
        [
            'label' => 'I have a Co-author',
            'value' => true,
        ],
    ]"
      label="Please confirm that you have entered the details of all your co-authors as these cannot be added to a paper once submitted or post-acceptance."
      id="confirm_author" name="confirm_author" required :messages="$errors->get('confirm_author')"></x-text-input>

    {{-- SEARCH AUTHORS --}}

    <x-text-input x-show="show" class="col-span-12 xl:col-span-12" type="search" label="Add Author" id="search_author"
      name="search_author" :value="old('search_author', $manuscript->search_author ?? '')" :messages="$errors->get('search_author')">
      @slot('icon')
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M15.5 12c2.5 0 4.5 2 4.5 4.5c0 .88-.25 1.71-.69 2.4l3.08 3.1L21 23.39l-3.12-3.07c-.69.43-1.51.68-2.38.68c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5m0 2a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5M10 4a4 4 0 0 1 4 4c0 .91-.31 1.75-.82 2.43c-.86.32-1.63.83-2.27 1.47L10 12a4 4 0 0 1-4-4a4 4 0 0 1 4-4M2 20v-2c0-2.12 3.31-3.86 7.5-4c-.32.78-.5 1.62-.5 2.5c0 1.29.38 2.5 1 3.5z" />
        </svg>
      @endslot
      @slot('ext')
        <button type="button" class="button primary">Add Manually</button>
      @endslot
    </x-text-input>
  </div>

  {{-- SELECT AUTHORS --}}
  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('select_authors', $manuscript->select_authors ?? '')) }">
    <x-table :columns="[
        ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
        ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
        ['label' => 'ACTIONS', 'name' => 'ACTIONS', 'isSortable' => false],
    ]">

      <tr>
        @php
          $user = Auth::user();
        @endphp
        <td class="flex flex-col items-start px-6 py-2 truncate max-w-64px">
          <h3 class="text-base font-bold">{{ $user->getFullName() }}</h3>
          <p class="text-sm italic">(Corresponding Author)</p>
          <p class="mt-4">{{ $user->email }}</p>
          @if ($user->ordcid_id)
            <a href="https://orcid.org/{{ $user->ordcid_id }}">{{ $user->ordcid_id }}</a>
          @endif
        </td>
        <td class="px-6 py-2"> {{ $user->institution }} </td>
        <td class="px-1 py-2"></td>
      </tr>
    </x-table>
  </div>

</form>

{{-- MODAL ADD Co-Author MANUALLY --}}
<x-modal name="add-coauthor-manually" focusable>

  <div class="relative self-start w-full lg:w-[760px] md:min-w-96 sm:max-h-full sm:self-center">
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
          class="flex items-start justify-between w-full p-5 border-b rounded-t dark:border-gray-700 dark:bg-gray-800">
          <h3 id="modal-title" class="text-xl font-semibold dark:text-white"
            x-text="index >= 0 ? 'Edit Funder' : 'Add Funder'"></h3>
        </div>

        {{-- Modal body  --}}
        <div class="p-6 mt-0 space-y-6">

          <form action="{{ route('profile.update', absolute: false) }}" method="POST" class="space-y-6">
            <div class="divide-y-2 divide-gray-200 card dark:divide-gray-700">
              <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  {{ __('Personal Information') }}
                </h2>

              </header>
              <div class="grid max-w-screen-xl grid-cols-12 pt-6 gap-x-6 gap-y-2">
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

            <div class="divide-y-2 divide-gray-200 card dark:divide-gray-700">
              <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                  {{ __('Institution Related Information') }}
                </h2>
              </header>

              <div class="grid max-w-screen-xl grid-cols-12 pt-6 gap-x-6 gap-y-2">
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
        <div class="flex items-center gap-2 p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
          <button id="submit-modal-btn" class="button primary" type="submit"
            x-text="index >= 0 ? 'Update' : 'Add'"></button>
          <button type="button" x-on:click.prevent="$dispatch('close')" class="button secondary">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>

</x-modal>
