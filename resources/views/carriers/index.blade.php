@extends('adminlte::page')

@section('title', 'Transportadoras')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Transportadoras</h1>
        {{-- Quando implementar create no CarrierController: --}}
        <a href="{{ route('carriers.create') }}" class="btn btn-primary">
          <i class="fas fa-plus"></i> Nova transportadora
        </a>   
</div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th class="text-right">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($carriers as $carrier)
                        <tr>
                            <td>{{ $carrier->id }}</td>
                            <td>{{ $carrier->name }}</td>
                            <td>{{ $carrier->cnpj }}</td>
                            <td>{{ $carrier->city }}</td>
                            <td>{{ $carrier->state }}</td>
                            <td class="text-right">
                                {{-- Links quando edit/show/destroy estiverem implementados --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma transportadora cadastrada.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $carriers->links() }}
            </div>
        </div>
    </div>
@stop