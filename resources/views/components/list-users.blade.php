@props(['users', 'name' => 'users', 'isReadOnly' => false])

<div {{ $attributes }} x-data="{ users: @js($users) }">
  <x-table :columns="[
      ['label' => $name, 'name' => $name, 'isSortable' => false],
      ['label' => 'INSTITUTION', 'name' => 'institution', 'isSortable' => false],
      ...$isReadOnly ? [] : [['label' => ' ', 'isSortable' => false]],
  ]">
    <template x-for="(author, index) in users">
      <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
        <td valign="top" class="max-w-64px truncate px-6 py-2">
          <div class="flex flex-col items-start">
            <input type="hidden" name="{{ $name }}Id[]" x-model="author.id">
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
        @if (!$isReadOnly)
          <td class="w-[100px] space-x-1 whitespace-nowrap p-4">
            <button type="button" class="button error !p-2"
              x-on:click.stop="users.splice(users.findIndex((f)=>f.id == author.id), 1)">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
              </svg>
            </button>
          </td>
        @endif
      </tr>
    </template>
  </x-table>
</div>
