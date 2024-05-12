<form id="manuscript-form" action="" method="POST" class="grid grid-cols-12 pt-6 card gap-x-6 gap-y-2">
  @csrf
  @method('PUT')

  {{-- ---- --}}
  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('select_authors', $manuscript->select_authors ?? '')) }">
    <x-table :columns="[
        ['label' => 'ORDER', 'name' => 'ORDER', 'isSortable' => false],
        ['label' => 'ACTIONS', 'name' => 'ACTIONS', 'isSortable' => false],
        ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
        ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
    ]">

      <tr>
        <td class="px-1 py-2">

          <x-text-input type="select" id="order"
            name="order" required :messages="$errors->get('order')">
            <option disabled selected>Select an order</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </x-text-input>

        </td>
        <td class="px-1 py-2">

          <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ADD</button>
          <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">DELETE</button>

        </td>
        <td class="px-6 py-2"> AUTHOR </td>
        <td class="px-6 py-2"> INSTITUTION </td>
      </tr>
    </x-table>
  </div>

{{-- ---- --}}

  <x-text-input class="col-span-12 xl:col-span-12" type="search" label="Add Author" id="search_author"
    name="search_author" :value="old('search_author', $manuscript->search_author ?? '')" required :messages="$errors->get('search_author')" ></x-text-input>

    {{-- ---- --}}

  <div class="col-span-12 xl:col-span-12" x-data="{ show: @js(old('confirm_author', $manuscript->confirm_author ?? '')) }">
    <x-text-input type="radio" :options="[
        [
            'label' => 'I am the sole author',
            'value' => true,
        ],
        [
            'label' => 'All co-authors have been added',
            'value' => false,
        ],
    ]"
      label="Please confirm that you have entered the details of all your co-authors as these cannot be added to a paper once submitted or post-acceptance."
      id="confirm_author" name="confirm_author" required :messages="$errors->get('confirm_author')"></x-text-input>
  </div>
</form>
