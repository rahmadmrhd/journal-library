<div class="space-y-4">
  @foreach ($steps as $step)
    @if ($loop->iteration != 5)
      <div
        class="card {{ $step->status == 'error' ? '!border !border-red-300 !bg-red-100 !text-red-700 dark:!border-red-800 dark:!bg-gray-800 dark:!text-red-400' : '' }}">
        <form
          class="{{ $step->status == 'error' ? 'border-red-300 dark:border-red-800' : 'border-gray-300  dark:border-gray-700' }} border-b pb-2"
          action={{ route('manuscripts.change_step', $manuscript->id ?? '') }} method="POST">
          @csrf
          @method('PATCH')
          <input type="hidden" name="step" value="{{ $loop->iteration }}">
          <button type="submit"
            class="{{ $step->status == 'error' ? 'hover:!text-red-800 dark:hover:!text-red-500' : 'hover:!text-blue-500 ' }} text-left text-xl font-extrabold underline-offset-1 hover:underline lg:text-3xl">
            Step {{ $loop->iteration }}: {{ $step->name }}
          </button>
          <p class="mt-2 text-sm font-thin italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
            asperiores,
            doloribus ad obcaecati
            dignissimos porro nemo ullam quam illum ea vero esse voluptas, quisquam eveniet beatae blanditiis dolorem in
            error.Quaerat mollitia modi at, perferendis vero similique error nihil ea nostrum voluptatum distinctio
            necessitatibus laboriosam exercitationem quidem debitis consectetur laborum laudantium iusto eveniet? Unde
            veniam molestias nam nisi eaque cumque?</p>
        </form>
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
