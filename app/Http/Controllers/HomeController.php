<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class HomeController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(10);
    return view('home', compact('clients'));
    }
}