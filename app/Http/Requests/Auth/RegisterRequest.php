<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules()
  {
    return array(
      'email' => 'required|string|email|unique:users,email',
      'phone' => 'required|string|unique:users,phone',
      'password' => 'required|string',
    );
  }

  public function withValidator($validator)
  {
    $validator->sometimes('login', 'unique:users,email', function ($input) {
      return filter_var($input->login, FILTER_VALIDATE_EMAIL) !== false;
    });

    $validator->sometimes('login', 'unique:users,phone', function ($input) {
      return filter_var($input->login, FILTER_VALIDATE_EMAIL) === false;
    });
  }
}
