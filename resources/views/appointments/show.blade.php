@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da Consulta</h1>

        <p><strong>ID:</strong> {{ $appointment->id }}</p>
        <p><strong>Paciente:</strong> {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
        <p><strong>Data:</strong> {{ $appointment->appointment_date->format('d/m/Y') }}</p>
        <p><strong>Descrição:</strong> {{ $appointment->description }}</p>

        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Voltar</a>
        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
    </div>
@endsection
