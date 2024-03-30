<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }
    //bring all users to the dashboard of this ueser
    public function index()
   {
    $clients = User::all();
    return view('client', compact('clients'));
   }}