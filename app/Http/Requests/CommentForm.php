<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth("web")->check(); // перевіряє, чи користувач, який використовує "web" guard, наразі авторизований
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "text" => ["required", "string", "min:5"],
            "user_id" => ["required", "exists:users,id"],
        ];
    }

    protected function prepareForValidation() //викор для підготовки даних перед валідацією у Form Requests
    {
        $this->merge([
            "user_id" => auth("web")->id() //method додає до даних, що підлягають валідації, нове поле user_id, яке заповнюється ідентифікатором авторизованого користувача
        ]);
    }
}
