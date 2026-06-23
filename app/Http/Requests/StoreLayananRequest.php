<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLayananRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_layanan' => is_string($this->nama_layanan) ? trim($this->nama_layanan) : $this->nama_layanan,
            'kode_layanan' => is_string($this->kode_layanan) ? strtoupper(trim($this->kode_layanan)) : $this->kode_layanan,
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $layananId = $this->route('layanan')?->id;

        return [
            'nama_layanan' => ['required', 'string', 'max:100', 'regex:/^[\pL\s.\'-]+$/u'],
            'kode_layanan' => [
                'required',
                'string',
                'min:1',
                'max:10',
                'regex:/^[A-Z0-9]+$/',
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

    public function messages(): array
    {
        return [
            'nama_layanan.regex' => 'Nama layanan hanya boleh berisi huruf, spasi, titik, apostrof, dan tanda hubung.',
            'kode_layanan.regex' => 'Kode layanan hanya boleh berisi huruf kapital dan angka tanpa spasi atau simbol.',
        ];
    }
}
