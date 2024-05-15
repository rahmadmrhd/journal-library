<x-submission-layout :manuscript="$manuscript ?? null" :steps="$steps" :alert="$alert ?? null">
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

    @case(5)
      @include('pages.manuscripts.form.review-submit')
    @break

    @default
      <h3>Out Of Range</h3>
  @endswitch
</x-submission-layout>
