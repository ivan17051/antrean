<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pasien;

class ProfileController extends Controller
{
    /**
     * Show the profile page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('profile', ['user'=>$user]);
    }

    public function store(ProfileRequest $request)
    {
        $user = Auth::user();
        
        return '';
    }

    public function update(ProfileRequest $request, $id)
    {
        $user = Auth::user();
        
        return '';
    }
}
