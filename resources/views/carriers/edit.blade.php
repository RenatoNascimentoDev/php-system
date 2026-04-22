@extends('adminlte::page')

@section('title', 'Editar transportadora')

@section('content_header')
    <h1>Editar transportadora</h1>
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

            <form action="{{ route('carriers.update', $carrier) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $carrier->name) }}" required>
                </div>

                <div class="form-group">
                    <label>CNPJ</label>
                    <input
                        type="text"
                        name="cnpj"
                        id="cnpj"
                        class="form-control"
                        value="{{ old('cnpj', $carrier->cnpj) }}"
                        placeholder="XX.XXX.XXX/XXXX-XX"
                        maxlength="18"
                        autocomplete="off"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>CEP</label>
                    <input
                        type="text"
                        name="cep"
                        id="cep"
                        class="form-control"
                        value="{{ old('cep', $carrier->cep) }}"
                        placeholder="00000-000"
                        required
                    >
                    <small class="form-text text-muted">Ao sair do campo, buscamos o endereço no ViaCEP.</small>
                </div>

                <div class="form-group">
                    <label>Estado (UF)</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $carrier->state) }}" maxlength="2" required>
                </div>

                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $carrier->city) }}" required>
                </div>

                <div class="form-group">
                    <label>Bairro</label>
                    <input type="text" name="district" id="district" class="form-control" value="{{ old('district', $carrier->district) }}" required>
                </div>

                <div class="form-group">
                    <label>Rua</label>
                    <input type="text" name="street" id="street" class="form-control" value="{{ old('street', $carrier->street) }}" required>
                </div>

                <div class="form-group">
                    <label>Número</label>
                    <input
                    type="text"
                    name="number"
                    id="number"
                    class="form-control"
                    value="{{ old('number', $carrier->number) }}"
                    maxlength="5"
                    inputmode="numeric"
                    pattern="\d{1,5}"
                    required
                >


                </div>

                <div class="form-group">
                    <label>Complemento</label>
                    <input type="text" name="complement" class="form-control" value="{{ old('complement', $carrier->complement) }}">
                </div>

                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('carriers.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const cnpjInput = document.getElementById('cnpj');
    const numberInput = document.getElementById('number');

    function formatCnpj(value) {
        const chars = value
            .toUpperCase()
            .replace(/[^A-Z0-9]/g, '')
            .slice(0, 14);

        let masked = chars;

        if (masked.length > 2) {
            masked = masked.slice(0, 2) + '.' + masked.slice(2);
        }

        if (masked.length > 6) {
            masked = masked.slice(0, 6) + '.' + masked.slice(6);
        }

        if (masked.length > 10) {
            masked = masked.slice(0, 10) + '/' + masked.slice(10);
        }

        if (masked.length > 15) {
            masked = masked.slice(0, 15) + '-' + masked.slice(15);
        }

        return masked;
    }

    cnpjInput.value = formatCnpj(cnpjInput.value);

    numberInput.addEventListener('input', () => {
        numberInput.value = numberInput.value.replace(/\D/g, '').slice(0, 5);
    });

    cnpjInput.addEventListener('input', () => {
        cnpjInput.value = formatCnpj(cnpjInput.value);
    });


    const cepInput = document.getElementById('cep');

    cepInput.addEventListener('blur', async () => {
        const raw = cepInput.value || '';
        const cep = raw.replace(/\D/g, '');

        if (cep.length !== 8) {
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
    });
});
</script>
@stop
