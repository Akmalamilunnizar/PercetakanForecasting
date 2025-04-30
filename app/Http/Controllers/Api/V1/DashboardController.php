<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function Index()
    {
        $items = Items::all();

        // Kirim data ke view
        return view("admin.dashboard", compact('items'));
        }
    // public function Index()
    // {
    //     // Data terbaru per bulan untuk setiap sensor
    //     $dataSensorPH = Sensor::selectRaw('MONTH(created_at) as bulan, ph as nilai')
    //         ->whereIn('id_sensor', function ($query) {
    //             $query->select(DB::raw('MAX(id_sensor)'))
    //                 ->from('sensor')
    //                 ->groupBy(DB::raw('MONTH(created_at)'));
    //         })
    //         ->orderBy('bulan')
    //         ->pluck('nilai');


    //     $dataSensorTemperature = Sensor::selectRaw('MONTH(created_at) as bulan, temperature as nilai')
    //         ->whereIn('id_sensor', function ($query) {
    //             $query->select(DB::raw('MAX(id_sensor)'))
    //                 ->from('sensor')
    //                 ->groupBy(DB::raw('MONTH(created_at)'));
    //         })
    //         ->orderBy('bulan')
    //         ->pluck('nilai');

    //     $dataSensorTDS = Sensor::selectRaw('MONTH(created_at) as bulan, tds as nilai')
    //         ->whereIn('id_sensor', function ($query) {
    //             $query->select(DB::raw('MAX(id_sensor)'))
    //                 ->from('sensor')
    //                 ->groupBy(DB::raw('MONTH(created_at)'));
    //         })
    //         ->orderBy('bulan')
    //         ->pluck('nilai');

    //     $dataBulan = Sensor::selectRaw('MONTH(created_at) as bulan')
    //         ->whereIn('id_sensor', function ($query) {
    //             $query->select(DB::raw('MAX(id_sensor)'))
    //                 ->from('sensor')
    //                 ->groupBy(DB::raw('MONTH(created_at)'));
    //         })
    //         ->orderBy('bulan')
    //         ->pluck('bulan');

    //     // Nilai terbaru dari setiap sensor
    //     $latestSensorData = Sensor::latest()->first();
    //     $phValue = $latestSensorData->ph ?? 0; // Default ke 0 jika tidak ada data
    //     $temperatureValue = $latestSensorData->temperature ?? 0;
    //     $tdsValue = $latestSensorData->tds ?? 0;

    //     return view('admin.dashboard', compact(
    //         'dataBulan',
    //         'dataSensorPH',
    //         'dataSensorTemperature',
    //         'dataSensorTDS',
    //         'phValue',
    //         'temperatureValue',
    //         'tdsValue'
    //     ));
    // }

    

    public function AdminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public static function ubahAngkaToBulan($bulanAngka)
    {
        $bulanArray = [
            '0' => '',
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        return $bulanArray[$bulanAngka + 0];
    }
}
