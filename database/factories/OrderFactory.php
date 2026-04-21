<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $price = fake()->randomFloat(2, 500, 12000);
        $quantity = fake()->numberBetween(1, 10);
        $total = $price * $quantity;

        $products = [
            'iPhone 15',
            'Notebook Dell Inspiron',
            'Monitor LG 27"',
            'Teclado Mecânico Redragon',
            'Mouse Logitech G Pro',
            'SSD NVMe 1TB',
            'Placa de Vídeo RTX 4060',
            'Memória RAM 16GB DDR4',
            'Processador Ryzen 7',
            'Headset HyperX Cloud',
        ];

        return [
            'description' => fake()->sentence(3),
            'customer_name' => fake()->name(),
            'product' => fake()->randomElement($products),
            'price' => $price,
            'quantity' => $quantity,
            'total' => $total,
        ];
    }
}
