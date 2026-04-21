<?php

namespace Database\Factories;

use App\Models\Carrier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Carrier>
 */
class CarrierFactory extends Factory
{
    protected $model = Carrier::class;

    public function definition(): array
    {
        $locations = [
            ['state' => 'SP', 'city' => 'Sao Paulo', 'district' => 'Vila Mariana'],
            ['state' => 'RJ', 'city' => 'Rio de Janeiro', 'district' => 'Centro'],
            ['state' => 'MG', 'city' => 'Belo Horizonte', 'district' => 'Savassi'],
            ['state' => 'PR', 'city' => 'Curitiba', 'district' => 'Batel'],
            ['state' => 'RS', 'city' => 'Porto Alegre', 'district' => 'Moinhos de Vento'],
        ];

        $location = fake()->randomElement($locations);

        return [
            'name' => fake()->company(),
            'cnpj' => fake()->unique()->numerify('##.###.###/0001-##'),
            'cep' => fake()->numerify('#####-###'),
            'state' => $location['state'],
            'city' => $location['city'],
            'district' => $location['district'],
            'street' => fake()->randomElement([
                'Rua das Flores',
                'Avenida Brasil',
                'Rua do Comercio',
                'Avenida Paulista',
                'Rua XV de Novembro',
            ]),
            'number' => (string) fake()->numberBetween(10, 9999),
            'complement' => fake()->boolean(35)
                ? fake()->randomElement(['Sala 2', 'Bloco A', 'Andar 3', 'Galpao B'])
                : null,
        ];
    }
}
