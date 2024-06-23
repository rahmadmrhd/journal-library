<x-submission-layout :manuscript="$manuscript ?? null" :steps="$steps" :alert="$alert ?? null" :subGate="$subGate">
  @if (($manuscript->current_step ?? 1) == 5)
    @include('pages.manuscripts.form.review-submit')
  @else
    @php
      $currentStep = $steps[($manuscript->current_step ?? 1) - 1];
    @endphp
    <div class="card">
      <div class="border-b border-gray-300 pb-2 dark:border-gray-700">
        <h3 class="text-left text-xl font-extrabold lg:text-3xl">
          Step {{ $manuscript->current_step ?? 1 }}: {{ $currentStep->name }}
        </h3>
        @if (isset($currentStep->description))
          <p class="mt-2 text-sm font-thin italic">{{ $currentStep->description }}</p>
        @endif
      </div>
      <div class="mt-3">
        @switch($manuscript->current_step ?? 1)
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
</x-submission-layout>
