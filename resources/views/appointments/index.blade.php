@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Consultas</h1>

        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Agendar Consulta</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                        <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>
                        <td>{{ $appointment->description }}</td>
                        <td>
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhuma consulta encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
