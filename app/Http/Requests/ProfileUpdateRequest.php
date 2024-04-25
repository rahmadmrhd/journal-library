<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;

class ProfileUpdateRequest extends FormRequest {
  public function __construct() {
    $this->redirect = URL::previous() . '#profile';
  }
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'title' => ['required', 'string', 'max:50'],
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => ['nullable', 'string', 'max:255'],
      'degree' => ['nullable', 'string', 'max:50'],
      'preferred_name' => ['nullable', 'string', 'max:255'],

      'institution' => ['required', 'string', 'max:255'],
      'department' => ['required', 'string', 'max:255'],
      'position' => ['nullable', 'string', 'max:255'],
      'address' => ['required', 'string'],
      'city' => ['required', 'string', 'max:255'],
      'province' => ['required', 'string', 'max:255'],
      'postal_code' => ['required', 'string', 'max:10'],
      'country' => ['required', 'string', 'max:255'],
    ];
  }
}
