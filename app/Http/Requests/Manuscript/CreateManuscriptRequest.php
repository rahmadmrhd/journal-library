<?php

namespace App\Http\Requests\Manuscript;

use App\Models\Manuscript\Manuscript;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateManuscriptRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool {
    $manuscript = Manuscript::find($this->route('manuscript'));
    if (!$manuscript) {
      return $this->user()->getCurrentRole()->slug === 'author';
    }
    return $this->user()->getCurrentRole()->slug === 'author' && $this->user()->can('update', $manuscript);
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'filesId' => ['required', 'array', 'min:1'],
      'filesId.*' => ['required', 'uuid', 'exists:files,id'],
    ];
  }

  public function messages(): array {
    return [
      'filesId.required' => 'Please upload at least one file.',
      'filesId.min' => 'Please upload at least one file.',
      'filesId.*.exists' => 'The file is invalid.',
      'filesId.*.uuid' => 'The file is invalid.',
      'filesId.*.required' => 'The file is invalid.',
    ];
  }
  protected function failedValidation(Validator $validator) {
    $manuscript = Manuscript::find($this->route('manuscript'));
    if ($manuscript) {
      $manuscript->steps()->updateExistingPivot($manuscript->current_step, [
        'status' => 'error',
      ]);
    }
    $response = redirect()->back()
      ->with('alert', [
        'type' => 'error',
        'message' => $validator->errors()->first()
      ])
      ->withErrors($validator);

    throw (new ValidationException($validator, $response))
      ->errorBag($this->errorBag)
      ->redirectTo($this->getRedirectUrl());
  }
}
