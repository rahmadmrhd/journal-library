<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class AccountUpdateRequest extends FormRequest {
  public function __construct() {
    $this->redirect = URL::previous() . '#account';
  }
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array {
    return [
      'username' => ['required', 'string', 'min:3', 'max:25', Rule::unique(User::class)->ignore($this->user()->id)],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
    ];
  }
}
