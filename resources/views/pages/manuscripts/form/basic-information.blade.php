@push('head')
  <meta name="_token" content="{{ csrf_token() }}">
@endpush
<form id="manuscript-form" method="POST"
  action="{{ route('manuscripts.storeBasicInformation', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id]) }}"
  class="flex flex-col gap-y-3">
  @csrf
  @method('PUT')
  <x-text-input class="col-span-12" type="textarea" rows="2" label="Title" id="title" name="title" required
    :disabled="$manuscript->isReview" autofocus :status="$errors->has('title') ? 'error' : ''" :messages="$errors->get('title')" :value="old('title', $manuscript->title ?? '')" />

  <x-text-input class="col-span-12" type="select" label="Please choose a category for your paper" id="category_id"
    name="category_id" :disabled="$manuscript->isReview" required autofocus :status="$errors->has('category_id') ? 'error' : ''" :messages="$errors->get('category_id')" :value="old('category_id', $manuscript->category->id ?? '')">
    <option selected disabled>-- Select Category --</option>
    @if ($manuscript->isReview && isset($manuscript->category->id))
      <option value="{{ $manuscript->category->id }}" disabled selected>{{ $manuscript->category->name }}</option>
    @else
      @foreach ($categories as $category)
        <option value="{{ $category->id }}"
          {{ old('category_id', $manuscript->category->id ?? '') == $category->id ? 'selected' : '' }}>
          {{ $category->name }}</option>
      @endforeach
    @endif
  </x-text-input>

  <x-text-input class="col-span-12" type="textarea" rows="5" label="Abstract" id="abstract" name="abstract"
    :disabled="$manuscript->isReview" required autofocus :status="$errors->has('abstract') ? 'error' : ''" :messages="$errors->get('abstract')" :value="old('abstract', $manuscript->abstract ?? '')" />

  <div class="relative w-full" x-data="{
      keywords: @js(old('keywords', $manuscript->keywords ?? [])),
      optionsKeyword: [],
      inputFocused: false,
      dropdownFocused: false,
      search: '',
  }" x-init="$watch('search', val => searchKeywords(val, (result) => optionsKeyword = result))">
    <x-text-input class="col-span-12" type="custom" rows="5" label="Keywords" required :status="$errors->has('keywords') ? 'error' : ''"
      :messages="$errors->get('keywords')" :disabled="$manuscript->isReview" description="Press enter to add more keywords">
      <ul class="input-text !flex w-full max-w-full !flex-wrap gap-2 p-2" focusable
        x-on:click="$refs.keywordInput.focus()">
        <template x-for="keyword in keywords" key="index">
          <li class="flex w-fit max-w-full items-center !rounded-full bg-white shadow-md dark:bg-gray-600">
            <span x-text="keyword"
              class="@if (!$manuscript->isReview) border-r @endif text-ellipsis border-gray-100 px-2 py-1 text-sm dark:border-gray-700"></span>
            @if (!$manuscript->isReview)
              <button type="button" x-on:click.prevent="keywords.splice(keywords.indexOf(keyword), 1)"
                class="button mr-1 border-none !p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
                </svg>
              </button>
            @endif
            <input type="checkbox" class="hidden" name="keywords[]" x-bind:value="keyword" x-model="keywords">
          </li>
        </template>
        <input {!! $manuscript->isReview ? 'disabled' : '' !!}
          class="flex-[1_1_auto] !border-none bg-gray-50 !py-0 text-sm text-gray-900 !outline-none !ring-0 dark:!bg-gray-700 dark:!text-white"
          type="text" x-ref="keywordInput" id="keywordsDropdownTrigger" x-on:focus="inputFocused=true"
          x-on:focusout="inputFocused=false" x-model.debounce.500ms="search"
          x-on:keydown="
            inputFocused=true;
            if(event.keyCode==13 && $el.value && keywords.indexOf($el.value)==-1 && $el.value.length >= 3){
              keywords.push($el.value); 
              $el.value='';
            }
            if((event.keyCode==8 || event.keyCode==46) && !$el.value){
              keywords.pop();
            } 
            if(!(/[0-9a-zA-Z\-\_\s]/i.test(event.key)) || event.keyCode==13) {
              event.preventDefault();
            }">
      </ul>
      {{-- dropdown --}}
      <div focusable id="dropdownUsers" x-show="dropdownFocused||inputFocused" x-on:mouseover="dropdownFocused=true"
        x-on:mouseleave="dropdownFocused=false"
        class="top absolute z-10 mt-1 h-auto w-full rounded-lg bg-white shadow dark:bg-gray-700">
        <ul
          class="max-h-48 divide-y divide-gray-100 overflow-y-auto text-gray-700 dark:divide-gray-600 dark:text-gray-200"
          aria-labelledby="keywordsDropdownTrigger">
          <template x-for="keyword in optionsKeyword.filter(key => keywords.indexOf(key) < 0)">
            <li>
              <button type="button" class="button w-full !normal-case"
                x-on:click.prevent.stop="keywords.push(keyword); $refs.keywordInput.value=''; $refs.keywordInput.focus()">
                <span x-text="keyword"></span>
              </button>
            </li>
          </template>
        </ul>
      </div>
    </x-text-input>
  </div>
</form>

@vite(['resources/js/form-submission/basic-information.js'])
