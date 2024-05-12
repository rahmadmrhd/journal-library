<x-submission-layout :manuscript="$manuscript ?? null" :steps="$steps" :alert="$alert ?? null">
  @switch($manuscript->current_step ?? 1)
    @case(1)
      @include('pages.manuscripts.form.upload-file')
    @break

    @case(2)
      @include('pages.manuscripts.form.basic-information')
    @break

    @case(3)
      Step3
    @break

    @case(4)
      Step4
    @break

    @case(5)
      Step5
    @break

    @default
      <h3>Out Of Range</h3>
  @endswitch

</x-submission-layout>
