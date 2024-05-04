<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest {

  protected $errorBag = 'form';
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    $rules = [
      'title' => ['nullable', 'string', 'max:50'],
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => ['required', 'string', 'max:255'],
      'degree' => ['nullable', 'string', 'max:50'],
      'preferred_name' => ['nullable', 'string', 'max:255'],
      'roles' => ['required', 'array'],
    ];

    if ($this->isMethod('POST')) {
      $rules['email'] = ['required', 'string', 'email', 'max:255', Rule::unique(User::class)];
      $rules['username'] = ['required', 'string', 'min:3', 'max:25', Rule::unique(User::class)];
      $rules['password'] = ['required', Password::defaults(), 'confirmed'];
    }

    return $rules;
  }
}
