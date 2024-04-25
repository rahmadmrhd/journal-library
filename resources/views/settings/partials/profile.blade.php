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
      <x-text-input class="col-span-12 sm:col-span-4 xl:col-span-2" :label="__('Title')" id="title" name="title"
        type="text" :value="old('title', $user->title)" placeholder="(Dr., Mr., Mrs., etc.)" required autocomplete="title"
        :messages="$errors->get('title')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-8 xl:col-span-4" :label="__('First Name')" id="first_name" name="first_name"
        type="text" :value="old('first_name', $user->first_name)" required autocomplete="first_name" :messages="$errors->get('first_name')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-8 xl:col-span-4" :label="__('Last Name')" id="last_name" name="last_name"
        type="text" :value="old('last_name', $user->last_name)" autocomplete="last_name" :messages="$errors->get('last_name')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-4 xl:col-span-2" :label="__('Degree')" id="degree" name="degree"
        type="text" :value="old('degree', $user->degree)" autocomplete="degree" :messages="$errors->get('degree')"
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
        name="institution" type="text" :value="old('institution', $user->institution)" placeholder="(Dr., Mr., Mrs., etc.)" required
        autocomplete="institution" :messages="$errors->get('institution')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-6" :label="__('Department')" id="department" name="department"
        type="text" :value="old('department', $user->department)" required autocomplete="department" :messages="$errors->get('department')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-6" :label="__('Position')" id="position" name="position" type="text"
        :value="old('position', $user->position)" autocomplete="position" :messages="$errors->get('position')"></x-text-input>

      <x-text-input class="col-span-12" :label="__('Address')" id="address" name="address" type="textarea"
        :value="old('address', $user->address)" rows="2" required autocomplete="address" :messages="$errors->get('address')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-6 xl:col-span-4" :label="__('City')" id="city" name="city"
        type="text" :value="old('city', $user->city)" required autocomplete="city" :messages="$errors->get('city')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-6 xl:col-span-4" :label="__('State or Province')" id="province" name="province"
        type="text" :value="old('province', $user->province)" required autocomplete="province" :messages="$errors->get('province')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-6 xl:col-span-4" :label="__('Postal Code or Zip')" id="postal_code"
        name="postal_code" type="text" :value="old('postal_code', $user->postal_code)" required autocomplete="postal_code"
        :messages="$errors->get('postal_code')"></x-text-input>

      <x-text-input class="col-span-12 sm:col-span-9 xl:col-span-7" :label="__('Country')" id="country" name="country"
        type="select" :value="old('country', $user->country)" required autocomplete="country" :messages="$errors->get('country')">
        <x-slot name="options">
          <option value="" selected disabled>-- {{ __('Select Country') }} --</option>
          @foreach ($countries ?? [] as $country)
            <option value="{{ $country['code'] }}"
              {{ old('country', $user->country) == $country['code'] ? 'selected' : '' }}>
              {{ $country['name'] }}
            </option>
          @endforeach
        </x-slot>
      </x-text-input>

    </div>

  </div>
  <div class="divide-y-2 divide-gray-200 dark:divide-gray-700">
    <div class="flex items-center gap-4">
      <button class="button primary">Save</button>
    </div>
  </div>
</form>
