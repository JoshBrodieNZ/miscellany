<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItem extends FormRequest
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
            'name' => 'required',
            'location_id', 'nullable|integer|exists:locations,id',
            'character_id', 'nullable|integer|exists:character,id',
            'section_id' => 'nullable|integer|exists:sections,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
            'image_url' => 'nullable|url|active_url',
            'template_id' => 'nullable|exists:attribute_templates,id',
        ];
    }
}
