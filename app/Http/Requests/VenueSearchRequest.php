<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueSearchRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nelat' => 'required|numeric',
            'nelng' => 'required|numeric',
            'swlat' => 'required|numeric',
            'swlng' => 'required|numeric',
        ];
    }
}
