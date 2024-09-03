<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LengthException;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('http://127.0.0.1:5000/users');

            $data = $response->json()['data'];

            if($response -> successful()) {
                $data = $response->json();
                return view('pages.dashboard.index', ['totalUsers' => count($data['data'])]);
            } else {
                return response()->json(['message' => 'Error'], $response->status());
            }
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public function getVideoStream()
    {
        // Ganti URL berikut dengan URL ESP32-CAM yang menangani streaming video
        $videoUrl = 'http://192.168.43.122:81/stream';

        $response = Http::get($videoUrl);

        // Pastikan response berstatus 200 OK dan memiliki header Content-Type yang benar
        if ($response->successful() && $response->headers()['content-type'][0] === 'multipart/x-mixed-replace; boundary=frame') {
            return response($response->body())->header('Content-Type', 'multipart/x-mixed-replace; boundary=frame');
        }

        // Tangani jika terjadi kesalahan
        abort(500, 'Error retrieving video stream from ESP32-CAM.');
    }


}
