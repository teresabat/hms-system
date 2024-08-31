@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($appointment) ? 'Editar' : 'Agendar' }} Consulta</h1>

        <form method="POST" action="{{ isset($appointment) ? route('appointments.update', $appointment->id) : route('appointments.store') }}">
            @csrf
            @if(isset($appointment))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="patient_id">Paciente</label>
                <select name="patient_id" id="patient_id" class="form-control" required>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ isset($appointment) && $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_date">Data da Consulta</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="{{ old('appointment_date', isset($appointment) ? $appointment->appointment_date->format('Y-m-d') : '') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', isset($appointment) ? $appointment->description : '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($appointment) ? 'Atualizar' : 'Agendar' }}</button>
        </form>
    </div>
@endsection
  