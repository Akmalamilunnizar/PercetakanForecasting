<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash; // Import untuk hashing password
use Illuminate\Validation\ValidationException; // Import untuk ValidationException jika diperlukan (opsional, tergantung Laravel versi)

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        // Handle image upload if 'img' is present in the request
        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada
            if ($request->user()->img) {
                // Pastikan Anda memiliki mekanisme untuk menghapus file dari storage
                // Contoh: Storage::delete('public/' . $request->user()->img);
                // Untuk contoh ini, kita asumsikan path yang disimpan di DB adalah 'storage/path/to/image.jpg'
                // Jadi, kita perlu menghapus 'path/to/image.jpg'
                \Storage::disk('public')->delete($request->user()->img);
            }

            $path = $request->file('img')->store('profile-images', 'public');
            $request->user()->img = $path;
        }


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        // Debug: Log request data
        \Log::info('Update Password Request Data:', $request->all());

        try {
            $validated = $request->validate([
                'email' => ['required', 'email'], // Pastikan email yang diisi adalah email user yang login
                'password' => ['required', 'confirmed', 'min:8'],
            ], [], [ // Argument ketiga untuk custom attributes
                'password' => 'Kata Sandi Baru',
                'password_confirmation' => 'Konfirmasi Kata Sandi',
                'email' => 'Email',
            ]);
            // Jika validasi sukses, log data yang divalidasi
            \Log::info('Validation successful:', $validated);

        } catch (ValidationException $e) {
            // Debug: Log validation errors
            \Log::error('Validation failed:', $e->errors());
            return Redirect::route('profile.edit')->withErrors($e->errors(), 'updatePassword');
        }


        $user = auth()->user();

        // Penting: Pastikan email yang di-input sama dengan email user yang sedang login
        if ($user->email !== $validated['email']) {
            \Log::warning('Email mismatch during password update.', ['user_email' => $user->email, 'input_email' => $validated['email']]);
            return Redirect::route('profile.edit')->withErrors(['email' => 'Email yang Anda masukkan tidak sesuai dengan email akun Anda.'], 'updatePassword');
        }

        // Hash password baru sebelum disimpan
        $user->password = Hash::make($validated['password']);
        $user->save();

        // Debug: Log that password was saved
        \Log::info('Password successfully updated for user ID: ' . $user->id);

        // Redirect dengan pesan sukses
        return Redirect::route('profile.edit')->with('success', 'Kata sandi berhasil diperbarui!');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi password untuk penghapusan akun
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [], [
            'password' => 'Kata Sandi',
        ], 'userDeletion'); // Menggunakan error bag 'userDeletion'

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}