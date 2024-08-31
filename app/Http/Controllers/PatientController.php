<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Patient;
use PDF;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
        }

        $patients = $query->get();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone_number' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
        ]);

        Patient::create($data);
        return redirect()->route('patients.index')->with('success', 'Paciente adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.form', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'phone_number' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
        ]);

        $patient->update($data);
        return redirect()->route('patients.index')->with('success', 'Paciente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Paciente excluído com sucesso!');
    }

    public function exportCsv()
    {
        $patients = Patient::all();

        $csvData = "ID,Nome,Email,Telefone\n";

        foreach ($patients as $patient) {
            $csvData .= "{$patient->id},{$patient->first_name} {$patient->last_name},{$patient->email},{$patient->phone_number}\n";
        }

        $fileName = 'patients_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return Response::make($csvData, 200, $headers);
    }

    public function exportPdf()
    {
        $patients = Patient::all();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('patients.export_pdf', compact('patients'));

        return $pdf->download('patients_' . date('Ymd_His') . '.pdf');
    }
}
