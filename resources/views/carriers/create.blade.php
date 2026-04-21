@extends('adminlte::page')

@section('title', 'Nova transportadora')

@section('content_header')
    <h1>Nova transportadora</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('carriers.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>CNPJ</label>
                    <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj') }}" required>
                </div>

                <div class="form-group">
    <label>CEP</label>

            <div class="input-group">
                <input
                    type="text"
                    name="cep"
                    id="cep"
                    class="form-control"
                    value="{{ old('cep') }}"
                    placeholder="00000-000"
                    maxlength="9"
                    inputmode="numeric"
                    autocomplete="postal-code"
                    required
                >

                <div class="input-group-append">
                    <button type="button" id="search-cep" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

    <small class="form-text text-muted">
        Digite o CEP e clique na lupa para buscar o endereço.
    </small>
</div>


                <div class="form-group">
                    <label>Estado (UF)</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" maxlength="2" required>
                </div>

                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
                </div>

                <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" name="district" id="district" class="form-control" value="{{ old('district') }}" required>
                </div>

                <div class="form-group">
                    <label>Rua</label>
                    <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required>
                </div>

                <div class="form-group">
                    <label>Número</label>
                    <input type="text" name="number" class="form-control" value="{{ old('number') }}" required>
                </div>

                <div class="form-group">
                    <label>Complemento</label>
                    <input type="text" name="complement" class="form-control" value="{{ old('complement') }}">
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('carriers.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const cepInput = document.getElementById('cep');
    const searchCepButton = document.getElementById('search-cep');

    function formatCep(value) {
        const digits = value.replace(/\D/g, '').slice(0, 8);

        if (digits.length <= 5) {
            return digits;
        }

        return digits.slice(0, 5) + '-' + digits.slice(5);
    }

    async function fetchCep() {
        const cep = cepInput.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert('Digite um CEP válido com 8 números.');
            return;
        }

        try {
            const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            const data = await res.json();

            if (!data || data.erro) {
                alert('CEP não encontrado.');
                return;
            }

            document.getElementById('state').value = (data.uf || '').toUpperCase();
            document.getElementById('city').value = data.localidade || '';
            document.getElementById('district').value = data.bairro || '';
            document.getElementById('street').value = data.logradouro || '';
        } catch (e) {
            alert('Falha ao consultar o ViaCEP. Tente novamente.');
        }
    }

    cepInput.addEventListener('input', () => {
        cepInput.value = formatCep(cepInput.value);
    });

    searchCepButton.addEventListener('click', fetchCep);

    cepInput.addEventListener('blur', () => {
        const cep = cepInput.value.replace(/\D/g, '');

        if (cep.length === 8) {
            fetchCep();
        }
    });
});
</script>
@stop
