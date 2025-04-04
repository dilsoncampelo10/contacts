<?php

namespace App\Http\Requests\Contact;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'max:255', 'min:5'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:contacts,email,'  . $this->id],
            'contact' => ['required', 'string', 'digits:9', 'unique:contacts,contact,' . $this->id],
        ];
    }
}
