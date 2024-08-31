<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all()->map(function($appointment) {
            $appointment->date = \Carbon\Carbon::parse($appointment->date);
            return $appointment;
        });

        return view('appointments.index', compact('appointments'));
    }
    

    public function create()
    {
        $patients = \App\Models\Patient::all();
        return view('appointments.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Consulta agendada com sucesso!');
    }

    public function show(string $id)
    {
    $appointment = Appointment::findOrFail($id);
    $appointment->appointment_date = \Carbon\Carbon::parse($appointment->appointment_date);

        return view('appointments.show', compact('appointment'));
    }


    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = \App\Models\Patient::all();
        return view('appointments.edit', compact('appointment', 'patients'));
    }



    public function update(Request $request, string $id)
    {
         $request->validate([
        'patient_id' => 'required|exists:patients,id',  
        'appointment_date' => 'required|date',
        'description' => 'nullable|string',
    ]);

    $appointment = Appointment::findOrFail($id);

    $appointment->update([
        'patient_id' => $request->input('patient_id'),
        'appointment_date' => $request->input('appointment_date'),
        'description' => $request->input('description'),
    ]);

    return redirect()->route('appointments.index')->with('success', 'Consulta atualizada com sucesso!');
    }


 
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Consulta excluída com sucesso!');
    }
}
