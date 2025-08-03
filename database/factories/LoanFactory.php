<?php

namespace Database\Factories;

use App\Models\CooperativeMember;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Loan>
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loanTypes = [
            ['type' => 'TV', 'products' => ['TV LED 42"', 'TV LED 55"', 'Smart TV 65"']],
            ['type' => 'Kulkas', 'products' => ['Kulkas 2 Pintu', 'Kulkas 1 Pintu', 'Kulkas Side by Side']],
            ['type' => 'Furnitur', 'products' => ['Sofa Set', 'Lemari Pakaian', 'Meja Makan']],
        ];

        $selectedType = fake()->randomElement($loanTypes);
        $amount = fake()->randomFloat(2, 2000000, 15000000);

        return [
            'member_id' => CooperativeMember::factory(),
            'loan_type' => $selectedType['type'],
            'product_name' => fake()->randomElement($selectedType['products']),
            'amount' => $amount,
            'remaining_balance' => fake()->randomFloat(2, 0, $amount),
            'status' => fake()->randomElement(['active', 'paid_off']),
        ];
    }
}