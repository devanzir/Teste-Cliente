@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card text-center shadow-lg">
        <div class="card-header bg-success text-white">
            <h4>Cadastro Concluído!</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Obrigado por se inscrever!</h5>
            <p class="card-text">Seus dados foram salvos com sucesso.</p>
            <a href="{{ route('wizard.index') }}" class="btn btn-primary btn-lg">Iniciar Novamente</a>
        </div>
        <div class="card-footer text-muted">
            &copy; {{ date('Y') }} Sua Empresa. Todos os direitos reservados.
        </div>
    </div>
</div>
@endsection
