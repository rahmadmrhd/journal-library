@push('head')
  @vite('resources/css/manuscript.css')
@endpush
<x-app-layout sizeHideSidebar="xl" title="Detail Manuscript" :subGate="$subGate" class="px-4 pt-4">
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
          <div class="column"><a
              href="{{ route('manuscripts.show', ['subGate' => $subGate->slug, 'manuscript' => $manuscript->parent->id]) }}"
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
            </tr>
          @endforeach
        </x-table>
      </x-slot>

      <x-slot name="details">
        @include('pages.manuscripts.form.details')
      </x-slot>

      <x-slot name="timeline">
        <ol class="relative border-s border-gray-200 dark:border-gray-700">
          @foreach ($manuscript->logs()->with('user')->get() as $log)
            <li class="mb-3 ms-4">
              <div
                class="absolute -start-1.5 mt-1.5 h-3 w-3 rounded-full border border-white bg-gray-200 dark:border-gray-900 dark:bg-gray-700">
              </div>
              <time
                class="mb-1 text-xs font-normal leading-none text-gray-400 dark:text-gray-400">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i T') }}
                <span class="font-bold">by
                  {{ $log->user == null ? 'System' : (Auth::user()->id == $log->user->id ? 'Me' : $log->user->getFullName()) }}
                </span>
              </time>
              <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $log->activity }}</h3>

              <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $log->description }}</p>
            </li>
          @endforeach
        </ol>
      </x-slot>
    </x-tabs-panel>
  </div>
  @if (isset($task))
    @php
      $roleSlug = isset($task) ? $task->role()->first('slug')->slug : null;
    @endphp
    @if ($roleSlug != 'editor-assistant')
      @php
        $parentTask = $task->parent;
        $parentTaskDetail = $parentTask->details()->latest()->first();
        if ($task->details->whereNotNull('submitted_at')->count() > 0 && $roleSlug != 'reviewer') {
            $currentTask = $task->details->whereNotNull('submitted_at')->first();
            $currentTask->taskUser = $task->user;
            $currentTask->taskRole = $task->role;
            $currentAndChildren = collect([
                $currentTask,
                ...$task
                    ->children()
                    ->with(['user', 'role'])
                    ->whereHas('details', function ($query) {
                        $query->whereNotNull('submitted_at');
                    })
                    ->get()
                    ->map(function ($child) {
                        $detail = $child->details->first();
                        $detail->taskUser = $child->user;
                        $detail->taskRole = $child->role;
                        return $detail;
                    }),
            ]);
        }
      @endphp
      <div class="card mt-6" x-data="{ expand: false }">
        <button type="button" x-on:click="expand=!expand"
          class="mb-3 flex w-full items-center gap-x-2 border-b border-gray-300 pb-2 dark:border-gray-700">
          <svg class="svg-dropdown" x-bind:class="!expand && '-rotate-90'" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
          <h3 class="text-left text-xl font-extrabold lg:text-3xl">
            Progress
          </h3>
        </button>
        <x-tabs-panel x-show="expand" :withFragment="false" :tabs="[
            [
                'label' =>
                    $roleSlug == 'editor-in-chief'
                        ? 'Editor Assistant'
                        : ($roleSlug == 'academic-editor'
                            ? 'Editor In Chief'
                            : 'Academic Editor'),
                'name' => 'slot1',
            ],
            ...isset($currentAndChildren)
                ? $currentAndChildren
                    ->map(function ($task, $key) use ($roleSlug) {
                        if ($roleSlug == 'editor-in-chief') {
                            return [
                                'label' => $key == 0 ? 'Editor In Chief' : 'Academic Editor',
                                'name' => 'slot' . $key + 2,
                            ];
                        }
                        return [
                            'label' => $key == 0 ? 'Academic Editor' : 'Reviewer ' . $key,
                            'name' => 'slot' . $key + 2,
                        ];
                    })
                    ->toArray()
                : [],
        ]">
          <x-slot name="slot1" class="space-y-3">
            <div class="user-info mb-4">
              <h4 class="text-lg font-bold">User Information</h4>
              <x-invite-users disabled :subGate="$subGate" :users="[$parentTask->user]" label="User" />
            </div>
            {{-- <x-text-input class="col-span-12" type="select" label="Decision" name="Decision" :disabled="true">
            <option value="accept" {{ $parentTaskDetail->decision == 'accept' ? 'selected' : '' }}>Accept</option>
            <option value="revision" {{ $parentTaskDetail->decision == 'revision' ? 'selected' : '' }}>Needs
              Revision</option>
          </x-text-input> --}}

            <x-text-editor id="editorslot1" label="Notes" :initValue="$parentTaskDetail->notes" :disabled="true" />

            <x-files label="File Attachments" :files="$parentTaskDetail->files" :isReadOnly="true">
            </x-files>
          </x-slot>

          @isset($currentAndChildren)
            @foreach ($currentAndChildren as $childrenTask)
              <x-slot :name="'slot' . ($loop->iteration + 1)">
                <div class="user-info mb-4">
                  <h4 class="text-lg font-bold">User Information</h4>
                  <x-invite-users disabled :subGate="$subGate" :users="[$childrenTask->taskUser]" label="User" />
                </div>
                {{-- <x-text-input class="col-span-12" type="select" label="Decision" name="Decision" :disabled="true">
              <option value="accept" {{ $childrenTask->decision == 'accept' ? 'selected' : '' }}>Accept</option>
              <option value="revision" {{ $childrenTask->decision == 'revision' ? 'selected' : '' }}>Needs
                Revision</option>
            </x-text-input> --}}
                <x-text-input id="deadline{{ $loop->iteration + 1 }}" name="deadline" type="number" min="0"
                  :value="$childrenTask?->deadline_invites ?? 7" required :disabled="true" description="Deadline in days"
                  label="Deadline"></x-text-input>

                <div class="user-info my-4">
                  <h4 class="text-lg font-bold">
                    {{ $childrenTask->taskRole->slug == 'editor-in-chief' ? 'Invite Academic Editor' : 'Invite Reviewer' }}
                  </h4>

                  <x-invite-users :subGate="$subGate" :users="$childrenTask->invites" :isReadOnly="true" />
                </div>

                <x-text-editor id="editorslot{{ $loop->iteration + 1 }}" label="Notes" :initValue="$childrenTask->notes"
                  :disabled="true" />

                <x-files label="File Attachments" :files="$childrenTask->files" :isReadOnly="true">
                </x-files>
              </x-slot>
            @endforeach
          @endisset
        </x-tabs-panel>
      </div>
    @endif

    @php
      if (($roleSlug == 'editor-assistant' || $roleSlug == 'reviewer') && !isset($detail)) {
          $detail = $task->details->first();
      }
    @endphp
    @isset($detail)
      @php
        if (isset($detail?->invites)) {
            $detail->invites = $detail->invites->map(function ($invite) {
                $differentDays = date_diff(\Carbon\Carbon::now(), \Carbon\Carbon::parse($invite->pivot->invited_at))
                    ->days;
                $invite->pivot->inDeadline = $differentDays > $invite->pivot->deadline;
                return $invite;
            });
        }
      @endphp
      <div class="card mt-6">
        <div class="mb-2 border-b border-gray-300 pb-2 dark:border-gray-700">
          <h3 class="text-left text-xl font-extrabold lg:text-3xl">
            {{ $roleSlug == 'reviewer' ? 'Your Review' : 'Your Decision' }}
          </h3>
          <p class="mt-2 text-sm font-thin italic">
            {{ 'Please provide your ' . ($roleSlug == 'reviewer' ? 'review' : 'decision') . ' on this manuscript.' }}
          </p>
        </div>
        @if (isset($alert))
          <x-alert :messages="$alert['messages']" :type="$alert['type']" :title="$alert['title']" :closeable="false" />
        @elseif (session('alert'))
          <x-alert :messages="session('alert')['messages']" :type="session('alert')['type']" :title="session('alert')['title']" :closeable="false" />
        @endif
        <form class="mt-3 space-y-3"
          action="{{ route('tasks.update', ['subGate' => $subGate->slug, 'task' => $task]) }}" method="POST"
          x-data="{
              decision: @js($detail->decision ?? null) ?? '',
              assignTo: @js($roleSlug) == 'reviewer' ? 'Academic Editor' : null
          }" x-init="$watch('decision', value => {
              if (@js($roleSlug) == 'reviewer') {
                  assignTo = 'Academic Editor';
                  return;
              }
              if (value != 'accept' && value != 'continue') {
                  assignTo = 'Author';
                  return;
              }
              switch (@js($roleSlug)) {
                  case 'editor-assistant':
                      assignTo = 'Editor In Chief';
                      break;
                  case 'editor-in-chief':
                      assignTo = value == 'accept' ? 'Publisher' : 'Academic Editor';
                      break;
                  case 'academic-editor':
                      assignTo = value == 'accept' ? 'Editor In Chief' : 'Reviewers';
                      break;
              }
          })">
          @csrf
          @method('PUT')
          @isset($detail->responses)
            <x-custom-forms :readonly="($detail->submitted_at ?? null) != null" :fields="$detail->responses" />
          @endisset
          @if ($roleSlug != 'reviewer')
            @if (isset(($detail->toRole ?? null)->name))
              <div class="mt-6 max-w-screen-sm">
                <div class="grid grid-cols-[auto_1fr] border-b border-gray-200 dark:border-gray-700 lg:grid-cols-2">
                  <div class="flex items-center px-4 py-2 text-sm">Assigned to</div>
                  <div class="flex items-center justify-end px-4 py-2 text-right text-sm !font-bold">
                    {{ ($detail->toRole ?? null)->name }}
                  </div>
                </div>
              </div>
            @else
              <template x-if="decision">
                <div class="mt-6 max-w-screen-sm">
                  <div class="grid grid-cols-[auto_1fr] border-b border-gray-200 dark:border-gray-700 lg:grid-cols-2">
                    <div class="flex items-center px-4 py-2 text-sm">Assign To</div>
                    <div class="flex items-center justify-end px-4 py-2 text-right text-sm !font-bold"
                      x-text="assignTo">
                    </div>
                  </div>
                </div>
              </template>
            @endif
          @endif
          <x-text-input class="max-w-screen-sm" id="decision" type="select"
            label="{{ $roleSlug == 'reviewer' ? 'Recomendation Decision' : 'Decision' }}" name="decision" required
            x-model="decision" :disabled="($detail->submitted_at ?? null) != null" :messages="$errors->get('decision')" :status="$errors->has('decision') ? 'error' : ''">
            <option value="" disabled selected>-- Select Decision --</option>
            @if ($roleSlug == 'editor-in-chief')
              <option value="accept" {{ ($detail->decision ?? null) == 'accept' ? 'selected' : '' }}>Accept To Publish
              </option>
              <option value="continue" {{ ($detail->decision ?? null) == 'accept' ? 'selected' : '' }}>Accept To
                Review
              </option>
            @elseif ($roleSlug == 'academic-editor')
              <option value="accept" {{ ($detail->decision ?? null) == 'accept' ? 'selected' : '' }}>Accept</option>
              <option value="continue" {{ ($detail->decision ?? null) == 'accept' ? 'selected' : '' }}>Accept To
                Review
              </option>
            @elseif ($roleSlug == 'reviewer')
              <option value="accept" {{ ($detail->decision ?? null) == 'accept' ? 'selected' : '' }}>Accept</option>
            @endif
            @if ($roleSlug == 'editor-assistant')
              <option value="accept" {{ ($detail->decision ?? null) == 'accept' ? 'selected' : '' }}>Accept</option>
              <option value="revision" {{ ($detail->decision ?? null) == 'revision' ? 'selected' : '' }}>Needs
                Revision
              </option>
            @else
              <option value="minor_revision" {{ ($detail->decision ?? null) == 'minor_revision' ? 'selected' : '' }}>
                Minor
                Revision
              </option>
              <option value="major_revision" {{ ($detail->decision ?? null) == 'major_revision' ? 'selected' : '' }}>
                Major
                Revision
              </option>
            @endif
            <option value="reject" {{ ($detail->decision ?? null) == 'reject' ? 'selected' : '' }}>Reject</option>
          </x-text-input>

          @if ($roleSlug == 'editor-in-chief' || $roleSlug == 'academic-editor')
            <template x-if="decision == 'continue'">
              <x-text-input id="deadline" name="deadline" type="number" min="0" :value="$detail->deadline_invites ?? (null ?? 7)" required
                :disabled="($detail->submitted_at ?? null) != null" description="Deadline in days" label="Deadline"></x-text-input>
            </template>
            <template x-if="decision == 'continue'">
              <x-invite-users :subGate="$subGate" :label="$roleSlug == 'editor-in-chief' ? 'Academic Editor' : 'Reviewer'" :labelBox="$roleSlug == 'editor-in-chief' ? 'Invite Academic Editor' : 'Invite Reviewer'" :users="$detail->invites ?? null"
                :isReadOnly="($detail->submitted_at ?? null) != null" :name="$roleSlug == 'editor-in-chief' ? 'academic_editor' : 'reviewer'" :role="$roleSlug == 'editor-in-chief' ? 'academic-editor' : 'reviewer'" :maxInvite="2" :excepts="$manuscript->authors->pluck('id')->toArray()"
                :minInvite="$roleSlug == 'editor-in-chief' ? 1 : 2" />
            </template>
          @endif

          <x-text-editor id="notes" label="Notes" name="notes" variable="notes" :initValue="$detail->notes ?? null"
            :disabled="($detail->submitted_at ?? null) != null" :messages="$errors->get('notes')">
          </x-text-editor>

          <x-files label="File Attachments" :files="$detail->files ?? null" :isReadOnly="($detail->submitted_at ?? null) != null">
          </x-files>
          @if ($task->status == 'in_progress')
            <div class="mt-4 flex items-center justify-end gap-2 border-t border-gray-300 py-2 dark:border-gray-700">
              <input type="submit" name="submit" value="Save as Draft" class="button secondary">
              <input type="submit" name="submit" value="Submit" class="button primary">
            </div>
          @endif
        </form>
      </div>
    @endisset
  @endif

</x-app-layout>
