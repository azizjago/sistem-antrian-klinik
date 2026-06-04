<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntrianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pasien' => ['required', 'string', 'max:150'],
            'nim_nip' => ['required', 'string', 'max:50'],
            'layanan_id' => ['required', 'exists:layanan,id'],
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
}
