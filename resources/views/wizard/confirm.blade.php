@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-info text-white text-center">
            <h4><i class="fas fa-check-circle"></i> Confirmação de Dados</h4>
        </div>
        <div class="card-body">
            <h5>Dados Pessoais</h5>
            <p><strong>ID:</strong> {{ session('dados_pessoais.id') }}</p> 
            <p><strong>CPF:</strong> {{ session('dados_pessoais.cpf') }}</p>
            <p><strong>Nome:</strong> {{ session('dados_pessoais.name') }}</p>
            <p><strong>Email:</strong> {{ session('dados_pessoais.email') }}</p>

            <h5>Endereço</h5>
            <p><strong>CEP:</strong> {{ session('endereco.cep') }}</p>
            <p><strong>Rua:</strong> {{ session('endereco.rua') }}</p>
            <p><strong>Cidade:</strong> {{ session('endereco.cidade') }}</p>
            <p><strong>Estado:</strong> {{ session('endereco.estado') }}</p>

            <h5>Arquivo Anexado</h5>
            <p>
                <a href="{{ asset('storage/' . session('dados_pessoais.arquivo')) }}" target="_blank" class="btn btn-outline-primary">
                    <i class="fas fa-file-download"></i> Ver Arquivo
                </a>
            </p>

            <form action="{{ route('wizard.submit') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100 btn-lg">
                    <i class="fas fa-check"></i> Finalizar Cadastro
                </button>
            </form>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection