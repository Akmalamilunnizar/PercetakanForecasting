<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function Index()
    {
        return view('admin.dashboard');
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

    public function get_sensor_list(Request $request)
    {
        // Retrieve the pond_id from the request
        $pondId = $request->input('pond_id');

        // Validate that pond_id is provided
        if (!$pondId) {
            return response()->json(['error' => 'Pond ID is required'], 400);
        }

        // Get the latest sensor data for the specified pond_id
        $latestSensorData = Sensor::where('pond_id', $pondId)->latest()->first();

        // If no sensor data is found for the pond_id, return default values
        $phValue = $latestSensorData->ph ?? 0;
        $temperatureValue = $latestSensorData->temperature ?? 0;
        $tdsValue = $latestSensorData->tds ?? 0;

        // Return the data in a JSON response
        return response()->json([
            'pond_id' => $pondId,
            'ph' => $phValue,
            'temperature' => $temperatureValue,
            'tds' => $tdsValue,
        ], 200);
    }

    public function get_sensor_list_all(Request $request)
    {
        // Retrieve the pond_id from the request
        $pondId = $request->input('pond_id');

        // Validate that pond_id is provided
        if (!$pondId) {
            return response()->json(['error' => 'Pond ID is required'], 400);
        }

        // Get all sensor data for the specified pond_id
        $sensorData = Sensor::where('pond_id', $pondId)
            ->orderBy('created_at', 'desc') // Order by newest first
            ->get();

        // Check if data exists
        if ($sensorData->isEmpty()) {
            return response()->json(['error' => 'No sensor data found for the provided Pond ID'], 404);
        }

        // Return the list of all sensor data in JSON format
        return response()->json([
            'pond_id' => $pondId,
            'sensors' => $sensorData,
        ], 200);
    // }




        // $previousPhValue = $previousSensorData ? $previousSensorData->ph : null;
        // $previousTemperatureValue = $previousSensorData ? $previousSensorData->temperature : null;
        // $previousTdsValue = $previousSensorData ? $previousSensorData->tds : null;

        return view('admin.dashboard', compact(
            'dataBulan',
            'dataSensorPH',
            'dataSensorTemperature',
            'dataSensorTDS',
            'phValue',
            // 'previousPhValue', // Pass the previous pH value here
            'temperatureValue',
            // 'previousTemperatureValue', // Pass the previous temperature value here
            'tdsValue',
            // 'previousTdsValue' // Pass the previous TDS value here
        ));
    }

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
