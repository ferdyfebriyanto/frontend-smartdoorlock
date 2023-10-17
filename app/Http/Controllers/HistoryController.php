<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    function index(){
        $res = Http::get('http://127.0.0.1:5000/history');

        $data = $res->json()['data'];

        return view('pages.history.index', ['data' => $data]);
    }
}
