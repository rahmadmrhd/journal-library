@php
  $manuscript = $manuscript ?? (object) [];
  $manuscript->isShow = isset($manuscript->isShow) ? $manuscript->isShow : false;
  $manuscript->isReview = $manuscript->isReview ?? $manuscript->isShow;
@endphp

<form id="manuscript-form"
  action="{{ route('manuscripts.storeDetails', ['subGate' => $manuscript->subGate->slug ?? $subGate->slug, 'manuscript' => $manuscript->id]) }}"
  method="POST" class="grid grid-cols-12 gap-x-6 gap-y-3" x-data="{
      showCoverLetter: @js($manuscript->isConfirmed ? (isset($manuscript->cover_letter) ? 1 : '') : null),
      coverLetterEditor: null
  }">
  @csrf
  @method('PUT')

  @if (!$manuscript->isShow)
    {{-- COVER LETTER --}}
    <div class="col-span-12">
      <x-text-input :disabled="$manuscript->isReview" x-model="showCoverLetter" type="radio" :options="[
          [
              'label' => 'Yes',
              'value' => true,
          ],
          [
              'label' => 'No',
              'value' => false,
          ],
      ]" label="Use Cover Letter?"
        id="has-cover-letter" name="has-cover-letter" required></x-text-input>
      <template x-if="showCoverLetter">
        <x-text-editor class="mt-2" name="cover_letter" required variable="coverLetterEditor" :disabled="$manuscript->isReview"
          :initValue="$manuscript->cover_letter ?? null">

        </x-text-editor>
      </template>
    </div>
    {{-- 
  <x-text-input  :disabled="$manuscript->isReview" class="col-span-12" type="textarea" label="Write Cover Letter" id="cover_letter" name="cover_letter"
    :value=" $manuscript->cover_letter ?? null" required :messages="$errors->get('cover_letter')"></x-text-input> --}}

    {{-- FUNDING --}}

    <div class="col-span-12" x-data="{
        show: null,
        funders: Object.values(@js($manuscript->funders ?? [])),
    }" x-init="show = @js($manuscript->isConfirmed) ? (funders.length > 0 ? 1 : '') : null"
      x-on:add-funder.window="funders.push($event.detail)"
      x-on:update-funder.window="funders[$event.detail.index]={name:$event.detail.name, grants:$event.detail.grants}"
      x-on:submit-remove-all-funders.window="show = ''; funders = []">
      <x-text-input :disabled="$manuscript->isReview" x-model="show" type="radio" :options="[
          [
              'label' => 'Yes',
              'value' => true,
          ],
          [
              'label' => 'No',
              'value' => false,
          ],
      ]" label="Funding" id="funder"
        name="funder" required
        x-on:click="
      if(event.target.value != 1 && funders.length > 0){
        $dispatch('open-modal', 'modal-confirm-remove-all-funders');
        event.preventDefault();
      }"></x-text-input>
      <template x-if="show">
        <div>
          <button type="button" class="button success my-2" x-on:click="$dispatch('open-modal', 'modal_funder')">ADD
            FUNDER</button>
          <x-table class="my-2" x-show="funders.length > 0" :columns="[
              ...$manuscript->isReview ? [] : [['label' => 'ACTIONS', 'name' => 'ACTIONS', 'isSortable' => false]],
              ['label' => 'FUNDER', 'name' => 'FUNDER', 'isSortable' => false],
              [
                  'label' => 'GRANT / AWARD NUMBER',
                  'name' => 'GRANT / AWARD NUMBER',
                  'isSortable' => false,
              ],
          ]">
            <template x-for="(funder,index) in funders" @:key="index">
              <tr
                class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                @if (!isset($manuscript->isReview))
                  <td class="w-[1%] px-6 py-2">
                    <div class="flex gap-2">
                      <button type="button" class="button primary !p-2"
                        x-on:click="$dispatch('open-modal', 'modal_funder');const idx=funders.findIndex((f)=>f.name==funder.name);$dispatch('edit-funder', {...funder, grants:[...funder.grants],index:idx})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z" />
                        </svg>
                      </button>
                      <button type="button" class="button error !p-2"
                        x-on:click="funders.splice(funders.findIndex((f)=>f.name==funder.name), 1)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                        </svg>
                      </button>
                    </div>
                  </td>
                @endif
                <td class="px-6 py-2">
                  <p x-text="funder.name"></p>
                  <input type="hidden" x-bind:name="`funders[${index}][id]`" x-bind:value="funder.id">
                  <input type="hidden" x-bind:name="`funders[${index}][name]`" x-bind:value="funder.name">
                </td>
                <td class="px-10 py-2">
                  <ul class="list-disc">
                    <template x-for="grant in funder.grants">
                      <li>
                        <p x-text="grant"></p>
                        <input type="hidden" x-bind:name="`funders[${index}][grants][]`" x-bind:value="grant">
                      </li>
                    </template>
                  </ul>
                </td>
              </tr>
            </template>
          </x-table>
        </div>
      </template>
    </div>

    {{-- SUBMITTED MANUSCRIPT --}}

    <div class="col-span-12" x-data="{ show: @js($manuscript->isConfirmed ? $manuscript->parent_id ?? '' : null) }">
      <x-text-input :disabled="$manuscript->isReview" x-model="show" type="radio" :options="[
          [
              'label' => 'Yes',
              'value' => true,
          ],
          [
              'label' => 'No',
              'value' => false,
          ],
      ]"
        label="Has this manuscript been submitted previously?" id="has_manuscript_before" name="has_manuscript_before"
        required></x-text-input>
      <template x-if="show">
        <x-text-input :disabled="$manuscript->isReview" class="col-span-12" type="text"
          label="What is the manuscript ID of the previous submission?" id="parent_id" name="parent_id"
          required></x-text-input>
      </template>
    </div>
  @endif
  <x-custom-forms class="col-span-12" :readonly="$manuscript->isReview" :fields="$manuscript->responses">

  </x-custom-forms>

</form>

{{-- MODAL FUNDER --}}

<x-modal name="modal_funder" focusable>
  <div class="md:min-w-96 relative w-full self-start sm:max-h-full sm:w-[540px] sm:self-center lg:w-[760px]">
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
        x-on:edit-funder.window="name = $event.detail.name; grants = $event.detail.grants; index = $event.detail.index; console.log('edit', $event.detail)"
        x-on:submit.prevent="
        index >= 0 ? $dispatch('update-funder', {name:name, grants:[...grants], index:index}) :
        $dispatch('add-funder', {name:name, grants:[...grants]});
        $dispatch('close')">
        {{-- Modal header  --}}
        <div
          class="flex w-full items-start justify-between rounded-t border-b p-5 dark:border-gray-700 dark:bg-gray-800">
          <h3 id="modal-title" class="text-xl font-semibold dark:text-white"
            x-text="index >= 0 ? 'Edit Funder' : 'Add Funder'"></h3>
        </div>

        {{-- Modal body  --}}
        <div class="mt-0 space-y-6 p-6">

          <x-text-input :disabled="$manuscript->isReview" x-model="name" type="text" label="Funder Name" id="funder_name"
            name="funder_name" required></x-text-input>

          <template x-for="grant in grants">
            <x-text-input :disabled="$manuscript->isReview" type="text" label="Grant / Award Number" id="funder_grant"
              name="funder_grant[]" x-bind:value="grant"
              x-on:change="grants[grants.indexOf(grant)] = $event.target.value" required>
              @slot('ext')
                <button x-show="grants.length > 1" type="button" class="button error !px-2"
                  x-on:click="grants.splice(grants.indexOf(grant), 1)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                  </svg>
                </button>
              @endslot
            </x-text-input>
          </template>
          <button type="button" class="button success" x-on:click="grants.push('')">Add Another Grant /
            Award</button>

        </div>

        {{-- Modal footer  --}}
        <div class="flex items-center gap-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-700">
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

{{-- MODAL CONFIRM REMOVE ALL FUNDERS --}}
<x-modal name="modal-confirm-remove-all-funders" focusable>
  <div class="max-w-2xl p-4 text-center md:p-5">
    <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
      {{ __('Do you really want to remove all funders?') }}
    </h3>
    <div class="flex justify-center gap-3">
      <button id="submit-modal-btn" type="button" class="button error"
        x-on:click="$dispatch('close'); $dispatch('submit-remove-all-funders')">
        {{ __('Yes, Remove all funders') }}
      </button>
      <button id="cancel-modal-btn" type="button" x-on:click="$dispatch('close')" class="button secondary">
        {{ __('Cancel') }}
      </button>
    </div>
  </div>
</x-modal>
