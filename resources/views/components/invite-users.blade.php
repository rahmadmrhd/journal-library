@props([
    'users' => [],
    'name' => 'users',
    'role' => 'author',
    'label' => 'User',
    'labelBox',
    'isReadOnly' => false,
    'disabled' => false,
    'subGate',
    'maxInvite',
    'minInvite' => 0,
    'excepts' => [],
    'canOrder' => false,
])

@php
  $users = collect($users)->map(function ($user) {
      $user->full_name = $user->getFullName();
      return $user;
  });
@endphp


<div {{ $attributes }} x-data="{
    users: Object.values(@js($users ?? [])),
    listUsers: [],
    inputFocused: false,
    dropdownFocused: false,
    search: '',
    sortUser(users, item, position) {
        const oriPos = this.users.findIndex((f) => f.id == item.data.id);
        const length = this.users.length;
        const newUsers = [...this.users]

        if (oriPos > position) {
            for (let i = position; i < oriPos; i++) {
                newUsers[i].index += 1
            }
            newUsers[oriPos].index = position
        } else {
            for (let i = oriPos + 1; i <= position; i++) {
                newUsers[i].index -= 1
            }
            newUsers[oriPos].index = position
        }
        return newUsers.sort((a, b) => a.index - b.index)
    },
}" x-init="$watch('search', val => searchUsers(@js($subGate->toArray()), val, [...Object.values(@js($excepts)), ...users.map(x => x.id)], @js($role), (result) => listUsers = result));
$watch('inputFocused', val => {
    if (val && !search) {
        searchUsers(@js($subGate->toArray()), search, [...Object.values(@js($excepts)), ...users.map(x => x.id)], @js($role), (result) => listUsers = result);
    }
});">
  {{-- SEARCH USER --}}
  @if (!$isReadOnly && !$disabled)
    <div class="relative mb-3 w-full">
      <x-text-input class="col-span-12 xl:col-span-12" type="search" :label="$labelBox ?? null" id="search_user"
        x-bind:placeholder="`Search ` + '{{ $label }}'" description="Search by name, email, username, or ORCID"
        name="search_user" x-on:focus="inputFocused=true" x-on:focusout="inputFocused=false"
        x-model.debounce.500ms="search" x-ref="search"
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
      </x-text-input>
      <p x-show="users.length < @js($minInvite)" class="mt-1 text-sm text-red-600 dark:text-red-400">Please invite
        more than or equal {{ $minInvite }}</p>
      {{-- dropdown --}}
      <div focusable x-show="(dropdownFocused||inputFocused) && listUsers.length > 0"
        x-on:mouseover="dropdownFocused=true" x-on:mouseleave="dropdownFocused=false"
        class="absolute z-10 mt-1 h-auto w-full rounded-lg bg-gray-50 px-4 pb-2 shadow-md dark:bg-gray-700">
        <x-table :columns="[
            ['label' => $label, 'name' => $name, 'isSortable' => false],
            ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
        ]">
          <template x-for="user in listUsers.filter(key => users.indexOf(key) < 0)">
            <tr
              class="cursor-pointer border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600"
              x-on:click.prevent.stop="
              if(users.findIndex(key => key.id == user.id) < 0 && user.id != @js(request()->user()->id)){
              users.push(user); 
              listUsers.splice(listUsers.findIndex(key => key.id == user.id), 1);
              $refs.search.value=''; 
              $refs.search.focus();
            }else{
              showAlert('error', { messages: 'User has already been added!', closeable: true, timeout: 5000 });
            }">
              <td valign="top" class="max-w-64px truncate px-6 py-2">
                <div class="flex flex-col items-start">
                  <h3 class="text-base font-bold" x-text="user.full_name"></h3>
                  <p class="mt-4 text-sm font-normal" x-text="user.email"></p>
                  <template x-if="user.orcid_id">
                    <div class="mt-2 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                      </svg>
                      <p x-text="user.orcid_id" class="text-sm font-normal">
                      </p>
                    </div>
                  </template>
                </div>
              </td>
              <td valign="top" class="px-6 py-2">
                <div class="flex flex-col items-start">
                  <p class="text-sm font-bold"
                    x-text="`${user.institution ? `${user.institution}, ` : ''}${user.department ? `${user.department}, ` : ''}${user.position??''}`">
                  </p>
                  <p class="text-sm font-normal" x-text="user.address"></p>
                  <p class="text-sm font-normal"
                    x-text="`${user.city ? `${user.city}, ` : ''}${user.province ? `${user.province}, ` : ''}${user.country ? `${user.country}, ` : ''}${user.postal_code ? `ID ${user.postal_code}` : ''}`">
                  </p>
                </div>
              </td>
            </tr>
          </template>
        </x-table>
      </div>
    </div>
  @endif

  <template x-if="users.length > 0">
    <x-table :columns="[
        ...$isReadOnly || $disabled ? [] : [['label' => ' ', 'isSortable' => false]],
        ...$disabled || !($canOrder || $isReadOnly) ? [] : [['label' => 'status', 'isSortable' => false]],
        ['label' => $label, 'name' => $name, 'isSortable' => false],
        ['label' => 'INSTITUTION', 'name' => 'institution', 'isSortable' => false],
    ]">
      @if (!($isReadOnly || $disabled) && $canOrder)
        <x-slot name="tbody" x-sort="users=[...sortUser(users, $item, $position)]">
      @endif
      <template x-for="(user, index) in users" :key="user.id + index">
        <tr x-sort:item="{data:user, el:$el}" x-init="$nextTick(() => user.index = index)"
          class="@if (!$isReadOnly) @endif border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">

          @if (!$disabled)
            @if (!$isReadOnly)
              <td x-sort:handle class="w-[1%] whitespace-nowrap p-4">
                <div class="flex items-center space-x-1">
                  @if ($canOrder)
                    <button title="" x-sort:handle type="button" class="button !p-1 focus:!ring-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M7 19v-2h2v2zm4 0v-2h2v2zm4 0v-2h2v2zm-8-4v-2h2v2zm4 0v-2h2v2zm4 0v-2h2v2zm-8-4V9h2v2zm4 0V9h2v2zm4 0V9h2v2zM7 7V5h2v2zm4 0V5h2v2zm4 0V5h2v2z" />
                      </svg>
                    </button>
                  @endif
                  <button type="button" class="button error !p-2"
                    x-on:click.stop="users.splice(users.findIndex((f)=>f.id == user.id), 1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                    </svg>
                  </button>
                </div>
              </td>
            @else
              <td class="w-[1%] text-center">
                <span x-show="user.pivot.status == 'invited'" class="badge primary">
                  <span class="text-white">Waiting</span>
                </span>
                <span x-show="user.pivot.status == 'rejected'" class="badge error">
                  <span class="text-white">Rejected</span>
                </span>
                <span x-show="user.pivot.status == 'accepted'" class="badge success">
                  <span class="text-white">Accepted</span>
                </span>
                <span x-show="user.pivot.status == 'expired'" class="badge secondary">
                  <span class="text-white">No Response</span>
                </span>
                {{-- <span x-show="user.pivot.'" class="badge error">
                  <span class="text-white">Expired</span>
                </span> --}}
              </td>
            @endif
            @if ($canOrder)
              <td class="w-[1%] truncate text-center">
                <span class="badge"
                  x-bind:class="((index + 1) <= ((@js($maxInvite ?? null)) ?? users.length)) ? 'primary' : 'secondary'">
                  <span
                    x-text="((index + 1) <= ((@js($maxInvite ?? null)) ?? users.length)) ? 'Primary':'Alternative'"></span>
                  <input type="hidden" x-bind:name="`users[${index}][status]`"
                    x-bind:value="((index + 1) <= ((@js($maxInvite ?? null)) ?? users.length)) ? 'primary' : 'alternative'">
                </span>
              </td>
            @endif
          @endif
          <td valign="top" class="max-w-64px truncate px-6 py-2">
            <div class="flex flex-col items-start">
              @if ($canOrder)
                <input type="hidden" x-bind:name="`users[${index}][order]`" x-model="user.index">
              @endif
              <input type="hidden" x-bind:name="`users[${index}][id]`" x-model="user.id">
              <h3 class="text-base font-bold" x-text="user.full_name"></h3>
              <p class="mt-6 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline"
                x-text="user.email"></p>
              <template x-if="user.orcid_id">
                <div class="mt-2 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                  </svg>
                  <p x-text="user.orcid_id"
                    class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                  </p>
                </div>
              </template>
            </div>
          </td>
          <td valign="top" class="px-6 py-2">
            <div class="flex flex-col items-start">
              <p class="text-sm font-bold" x-text="`${user.institution ? `${user.institution}, ` : ''}`">
              </p>
              <p class="text-sm" x-text="`${user.department ? `${user.department}, ` : ''}${user.position??''}`">
              </p>
              <p class="mt-3 text-sm font-normal" x-text="user.address"></p>
              <p class="text-sm font-normal"
                x-text="`${user.city ? `${user.city}, ` : ''}${user.province ? `${user.province}, ` : ''}${user.country?.name ? `${user.country?.name}, ` : ''}${user.postal_code ? `ID ${user.postal_code}` : ''}`">
              </p>
            </div>
          </td>
        </tr>
      </template>

      @if (!($isReadOnly || $disabled) && $canOrder)
        </x-slot>
      @endif
    </x-table>
  </template>
  @vite('resources/js/components/invite-users.js')
</div>
