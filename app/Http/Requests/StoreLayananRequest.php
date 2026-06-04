<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $layananId = $this->route('layanan')?->id;

        return [
            'nama_layanan' => ['required', 'string', 'max:100'],
            'kode_layanan' => [
                'required',
                'string',
                'max:10',
                Rule::unique('layanan', 'kode_layanan')->ignore($layananId),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_layanan' => 'nama layanan',
            'kode_layanan' => 'kode layanan',
        ];
    }
}
