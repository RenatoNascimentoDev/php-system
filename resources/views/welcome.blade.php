<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PHP System</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Total de pedidos: {{ $totalOrders ?? 0 }}</p>
    <p>Total vendido: R$ {{ number_format($totalRevenue ?? 0, 2, ',', '.') }}</p>

    <hr>

    <a href="{{ route('orders.index') }}">Pedidos</a> |
    <a href="{{ route('carriers.index') }}">Transportadoras</a>
</body>
</html>