@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ isset($patient) ? 'Editar Paciente' : 'Adicionar Paciente' }}</h1>
        <form action="{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}" method="POST">
            @csrf
            @if(isset($patient))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="first_name">Nome</label>
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $patient->first_name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Sobrenome</label>
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $patient->last_name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $patient->email ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Telefone</label>
                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $patient->phone_number ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Data de Nascimento</label>
                <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Endereço</label>
                <textarea class="form-control" name="address" required>{{ old('address', $patient->address ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($patient) ? 'Atualizar' : 'Salvar' }}</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
@endsection
