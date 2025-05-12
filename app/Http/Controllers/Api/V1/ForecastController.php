<?php
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class ForecastController extends Controller
{
    public function showForm()
    {
        return view('admin.forecast.form');
    }

    public function predict(Request $request)
    {
        $request->validate([
            'bulan' => 'required|array|min:12',
            'terjual' => 'required|array|min:12',
            'bulan.*' => 'required|date_format:Y-m',
            'terjual.*' => 'required|numeric'
        ]);

        $client = new Client();

        // Data yang akan dikirim ke API Flask
        $data = [
            'bulan' => $request->input('bulan'),
            'terjual' => $request->input('terjual')
        ];

        try {
            // Mengirim POST request ke API Flask
            $response = $client->post('http://127.0.0.1:5000/predict', [
                'json' => $data
            ]);

            // Mendapatkan hasil dari API
            $body = $response->getBody();
            $result = json_decode($body);

            // Tampilkan hasil
            return view('admin.forecast.result', ['result' => $result]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat melakukan prediksi: ' . $e->getMessage());
        }
    }
}
