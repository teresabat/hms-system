@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Pacientes</h1>

        <!-- Campo de busca -->
        <form method="GET" action="{{ route('patients.index') }}" class="form-inline mb-4">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Buscar paciente" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Botões de ação -->
        <div class="mb-4">
            <a href="{{ route('patients.create') }}" class="btn btn-primary">Adicionar Paciente</a>
            <a href="{{ route('patients.export.csv') }}" class="btn btn-success ml-2">Exportar CSV</a>
            <a href="{{ route('patients.export.pdf') }}" class="btn btn-danger ml-2">Exportar PDF</a>
        </div>

        <!-- Tabela de pacientes -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->phone_number }}</td>
                        <td>
                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhum paciente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
