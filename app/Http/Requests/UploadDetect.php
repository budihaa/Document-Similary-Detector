<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadDetect extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required|string|unique:detects',
            'created_by' => 'required|string',
            'file' => 'required|max:10000|mimes:pdf'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => 'Kategori tidak boleh kosong!',
            'title.required' => 'Kategori tidak boleh kosong!',
            'created_by.required' => 'Kategori tidak boleh kosong!',
            'file.required' => 'Kategori tidak boleh kosong!',
            'file.mimes' => 'Dokumen harus berupa PDF!',
            'file.mmax' => 'Upload file maksimal 10 MB!',
        ];
    }
}
