<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $orders = Order::query()
            ->when($search, function ($query, $search) {
                $query->where('customer_name', 'like', "%{$search}%");
            })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('orders.index', compact('orders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'customer_name' => ['required', 'string', 'max:255'],
            'product' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $data['total'] = (float) $data['price'] * (int) $data['quantity'];

        Order::create($data);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pedido cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'customer_name' => ['required', 'string', 'max:255'],
            'product' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $data['total'] = (float) $data['price'] * (int) $data['quantity'];

        $order->update($data);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pedido removido com sucesso!');
    }

    public function exportCsv()
    {
        $fileName = 'orders_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');

            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID',
                'Descricao',
                'Nome do Cliente',
                'Produto',
                'Preco',
                'Quantidade',
                'Total',
                'Criado em',
            ], ';');

            Order::query()
                ->orderBy('id')
                ->chunk(500, function ($orders) use ($handle) {
                    foreach ($orders as $order) {
                        fputcsv($handle, [
                            $order->id,
                            $order->description,
                            $order->customer_name,
                            $order->product,
                            number_format((float) $order->price, 2, '.', ''),
                            $order->quantity,
                            number_format((float) $order->total, 2, '.', ''),
                            optional($order->created_at)->format('Y-m-d H:i:s'),
                        ], ';');
                    }
                });
                fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
