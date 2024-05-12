<form id="manuscript-form" action="" method="POST" class="grid grid-cols-12 pt-6 card gap-x-6 gap-y-2">
  @csrf
  @method('PUT')

  {{-- COVER LETTER --}}

  <x-text-input class="col-span-12 xl:col-span-12" type="textarea" label="Write Cover Letter" id="cover_letter"
    name="cover_letter" :value="old('cover_letter', $manuscript->cover_letter ?? '')" required :messages="$errors->get('cover_letter')"></x-text-input>

  {{-- FUNDING --}}

  <div class="col-span-12 xl:col-span-12" x-data="{
      show: @js(old('funding', $manuscript->funding ?? '')),
      fundings: @js($manuscript->funding ?? []),
  }" x-on:add-funding.window="fundings.push($event.detail)"
    x-on:update-funding.window="fundings[$event.detail.index]={name:$event.detail.name, grants:$event.detail.grants}">
    <x-text-input x-model="show" type="radio" :options="[
        [
            'label' => 'Yes',
            'value' => true,
        ],
        [
            'label' => 'No',
            'value' => false,
        ],
    ]" label="Funding" id="funding" name="funding" required
      :messages="$errors->get('funding')"></x-text-input>

    <button x-show="show" type="button" class="mb-2 button success"
      x-on:click="$dispatch('open-modal', 'modal_funder')">ADD
      FUNDER</button>
    <x-table x-show="fundings.length>0" :columns="[
        ['label' => 'ACTIONS', 'name' => 'ACTIONS', 'isSortable' => false],
        ['label' => 'FUNDER', 'name' => 'FUNDER', 'isSortable' => false],
        [
            'label' => 'GRANT / AWARD NUMBER',
            'name' => 'GRANT / AWARD NUMBER',
            'isSortable' => false,
        ],
    ]">
      <template x-for="funding in fundings">
        <tr>
          <td class="px-1 py-2">
            <button type="button" class="button primary"
              x-on:click="$dispatch('open-modal', 'modal_funder');const idx=fundings.findIndex((f)=>f.name==funding.name);$dispatch('edit-funding', {...funding,index:idx})">EDIT</button>
            <button type="button" class="button error"
              x-on:click="fundings.splice(fundings.findIndex((f)=>f.name==funding.name), 1)">DELETE</button>
          </td>
          <td class="px-6 py-2" x-text="funding.name"></td>
          <td class="px-6 py-2">
            <ul class="list-disc">
              <template x-for="grant in funding.grants">
                <li x-text="grant"></li>
              </template>
            </ul>
          </td>
        </tr>
      </template>
    </x-table>
  </div>

  {{-- SUBMITTED MANUSCRIPT --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('submitted', $manuscript->submitted ?? '')) }">
    <x-text-input x-model="show" type="radio" :options="[
        [
            'label' => 'Yes',
            'value' => true,
        ],
        [
            'label' => 'No',
            'value' => false,
        ],
    ]" label="Has this manuscript been submitted previously?"
      id="submitted" name="submitted" required :messages="$errors->get('submitted')"></x-text-input>
    <template x-if="show">
      <x-text-input class="col-span-12 xl:col-span-12" type="text"
        label="what is the manuscript ID of the previous submission?" id="id_manuscript" name="id_manuscript"
        :value="old('id_manuscript', $manuscript->id_manuscript ?? '')" required :messages="$errors->get('id_manuscript')"></x-text-input>
    </template>
  </div>

  {{-- CONFIRM FOLLOWING --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('confirm_following', $manuscript->confirm_following ?? '')) }">
    <x-text-input direction="col" type="checkbox" :options="[
        [
            'label' =>
                'Confirm that the manuscript has been submitted solely to this journal and is not published, in press, or submitted elsewhere.',
            'value' => true,
        ],
        [
            'label' =>
                'Confirm that all of the research meets the ethical guidelines of your institution or company, as well as adherence to the legal requirements of the study country.',
            'value' => true,
        ],
        [
            'label' =>
                'Confirm that you have prepared a complete text within the anonymous article file. Any identifying information has been included separately in a title page, acknowledgements or supplementary file not for review, to allow anonymous review.',
            'value' => true,
        ],
    ]" label="Confirm the following:"
      id="confirm_following" name="confirm_following" required :messages="$errors->get('confirm_following')"></x-text-input>
  </div>

  {{-- DECLARED POTENTIAL --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('potential_conflict', $manuscript->potential_conflict ?? '')) }">
    <x-text-input type="radio" :options="[
        [
            'label' => 'Yes',
            'value' => true,
        ],
        [
            'label' => 'No',
            'value' => false,
        ],
    ]"
      label="I/We have declared any potential conflict of interest in the research. Any support from a third party has been noted in the Acknowledgements."
      id="potential_conflict" name="potential_conflict" required :messages="$errors->get('potential_conflict')"></x-text-input>
  </div>

  {{-- CONFIRM AI TOOL --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('AI_tool', $manuscript->AI_tool ?? '')) }">
    <x-text-input type="checkbox" required :options="[
        [
            'label' =>
                'Confirm that the manuscript has been created by the author(s) and not an AI tool/Large Language Model (LLM). If an AI tool/LLM has been used to develop or generate any portion of the manuscript then this must be clearly flagged in the Methods and Acknowledgements.',
            'value' => true,
        ],
    ]" id="AI_tool" name="AI_tool" required
      :messages="$errors->get('AI_tool')"></x-text-input>
  </div>

  {{-- PAPER CONTAIN --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('paper_contain', $manuscript->paper_contain ?? '')) }">
    <x-text-input type="radio" :options="[
        [
            'label' => 'Yes',
            'value' => true,
        ],
        [
            'label' => 'No',
            'value' => false,
        ],
    ]"
      label="Does this paper contain a case study, or research conducted within an identifiable organization?"
      id="paper_contain" name="paper_contain" required :messages="$errors->get('paper_contain')"></x-text-input>
  </div>

  {{-- OPEN ACCESS --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('open_access', $manuscript->open_access ?? '')) }">
    <x-text-input type="radio" :options="[
        [
            'label' => 'Yes, I want to publish my article as Open Access',
            'value' => true,
        ],
        [
            'label' => 'No, I don’t want to publish Open Access',
            'value' => false,
        ],
    ]"
      label="Open Access: Indicate here your intention to publish your article as open access under a Creative Commons Attribution 4.0 Licence (CC BY) if it is accepted?"
      id="open_access" name="open_access" required :messages="$errors->get('open_access')"></x-text-input>
  </div>

  {{-- PAPERPAL --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('paperpal', $manuscript->paperpal ?? '')) }">
    <x-text-input type="radio" :options="[
        [
            'label' => 'Yes',
            'value' => true,
        ],
        [
            'label' => 'No',
            'value' => false,
        ],
    ]"
      label=" Have you downloaded and used the PaperPal pre flight report to help edit your submission?" id="paperpal"
      name="paperpal" required :messages="$errors->get('paperpal')"></x-text-input>
  </div>

  {{-- ISSUE --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('select_issue', $manuscript->select_issue ?? '')) }">
    <x-text-input type="select" label=" Please select the issue you are submitting to?" id="select_issue"
      name="select_issue" required :messages="$errors->get('select_issue')">
      <option disabled selected>Please select an option</option>
      <option value="Regular Issue">Regular Issue</option>
      <option value="The Great Reset. Oportunity or Threat">The Great Reset. Oportunity or Threat?</option>
      <option value="Closed to New Submission Covid-19 and Control of Humans and Society">Closed to New Submission
        Covid-19 and Control of Humans and Society</option>
    </x-text-input>
  </div>

</form>

{{-- MODAL FUNDER --}}

<x-modal name="modal_funder" focusable>
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

          <x-text-input x-model="name" type="text" label="Funder Name" id="funder_name" name="funder_name"
            required></x-text-input>

          <template x-for="grant in grants">
            <x-text-input type="text" label="Grant / Award Number" id="funder_grant" name="funder_grant[]"
              x-bind:value="grant" x-on:change="grants[grants.indexOf(grant)] = $event.target.value" required>
              @slot('ext')
                <button type="button" class="button error" x-on:click="grants.splice(grants.indexOf(grant), 1)">
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
