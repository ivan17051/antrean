<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\PoliRequest;
use Illuminate\Support\Facades\DB;
use App\UnitKerjaPoli;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index(){
        // $idunitkerja = Auth::user()->idunitkerja;
		return view('poli');
	}

    public function getall(){
        // $idunitkerja = Auth::user()->idunitkerja;
        $idunitkerja = 47;
        $unitkerjapoli = UnitKerjaPoli::where('idunitkerja', $idunitkerja)->get();
		return response()->json($unitkerjapoli);
	}

	public function create(){
		
	}

	public function store(ProfesiRequest $request){	

	}

	public function show($id){
		
	}

	public function edit($id){	
    	
	}

	public function update(ProfesiRequest $request, $id){	
		
	}

	public function destroy($id){	
		
	}
}
