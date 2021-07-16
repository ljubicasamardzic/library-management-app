<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function createRules() {
        return [
            'first_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'last_name' => 'required|regex:/^[a-zA-Z\s]*$/'
        ];  
    }

    public function updateRules() {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/'
        ];  
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return $this->createRules();
        } else if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            return $this->updateRules();
        }
    }

}
