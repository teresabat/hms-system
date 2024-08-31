<!-- resources/views/patients/form.blade.php -->

@extends('layouts.app') <!-- Substitua 'layouts.app' pelo seu layout base se for diferente -->

@section('content')
<div class="container">
    <h1>{{ isset($patient) ? 'Editar Paciente' : 'Criar Paciente' }}</h1>

    <form action="{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}" method="POST">
        @csrf
        @if(isset($patient))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('first_name', $patient->first_name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $patient->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefone:</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone_number', $patient->phone_number ?? '') }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Endereço:</label>
            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $patient->address ?? '') }}</textarea>
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($patient) ? 'Atualizar' : 'Criar' }}</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
