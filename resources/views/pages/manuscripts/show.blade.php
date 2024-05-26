@push('head')
  @vite('resources/css/manuscript.css')
@endpush
<x-app-layout sizeHideSidebar="xl" title="Detail Manuscript">
  <div id="alert-group">

  </div>
  <div class="card">
    <div class="border-b-2 border-gray-200 pb-2 dark:border-gray-700">
      <h1 class="text-xl font-extrabold sm:text-2xl lg:text-4xl">#{{ $manuscript->code }}</h1>
    </div>

    <div class="detail-box mt-6">
      <div class="row">
        <div class="column !text-base !font-bold">Title</div>
        <div class="column !text-base !font-bold">{{ $manuscript->title }}</div>
      </div>
      <div class="row">
        <div class="column">Category</div>
        <div class="column">{{ $manuscript->category->name }}</div>
      </div>
      <div class="row">
        <div class="column">Abstract</div>
        <div class="column">{{ $manuscript->abstract }}</div>
      </div>
      <div class="row">
        <div class="column">Keywords</div>
        <div class="column">
          <ul class="flex w-full max-w-full flex-wrap justify-end gap-2" focusable
            x-on:click="$refs.keywordInput.focus()">
            @foreach ($manuscript->keywords->pluck('name') as $keyword)
              <li
                class="flex w-fit max-w-full items-center !rounded-full border bg-gray-50 shadow-md dark:border-none dark:bg-gray-600">
                <span
                  class="text-ellipsis border-gray-100 px-2 py-1 text-sm dark:border-gray-700">{{ $keyword }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      @if ($manuscript->parent)
        <div class="row">
          <div class="column">The previously submitted Manuscript ID</div>
          <div class="column"><a href="{{ route('manuscripts.show', $manuscript->parent->id) }}"
              class="font-bold underline-offset-2 hover:text-blue-500 hover:underline">#{{ $manuscript->parent->code }}</a>
          </div>
        </div>
      @endif
    </div>
    @if ($manuscript->cover_letter)
      <div>
        <x-text-editor label="Cover Letter" class="mt-6" variable="coverLetterEditor" :disabled="true"
          :initValue="$manuscript->cover_letter ?? null">

        </x-text-editor>
      </div>
    @endif
    <x-tabs-panel class="mt-6" :withFragment="true" :tabs="[
        [
            'label' => 'Files',
            'name' => 'files',
        ],
        [
            'label' => 'Authors',
            'name' => 'authors',
        ],
        ...$manuscript->funders->count() > 0
            ? [
                [
                    'label' => 'Funding',
                    'name' => 'Funding',
                ],
            ]
            : [],
        [
            'label' => 'Details',
            'name' => 'details',
        ],
        [
            'label' => 'Timeline',
            'name' => 'timeline',
        ],
    ]">
      @php
        $manuscript->isShow = true;
      @endphp
      <x-slot name="files">
        @include('pages.manuscripts.form.upload-file')
      </x-slot>

      {{-- resources\views\pages\manuscripts\show.b/lade.php --}}
      <x-slot name="authors">
        <x-table :columns="[
            ['label' => 'AUTHOR', 'name' => 'AUTHOR', 'isSortable' => false],
            ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
            ...$manuscript->isReview ? [] : [['label' => ' ', 'isSortable' => false]],
        ]">
          @foreach ($manuscript->authors as $author)
            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
              <td valign="top" class="max-w-64px truncate px-6 py-2">
                <div class="flex flex-col items-start">
                  <h3 class="text-base font-bold">{{ $author->getFullName() }}</h3>
                  @if ($author->pivot->is_corresponding_author)
                    <p class="text-sm italic">(Corresponding Author)</p>
                  @endif
                  <a class="mt-4 text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">{{ $author->email }}
                  </a>
                  @if ($author->orcid_id)
                    <div class="mt-2 flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#a6ce39]" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12s12-5.372 12-12S18.628 0 12 0M7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947m-.722 3.038h1.444v10.041H6.647zm3.562 0h3.9c3.712 0 5.344 2.653 5.344 5.025c0 2.578-2.016 5.025-5.325 5.025h-3.919zm1.444 1.303v7.444h2.297c3.272 0 4.022-2.484 4.022-3.722c0-2.016-1.284-3.722-4.097-3.722z" />
                      </svg>
                      <a href="https://orcid.org/"
                        class="text-sm font-normal underline-offset-1 hover:text-blue-500 hover:underline">
                        {{ $author->orcid_id }}
                      </a>
                    </div>
                  @endif
                </div>
              </td>
              <td valign="top" class="px-6 py-2">
                <div class="flex flex-col items-start">
                  <p class="text-sm font-bold">
                    {{ $author->institution ? $author->institution . ',' : '' }}
                  </p>
                  <p class="text-sm">
                    {{ $author->department ? $author->department . ',' : '' }}
                    {{ $author->position }}
                  </p>
                  <p class="mt-5 text-sm font-normal">{{ $author->address }}
                  </p>
                  <p class="text-sm font-normal">
                    {{ $author->city ? $author->city . ',' : '' }}
                    {{ $author->province ? $author->province . ',' : '' }}
                    {{ $author->country?->name ? $author->country?->name . ',' : '' }}
                    {{ $author->postal_code ? 'ID ' . $author->postal_code : '' }}
                  </p>
                </div>
              </td>
              @if (!isset($manuscript->isReview))
                <td class="w-[100px] space-x-1 whitespace-nowrap p-4"></td>
              @endif
            </tr>
          @endforeach
        </x-table>
      </x-slot>

      <x-slot name="details">
        @include('pages.manuscripts.form.details')
      </x-slot>

      <x-slot name="timeline">
        <ol class="relative border-s border-gray-200 dark:border-gray-700">
          @foreach ($manuscript->logs as $log)
            <li class="mb-3 ms-4">
              <div
                class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700">
              </div>
              <time
                class="mb-1 text-xs font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i T') }}</time>
              <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $log->activity }}</h3>
              <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $log->description }}</p>
            </li>
          @endforeach
        </ol>
      </x-slot>
    </x-tabs-panel>
  </div>

  <div class="card mt-6">
    <div class="mb-3 border-b border-gray-300 pb-2 dark:border-gray-700">
      <h3 class="text-left text-xl font-extrabold lg:text-3xl">
        Progress
      </h3>
    </div>
    <x-tabs-panel class="mt-3" :withFragment="true" :tabs="[
        [
            'label' => 'Asisten',
            'name' => 'asisten',
        ],
        [
            'label' => 'Editor',
            'name' => 'editor',
        ],
        [
            'label' => 'Reviewer',
            'name' => 'reviewer',
        ],
    ]">
      <x-slot name="asisten">
        <div class="user-info mb-4">
          <h4 class="text-lg font-bold">User Information</h4>
          <p>Name: Asisten User</p>
          <p>Email: asisten@example.com</p>
        </div>
        <x-text-input class="col-span-12" type="select" label="Recommendation" name="documentation" :disabled="true">
          <option selected disabled>Recommendation</option>
          <option value="category1">Category 1</option>
          <option value="category2">Category 2</option>
        </x-text-input>
        <x-text-editor id="asisten-editor" label="Asisten Notes" variable="asistenEditor" initValue=""
          :disabled="true" />
      </x-slot>

      <x-slot name="editor">
        <div class="user-info mb-4">
          <h4 class="text-lg font-bold">User Information</h4>
          <p>Name: Editor User</p>
          <p>Email: editor@example.com</p>
        </div>
        <x-text-input class="col-span-12" type="select" label="Recommendation" name="recommendation" :disabled="true">
          <option selected disabled>Recommendation</option>
          <option value="category1">Category 1</option>
          <option value="category2">Category 2</option>
        </x-text-input>
        <x-text-editor id="editor" label="Editor Notes" variable="editor" initValue="" :disabled="true" />
        <div class="mt-4 h-auto w-full rounded-lg bg-gray-50 px-4 pb-2 shadow-md dark:bg-gray-700">
          <x-table :columns="[
              ['label' => 'REVIEWER', 'name' => 'REVIEWER', 'isSortable' => false],
              ['label' => 'INSTITUTION', 'name' => 'INSTITUTION', 'isSortable' => false],
          ]">
            <tbody>
              <tr>
                <td>Reviewer 1</td>
                <td>Institution 1</td>
              </tr>
              <tr>
                <td>Reviewer 2</td>
                <td>Institution 2</td>
              </tr>
              <tr>
                <td>Reviewer 3</td>
                <td>Institution 3</td>
              </tr>
            </tbody>
          </x-table>
        </div>
      </x-slot>

      <x-slot name="reviewer">
        <div class="user-info mb-4">
          <h4 class="text-lg font-bold">User Information</h4>
          <p>Name: Reviewer User</p>
          <p>Email: reviewer@example.com</p>
        </div>
        <x-text-input class="col-span-12" type="select" label="Recommendation" name="documentation"
          :disabled="true">
          <option selected disabled>Recommendation</option>
          <option value="category1">Category 1</option>
          <option value="category2">Category 2</option>
        </x-text-input>
        <x-text-editor id="reviewer-editor" label="Reviewer Notes" variable="reviewerEditor" initValue=""
          :disabled="true" />
      </x-slot>
    </x-tabs-panel>
  </div>
  
@can('view', $task ?? null)
    <div class="card mt-6">
      <div class="mb-2 border-b border-gray-300 pb-2 dark:border-gray-700">
        <h3 class="text-left text-xl font-extrabold lg:text-3xl">
          Your Decision
        </h3>
        <p class="mt-2 text-sm font-thin italic">
          Please provide your decision on this manuscript.
        </p>
      </div>
      @if (isset($alert))
        <x-alert :messages="$alert['messages']" :type="$alert['type']" :title="$alert['title']" :closeable="false" />
      @elseif (session('alert'))
        <x-alert :messages="session('alert')['messages']" :type="session('alert')['type']" :title="session('alert')['title']" :closeable="false" />
      @endif
      <form class="mt-3 space-y-3" action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <x-text-input id="decision" type="select" label="Decision" name="decision" required :value="$task->decision"
          :messages="$errors->get('decision')">
          <option value="" disabled selected>-- Select Decision --</option>
          <option value="accept" {{ $task->decision == 'accept' ? 'selected' : '' }}>Accept</option>
          <option value="reject" {{ $task->decision == 'reject' ? 'selected' : '' }}>Reject</option>
        </x-text-input>
        <x-text-editor id="notes" label="Notes" name="notes" variable="notes" :initValue="$task->notes"
          :messages="$errors->get('notes')">
        </x-text-editor>

        <x-files label="File Attachments" :files="$task->files">
        </x-files>
        <div class="mt-4 flex items-center justify-end gap-2 border-t border-gray-300 py-2 dark:border-gray-700">
          <input type="submit" name="submit" value="Save as Draft" class="button secondary">
          <input type="submit" name="submit" value="Submit" class="button primary">
        </div>
      </form>
    </div>
  @endcan
</x-app-layout>

