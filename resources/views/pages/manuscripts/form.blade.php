<x-submission-layout :forms="$forms">
  @slot('step1')
    @include('pages.manuscripts.form.upload-file')
  @endslot
  @slot('step2')
    @include('pages.manuscripts.form.basic-information')
  @endslot
  @slot('step3')
    step3
  @endslot
  @slot('step4')
    step4
  @endslot
  @slot('step5')
  @endslot
  @slot('step6')
  @endslot
</x-submission-layout>

