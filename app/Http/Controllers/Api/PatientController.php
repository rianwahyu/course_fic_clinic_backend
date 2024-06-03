<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PatientController extends Controller
{
    //
    public function index(Request $request)
    {
        $patients = DB::table('patients')
            ->when($request->input('nik'), function ($query, $name) {
                return $query->where('nik', 'like', '% ' . $name . '% ');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response([
            'patients' => $patients,
            'message' => 'success',
            'status' => 'OK'
        ], 200);
    }
}
