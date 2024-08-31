@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Pacientes</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->phone_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
