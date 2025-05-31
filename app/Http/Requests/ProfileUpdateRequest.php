<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // Sesuaikan 'name' menjadi 'f_name' sesuai dengan kolom di tabel Anda
            'f_name' => ['required', 'string', 'max:255'],

            // Validasi email
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],

            // Tambahkan validasi untuk username
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],

            // Tambahkan validasi untuk nomor_telepon
            'nomor_telepon' => ['nullable', 'string', 'max:20'], // 'nullable' jika tidak wajib diisi, 'max:20' untuk panjang maksimal nomor telepon

            // Tambahkan validasi untuk alamat
            'alamat' => ['required', 'string', 'max:500'], // 'nullable' jika tidak wajib diisi, 'max:500' untuk panjang maksimal teks alamat

            // Tambahkan validasi untuk gambar profil (jika Anda mengizinkan unggahan gambar)
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // 'nullable' jika tidak wajib diunggah, 'image' memastikan itu file gambar, 'mimes' untuk format yang diizinkan, 'max' untuk ukuran file dalam KB
        ];
    }
}