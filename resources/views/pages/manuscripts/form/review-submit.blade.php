<form x-data="{ step: null }" x-ref="formChangeStep"
  x-on:change-step.window="step = $event.detail; setTimeout(() => $refs.formChangeStep.submit(), 100); " class="hidden"
  action={{ route('manuscripts.change_step', $manuscript->id ?? '') }} method="POST">
  @csrf
  @method('PATCH')
  <input type="hidden" name="step" x-bind:value="step">
</form>

<form id="manuscript-submit-form" action="{{ route('manuscripts.submit', $manuscript->id ?? '') }}" method="POST">
  @csrf
  @method('PUT')
  <div class="space-y-4">
    @foreach ($steps as $step)
      @if ($loop->iteration != 5)
        <div
          class="card {{ $step->status != 'success' ? '!border !border-red-300 !bg-red-50 !bg-opacity-30 !text-red-700 dark:!border-red-800 dark:!bg-gray-800 dark:!text-red-400' : '' }}">
          <div
            class="{{ $step->status != 'success' ? 'border-red-300 dark:border-red-800' : 'border-gray-300  dark:border-gray-700' }} border-b pb-2">
            <button type="button" x-data x-on:click="$dispatch('change-step', {{ $loop->iteration }})"
              class="{{ $step->status != 'success' ? 'hover:!text-red-500 dark:hover:!text-red-500' : 'hover:!text-blue-500 ' }} text-left text-xl font-extrabold underline-offset-1 hover:underline lg:text-3xl">
              Step {{ $loop->iteration }}: {{ $step->name }}
            </button>
            @if (isset($step->description))
              <p class="mt-2 text-sm font-thin italic">{{ $step->description }}</p>
            @endif
          </div>
          <div class="mt-3">
            @switch($loop->iteration)
              @case(1)
                @include('pages.manuscripts.form.upload-file')
              @break

              @case(2)
                @include('pages.manuscripts.form.basic-information')
              @break

              @case(3)
                @include('pages.manuscripts.form.authors-institutions')
              @break

              @case(4)
                @include('pages.manuscripts.form.details')
              @break

              @default
                <h3>Out Of Range</h3>
            @endswitch
          </div>
        </div>
      @endif
    @endforeach
  </div>
</form>
