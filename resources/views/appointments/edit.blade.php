@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Consulta</h1>

    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="patient_id">Paciente:</label>
            <select id="patient_id" name="patient_id" class="form-control" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                        {{ $patient->first_name . ' ' . $patient->last_name }}
                    </option>
                @endforeach
            </select>
            @error('patient_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

       <div class="mb-3">
          <label for="appointment_date" class="form-label">Data e Hora:</label>
          <input type="datetime-local" id="appointment_date" name="appointment_date" class="form-control"
              value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}" required>
          @error('appointment_date')
              <div class="text-danger">{{ $message }}</div>
          @enderror
      </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <input type="text" id="description" name="description" class="form-control" 
                   value="{{ old('description', $appointment->description) }}" 
                   required>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
