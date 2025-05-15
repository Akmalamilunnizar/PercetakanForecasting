<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\DiagnosaPenyakit;
use App\Models\KoiFish;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;

class PcvController extends Controller
{
    /**
     * Display a list of koi fish profiles.
     */
    public function Index()
    {
        if (Schema::hasTable('koi_fish')) {
            $koi = KoiFish::latest()->get();
        } else {
            $koi = collect(); // kosongin aja
        }

        return view('admin.pcv', compact('koi'));
    }
    // public function Index()
    // {
    //     $koi = KoiFish::latest()->get();
    //     return view('admin.pcv', compact('koi'));
    // }




    /**
     * Handle image analysis and save results to the database.
     */
    public function result(Request $request)
    {
        $koi = KoiFish::whereDoesntHave('diagnosaPenyakit')->latest()->get();

        // Validate the uploaded file
        $request->validate([
            'koi_id' => 'required|unique:diagnosa_penyakit,id_koi',
            'imagefile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'koi_id.required' => 'Silakan pilih ikan koi.',
            'koi_id.unique' => 'Ikan koi yang dipilih sudah didiagnosa sebelumnya.',
            'imagefile.required' => 'Silakan unggah gambar.',
            'imagefile.image' => 'File yang diunggah harus berupa gambar.',
            'imagefile.mimes' => 'Gambar harus dalam format jpeg, png, jpg, atau gif.',
            'imagefile.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        // Get the koi_id from the form
        $koi_id = $request->input('koi_id');  // This will contain the selected koi_id

        // Get the uploaded file
        $file = $request->file('imagefile');

        // Validate the file's existence and upload status
        if (!$file->isValid()) {
            return back()->withErrors(['error' => 'Invalid file upload.']);
        }

        // Mapping function to convert disease names to numerical values
        function mapDiseaseToNumber($disease)
        {
            $mapping = [
                'Bacterial Disease' => 1,
                'Fungal Disease' => 2,
                'Parasite Disease' => 4,
                'Undetected Disease' => 5,
            ];
            return $mapping[$disease] ?? 0; // Default to 0 if not found
        }


        // Process the uploaded image and send it to the Flask API
        $response = Http::attach(
            'imagefile',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post('http://127.0.0.1:5000/predict');

        if ($response->successful()) {
            $data = $response->json();
            $prediction = $data['prediction'];
            $probabilities = $data['probabilities'];
            $imageUrl = $data['image_url'];

            // Optionally, you can save the diagnosis to the database
            DiagnosaPenyakit::create([
                'id_koi' => $koi_id, // Store the selected koi_id
                'id_penyakit' => mapDiseaseToNumber($prediction),
                'gambar_koi' => $imageUrl,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return view('admin.pcv', [
                'prediction' => $prediction,
                'classes_with_percentages' => $probabilities,
                'image_url' => $imageUrl,
                'koi' => $koi,
            ]);
        } else {
            return response()->json(['error' => 'Failed to predict'], $response->status());
        }
    }
    /**
     * Store updated user profile.
     */
    public function storeProfile(Request $request)
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'email_verified_at' => 'date',
            'currentPassword' => 'nullable|min:6',
            'newPassword' => 'nullable|min:6|confirmed',
        ]);

        if ($request->filled('newPassword')) {
            if (!Hash::check($request->input('currentPassword'), $profile->password)) {
                return redirect()->back()->withErrors(['currentPassword' => 'Password saat ini tidak valid.']);
            }

            $profile->password = bcrypt($request->input('newPassword'));
        }

        if ($request->hasFile('img')) {
            $request->validate([
                'img' => 'required|image|mimes:png,jpg,gif,jpeg',
            ]);

            $del = 'uploads/users/' . $profile->img;
            if (File::exists($del)) {
                File::delete($del);
            }

            $file = $request->file('img');
            $exe = $file->getClientOriginalExtension();
            $filename = '_profile' . microtime() . '.' . $exe;
            $file->move('uploads/users/', $filename);
            $profile->img = $filename;
        }

        $profile->save();
        Log::info('Store Profile Request:', $request->all());

        return redirect()->route('admin.profiles')->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Delete user profile.
     */
    public function destroy($id)
    {
        $profile = User::findOrFail($id);
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profil berhasil dihapus');
    }
}
