@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Detalhes do Paciente</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $patient->first_name }} {{ $patient->last_name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $patient->email }}</p>
                <p class="card-text"><strong>Telefone:</strong> {{ $patient->phone_number }}</p>
                <p class="card-text"><strong>Data de Nascimento:</strong> {{ $patient->date_of_birth }}</p>
                <p class="card-text"><strong>Endereço:</strong> {{ $patient->address }}</p>
                <a href="{{ route('patients.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
@endsection
