@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(auth()->check()) 
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded">
                    <div class="card-header bg-success text-white text-center">
                        <h4><i class="fas fa-users"></i> Lista de Clientes</h4>
                        <a href="{{ route('clients.create') }}" class="btn btn-light mt-2">
                            <i class="fas fa-plus"></i> Criar Novo Cliente
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>Contrato</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->phone }}</td>
                                            <td>
                                                <a href="{{ Storage::url($client->contract_attachment) }}" class="btn btn-info btn-sm" target="_blank">Ver Contrato</a>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm mx-1">Editar</a>
                                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($clients->isEmpty())
                            <p class="text-center">Nenhum cliente encontrado.</p>
                        @endif

                        <div class="d-flex justify-content-end mt-3">
                            {{ $clients->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">Você precisa estar logado para acessar esta página.</div>
    @endif
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

<style>
.table td, .table th {
    vertical-align: middle;
}

.table th {
    text-align: center;
}

.table td {
    padding: 15px;
}

.btn {
    margin: 0 5px;
}

.pagination {
    margin: 0;
    font-size: 14px;
}

.pagination .page-item .page-link {
    padding: 5px 10px;
    border-radius: 5px;
}

.pagination .page-item.active .page-link {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
}
</style>