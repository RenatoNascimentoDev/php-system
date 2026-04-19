@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content_header')
    <h1>Editar Pedido</h1>
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

            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" class="form-control" value="{{ old('description', $order->description) }}" required>
                </div>

                <div class="form-group">
                    <label>Nome do cliente</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $order->customer_name) }}" required>
                </div>

                <div class="form-group">
                    <label>Produto</label>
                    <input type="text" name="product" class="form-control" value="{{ old('product', $order->product) }}" required>
                </div>

                <div class="form-group">
                    <label>Preço</label>
                    <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $order->price) }}" required>
                </div>

                <div class="form-group">
                    <label>Quantidade</label>
                    <input type="number" min="1" name="quantity" class="form-control" value="{{ old('quantity', $order->quantity) }}" required>
                </div>

                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
