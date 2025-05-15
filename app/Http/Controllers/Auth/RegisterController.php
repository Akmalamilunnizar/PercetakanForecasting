<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |------------------------------------------------------------x--------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait 
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(Request $request)
    {
        // Debug: Log the incoming request data
        Log::info('Registration attempt with data:', $request->all());

        // Buat validasi
        try {
            $validatedData = $request->validate([
                'f_name' => 'required|string|max:200',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4|confirmed',
                'password_confirmation' => 'required',
                'nomor_telepon' => 'required|string|min:10|max:15',
            ], [
                'f_name.required' => 'Nama lengkap harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 4 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
                'password_confirmation.required' => 'Konfirmasi password harus diisi',
                'nomor_telepon.required' => 'Nomor telepon harus diisi',
                'nomor_telepon.min' => 'Nomor telepon minimal 10 digit',
                'nomor_telepon.max' => 'Nomor telepon maksimal 15 digit'
            ]);
            
            // Generate username from email
            $username = explode('@', $request->email)[0];
            
            // Buat user baru
            $user = User::create([
                'f_name' => $request->f_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nomor_telepon' => $request->nomor_telepon,
                'username' => $username,
                'user' => 'User', // Default role
                'alamat' => '', // Default empty address
                'img' => 'default-avatar.png'
            ]);

            // Assign the 'user' role to the newly created user
            $user->addRole('user');

            // Debug: Log user creation
            Log::info('User created successfully', ['username' => $user->username]);
            $user->save();
            // Set flash message untuk pendaftaran berhasil
            Session::flash('success', 'Pendaftaran berhasil! Silakan masuk.');

            // Redirect ke halaman login
            return redirect('login');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Debug: Log validation errors
            Log::error('Validation failed', ['errors' => $e->errors()]);
            
            // Return back with validation errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (QueryException $e) {
            // Debug: Log database errors
            Log::error('Database error during registration', ['error' => $e->getMessage()]);
            
            // Set flash message jika terjadi error pada database
            Session::flash('error', 'Pendaftaran gagal: ' . $e->getMessage());

            // Redirect kembali ke halaman register
            return redirect('register')->withInput();
        } catch (\Exception $e) {
            // Debug: Log other errors
            Log::error('Unexpected error during registration', ['error' => $e->getMessage()]);
            
            // Set flash message untuk error lainnya
            Session::flash('error', 'Pendaftaran gagal, silakan coba lagi. Error: ' . $e->getMessage());

            // Redirect kembali ke halaman register
            return redirect('register')->withInput();
        }
    }
}
