<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'title' => ['required','string','max:160'],
            'description' => ['nullable','string'],
            'starts_at' => ['required','date'],
            'price_cents' => ['required','integer','min:0'],
            'is_active' => ['sometimes','boolean'],
        ];
    }
}
