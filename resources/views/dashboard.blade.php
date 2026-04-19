<h1>Dashboard</h1>
<p>Total de pedidos: {{ $totalOrders }}</p>
<p>Total vendido: R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
<a href="{{ route('orders.index') }}">Pedidos</a>
<a href="{{ route('carriers.index') }}">Transportadoras</a>