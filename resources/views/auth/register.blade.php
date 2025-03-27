@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dados Pessoais</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" name="cpf" required placeholder="Digite seu CPF">
        </div>
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name" required placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required placeholder="Digite seu email">
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" name="password" required placeholder="Digite sua senha">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmação de Senha:</label>
            <input type="password" class="form-control" name="password_confirmation" required placeholder="Confirme sua senha">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Próximo</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const cpfInput = document.querySelector('input[name="cpf"]');

    cpfInput.addEventListener('blur', function () {
        const cpfValue = cpfInput.value;

       
        fetch(`/api/check-cpf/${cpfValue}`)
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Usuário não encontrado');
            })
            .then(data => {
                if (data.exists) {
                 
                    window.location.href = "{{ route('wizard.step2') }}";
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
    });

   
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            const registrationData = {
                cpf: document.querySelector('input[name="cpf"]').value,
                name: document.querySelector('input[name="name"]').value,
                email: document.querySelector('input[name="email"]').value,
                password: document.querySelector('input[name="password"]').value,
                password_confirmation: document.querySelector('input[name="password_confirmation"]').value,
            };
            localStorage.setItem('registrationData', JSON.stringify(registrationData));
        });
    });
});
</script>
@endsection