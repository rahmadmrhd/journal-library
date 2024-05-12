<form id="manuscript-form" action="" method="POST" class="grid grid-cols-12 pt-6 card gap-x-6 gap-y-2">
  @csrf
  @method('PUT')

  {{-- ---- --}}

  <x-text-input class="col-span-12 xl:col-span-12" type="textarea" label="Write Cover Letter" id="cover_letter"
    name="cover_letter" :value="old('cover_letter', $manuscript->cover_letter ?? '')" required :messages="$errors->get('cover_letter')"></x-text-input>

  {{-- ---- --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('funding', $manuscript->funding ?? '')) }">
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
    <x-table x-show="show" :columns="[
        ['label' => 'ACTIONS', 'name' => 'ACTIONS', 'isSortable' => false],
        ['label' => 'FUNDER', 'name' => 'FUNDER', 'isSortable' => false],
        [
            'label' => 'GRANT / AWARD NUMBER',
            'name' => 'GRANT / AWARD NUMBER',
            'isSortable' => false,
        ],
    ]">

      <tr>
        <td class="px-1 py-2">

          <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ADD</button>
          <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">DELETE</button>

        </td>
        <td class="px-6 py-2">

          <x-text-input class="col-span-12 xl:col-span-12" type="text" id="funder"
            name="funder" :value="old('funder', $manuscript->funder ?? '')" required :messages="$errors->get('funder')"></x-text-input>

        </td>
        <td class="px-6 py-2">

          <x-text-input class="col-span-12 xl:col-span-12" type="text" id="grant"
            name="grant" :value="old('grant', $manuscript->grant ?? '')" required :messages="$errors->get('grant')"></x-text-input>

        </td>
      </tr>
    </x-table>
  </div>

  {{-- ---- --}}

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
    <x-text-input x-show="show" class="col-span-12 xl:col-span-12" type="text"
      label="what is the manuscript ID of the previous submission?" id="id_manuscript" name="id_manuscript"
      :value="old('id_manuscript', $manuscript->id_manuscript ?? '')" required :messages="$errors->get('id_manuscript')"></x-text-input>
  </div>

  {{-- ---- --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('confirm_following', $manuscript->confirm_following ?? '')) }">
    <x-text-input type="checkbox" :options="[
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
    ]" label="Confirm the following:" id="confirm_following"
      name="confirm_following" required :messages="$errors->get('confirm_following')"></x-text-input>
  </div>

  {{-- ---- --}}

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

  {{-- ---- --}}

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

  {{-- ---- --}}

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

  {{-- ---- --}}

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

  {{-- ---- --}}

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

  {{-- ---- --}}

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
