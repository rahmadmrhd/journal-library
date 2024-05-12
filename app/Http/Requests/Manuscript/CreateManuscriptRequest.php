<?php

namespace App\Http\Requests\Manuscript;

use App\Models\Manuscript\File;
use App\Models\Manuscript\Manuscript;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class CreateManuscriptRequest extends FormRequest {
  private Manuscript $manuscript;

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool {
    $this->manuscript = Manuscript::find($this->route('manuscript'))?->first();
    if (!$this->manuscript) {
      return $this->user()->getCurrentRole()->slug === 'author';
    }
    // Gate::authorize('update', $this->manuscript);
    return $this->user()->getCurrentRole()->slug === 'author';
  }

  protected function failedValidation(Validator $validator) {
    // if ($this->manuscript) {
    //   $this->manuscript->steps()->syncWithoutDetaching([
    //     $this->manuscript->current_step => [
    //       'status' => 'error',
    //     ],
    //   ]);
    // }
    // $messages = collect($validator->errors()->getMessages())->map(function ($messages, $key) {
    //   $messages = collect($messages)->join('\n');
    //   return $messages;
    // })->values()->toArray();

    // $response = redirect()
    //   ->route('manuscripts.create', $this->manuscript)
    //   ->with('alert', [
    //     'type' => 'error',
    //     'messages' => $messages,
    //   ])
    //   ->withErrors($validator)
    //   ->withInput();

    // $files = $this->input('filesId');
    // if ($files && count($files) > 0) {
    //   $files = File::whereIn('id', $files)->get();
    //   $response = $response->with('files', $files);
    // }

    // throw (new ValidationException($validator, $response))
    //   ->errorBag($this->errorBag)
    //   ->redirectTo($this->getRedirectUrl());
    // $this->merge([]);
    // return $response;
  }
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    switch ($this->manuscript->current_step ?? 1) {
      case 1:
        return Manuscript::rules(['filesId', 'filesId.*']);
      case 2:
        return Manuscript::rules(['title', 'category_id', 'abstract', 'keywords', 'keywords.*']);
      default:
        return [];
    }
  }

  public function messages(): array {
    return Manuscript::messages();
  }
}
