<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntrianRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_pasien' => is_string($this->nama_pasien) ? trim($this->nama_pasien) : $this->nama_pasien,
            'nim_nip' => is_string($this->nim_nip) ? trim($this->nim_nip) : $this->nim_nip,
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pasien' => ['required', 'string', 'max:150', 'regex:/^[\pL\s.\'-]+$/u'],
            'nim_nip' => ['required', 'string', 'min:4', 'max:30', 'regex:/^[0-9]+$/'],
            'layanan_id' => ['required', 'integer', 'exists:layanan,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_pasien' => 'nama pasien',
            'nim_nip' => 'NIM/NIP',
            'layanan_id' => 'layanan',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pasien.regex' => 'Nama pasien hanya boleh berisi huruf, spasi, titik, apostrof, dan tanda hubung.',
            'nim_nip.regex' => 'NIM/NIP hanya boleh berisi angka.',
        ];
    }
}
