@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agendar Consulta</h1>

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="patient_id" class="form-label">Paciente</label>
            <select id="patient_id" name="patient_id" class="form-select" required>
                <option value="" disabled selected>Selecione um paciente</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                @endforeach
            </select>
            @error('patient_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">
            <label for="appointment_date" class="form-label">Data e Hora</label>
            <input type="datetime-local" id="appointment_date" name="appointment_date" class="form-control" 
                   value="{{ old('appointment_date', $defaultDate) }}" 
                   required>
            @error('appointment_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" id="description" name="description" class="form-control" required>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Agendar</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
