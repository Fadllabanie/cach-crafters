<?php

namespace App\Http\Requests\Api\Budgets;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
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
      'name' => 'required|string',
      'source_id' => 'required|exists:sources,id',
      'amount' => 'required|numeric',
      'period' => 'required|in:weekly,monthly,yearly',
      'is_budget_overspend' => 'required|bool',
      'is_exceeded' => 'required|bool',
    );
  }
}
