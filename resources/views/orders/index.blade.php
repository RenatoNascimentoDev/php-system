@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Pedidos</h1>

        <div>
            <a href="{{ route('orders.export') }}" class="btn btn-success mr-2">
                <i class="fas fa-file-csv"></i> Download CSV
            </a>

            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Novo Pedido
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('orders.index') }}" class="mb-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Buscar por nome do cliente..."
                        value="{{ $search }}"
                    >
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-dark">
                            Limpar
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Qtd</th>
                        <th>Total</th>
                        <th class="text-right">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->description }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->product }}</td>
                            <td>R$ {{ number_format($order->price, 2, ',', '.') }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>R$ {{ number_format($order->total, 2, ',', '.') }}</td>
                            <td class="text-right">
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Deseja remover este pedido?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Nenhum pedido encontrado.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@stop