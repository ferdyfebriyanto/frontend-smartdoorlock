<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Uploadcare;
use App\Services\StorageService;

class UserController extends Controller
{
    protected $storageService;

    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function tesLog(Request $request)
    {
        // dd("Msauk");
        // $on_page = is_null($request->get('page')) ? 1 : $request->get('page');

        $res = Http::get('https://reqres.in/api/users');

        $data = $res->json()['data'];
        dd($data);

        if ($res -> successful()) {
            $data = $res->json();
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Error'], $res->status());
        }

    }


    public function index()
    {
        // dd("Msauk");
        // $on_page = is_null($request->get('page')) ? 1 : $request->get('page');

        $res = Http::get('http://127.0.0.1:5000/users');

        $data = $res->json()['data'];

        return view('pages.users.index', ['data' => $data]);

    }

    public function getDataById($id)
    {
        $response = Http::get('http://127.0.0.1:5000/users/'.$id);

        if ($response->successful()) {
            $data = $response['data'];
            return view('pages.users.detail', ['data' => $data]);
        } else {
            // Tangani jika terjadi kesalahan saat mengambil data berdasarkan ID
            return response()->json(['message' => 'Gagal mengambil data yyyyyyy'], $response->status());
        }
    }

    public function showCreateForm()
    {

        return view('pages.users.create');
    }


    public function createData(Request $request)
    {
        $data = $request->all();

        // $file = $request->file('image');
        // $pubKey = '448aa6eb11abd3614ce5';

        // $response = Http::attach(
        //     'file', file_get_contents($file), $file->getClientOriginalName()
        // )->post('https://upload.uploadcare.com/base/', [
        //     'UPLOADCARE_PUB_KEY' => $pubKey,
        // ]);


        $file = $request->file('image');
        $contents = $file->get();

        $filePath = 'images/' . time() . '_' . $file->getClientOriginalName();
        $path = $this->storageService->upload($contents, $filePath);


        // Lanjutkan dengan membuat data baru jika validasi berhasil
        $response = Http::post('http://127.0.0.1:5000/users', [
            "email" => $data['email'],
            "name" => $data['name'],
            "password" => "12345678",
            "phone" => $data['phone'],
            "job" => $data['job'],
            "superUser" => false,
            "salary" => "7600000",
            "isAbsen" => false,
            "jobType" => "admin",
            "idCompany" => "645d2c8130b6c222770feffb",
            "image" => $path,
            "verify" => true,
            "idCategory" => "6496be23fdee481e5ee54c1d"
        ]);


        if ($response->successful()) {
            // Tangani jika berhasil membuat data baru
            return redirect('/users')->with('success', 'Data berhasil dibuat');
        } else {
            // Tangani jika terjadi kesalahan saat membuat data baru
            return back()->with('error', 'Gagal membuat data');
        }
    }


    public function testRespons(Request $request)
    {
        $data = $request->all();

        dd($data);
    }


    public function deleteData($id)
    {
        $response = Http::delete('http://127.0.0.1:5000/users/'.$id);

        if ($response->successful()) {
            // Tangani jika berhasil menghapus data
            return redirect('/users')->with('success', 'Data berhasil dihapus');
        } else {
            // Tangani jika terjadi kesalahan saat menghapus data
            return back()->with('error', 'Gagal menghapus data');
        }
    }

    public function updateData($id, Request $request)
    {
        // $data = $request->all();
        // $response = Http::put('http://127.0.0.1:5000/users/'.$id, $data);

        // Mengambil file yang diunggah
        $file = $request->file('image');

        $pubKey = '448aa6eb11abd3614ce5';


        $response = Http::attach(
            'file',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post('https://upload.uploadcare.com/base/', [
            'UPLOADCARE_PUB_KEY' => $pubKey,
        ]);

        // Lanjutkan dengan membuat data baru jika validasi berhasil
        $response = Http::put('http://127.0.0.1:5000/users/'. $id, [
        "email" => $request->input('email'),
        "name" => $request->input('name'),
        "password" => "12345678",
        "phone" => $request->input('phone'),
        "job" => $request->input('job'),
        "superUser" => false,
        "salary" => "7600000",
        "isAbsen" => false,
        "jobType" => "remote",
        "idCompany" => "645d2c8130b6c222770feffb",
        "image" => 'https://ucarecdn.com/'. $response->json()['file'] . '/',
        "verify" => true,
        "idCategory" => "6496be23fdee481e5ee54c1d"
    ]);


        if ($response->successful()) {
            // Tangani jika berhasil mengubah data
            return redirect('/users')->with('success', 'Data berhasil diubah');
        } else {
            // Tangani jika terjadi kesalahan saat mengubah data
            return back()->with('error', 'Gagal mengubah data');
        }
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $pubKey = '448aa6eb11abd3614ce5';

        $response = Http::attach(
            'file',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post('https://upload.uploadcare.com/base/', [
            'UPLOADCARE_PUB_KEY' => $pubKey,
        ]);

        return dd($response->json());
    }



}
