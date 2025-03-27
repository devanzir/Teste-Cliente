@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Endereço</h2>
    <form action="{{ route('wizard.step2') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" id="cep" class="form-control" name="cep" placeholder="Digite o CEP" required>
        </div>
        <div class="form-group">
            <label for="rua">Rua:</label>
            <input type="text" id="rua" class="form-control" name="rua" placeholder="Rua" required readonly>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" class="form-control" name="cidade" placeholder="Cidade" required readonly>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" name="estado" id="estado" required>
                <option value="">Selecione o Estado</option>
                @foreach ([
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MT' => 'Mato Grosso',
                    'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins',
                ] as $sigla => $estado)
                    <option value="{{ $sigla }}">{{ $estado }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Próximo</button>
    </form>
</div>

<script>
    document.getElementById('cep').addEventListener('blur', function() {
        var cep = this.value.replace(/\D/g, '');
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    } else {
                        alert('CEP não encontrado.');
                        document.getElementById('rua').value = '';
                        document.getElementById('cidade').value = '';
                        document.getElementById('estado').value = '';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                });
        } else {
            alert('CEP inválido, deve conter 8 dígitos.');
        }
    });
</script>
@endsection