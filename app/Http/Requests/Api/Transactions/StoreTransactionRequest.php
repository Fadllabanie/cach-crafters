<?php

namespace App\Http\Requests\Api\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
      'source_id' => 'required|exists:sources,id',
      'type' => 'required|in:income,expense',
      'amount' => 'required|numeric',
      'transactionDate' => 'required|date|date_format:Y-m-d h:i:s',
    );
  }
}
