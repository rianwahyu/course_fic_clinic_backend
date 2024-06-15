<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceMedicineController extends Controller
{
    //index
    public function index(Request $request)
    {
        //get all service medicines paginated         
        //search service medicine by name

        $service_medicine = \App\Models\ServiceMedicines::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'desc')
            ->get();
        return response([
            'data' => $service_medicine,
            'message' => 'Success',
            'status' => 'OK',
        ], 200);
    }
}
