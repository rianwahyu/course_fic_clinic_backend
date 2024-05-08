<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;


class DoctorScheduleController extends Controller
{
    //

    public function index(Request $request)
    {
        $doctorSchedules = DoctorSchedule::with('doctor')
            ->when($request->input('doctor_id'), function ($query, $doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })
            ->orderBy('doctor_id', 'asc')
            //->load('doctor')
            ->paginate(10);

        return view('pages.doctor_schedules.index', compact('doctorSchedules'));
    }

    public function create()
    {
        return view('pages.doctor_schedules.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required|email',
            'time' => 'required',
        ]);

        $doctorSchedule = new DoctorSchedule();
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->day;
        $doctorSchedule->time = $request->time;
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;
        $doctorSchedule->save();

        return  redirect()->route('doctor_schedules.index')->with('success', 'Doctor Schedule Created SuccessFully');
    }

    public function show($id)
    {
        //$user = Doctor::find($id);
        $doctor = DB::table('doctors')->where('id', $id)->first();

        return view('pages.doctor_schedules.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctorSchedule = DoctorSchedule::find($id);
        //$doctor = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctor_schedules.edit', compact('doctor'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required|email',
            'time' => 'required',
        ]);

        $doctorSchedule =  DoctorSchedule::find($id);
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->day;
        $doctorSchedule->time = $request->time;
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;
        $doctorSchedule->save();

        return  redirect()->route('doctor_schedules.index')->with('success', 'Doctor Update SuccessFully');
    }

    public function destroy($id)
    {

        DoctorSchedule::find($id)->delete();
        return  redirect()->route('doctor_schedules.index')->with('success', 'Doctor Delete SuccessFully');
    }
}
