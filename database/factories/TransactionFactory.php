<?php

namespace Database\Factories;

use App\Models\CooperativeMember;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Transaction>
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactionTypes = [
            'income' => [
                ['title' => 'Setoran Simpanan', 'subtitle' => 'SW - Simpanan Wajib', 'category' => 'savings_deposit'],
                ['title' => 'Setoran Simpanan', 'subtitle' => 'SSK - Simpanan Sukarela', 'category' => 'savings_deposit'],
                ['title' => 'Transfer Masuk', 'subtitle' => 'Dari Anggota Lain', 'category' => 'transfer'],
            ],
            'expense' => [
                ['title' => 'Angsuran Pinjaman (PMK-TV42)', 'subtitle' => 'TV LED 42"', 'category' => 'loan_payment'],
                ['title' => 'Angsuran Pinjaman (PMK-KLK)', 'subtitle' => 'Kulkas 2 Pintu', 'category' => 'loan_payment'],
                ['title' => 'Pembelian Produk', 'subtitle' => 'Furnitur Sofa', 'category' => 'product_purchase'],
                ['title' => 'Transfer Keluar', 'subtitle' => 'Ke Anggota Lain', 'category' => 'transfer'],
            ],
        ];

        $type = fake()->randomElement(['income', 'expense']);
        $transaction = fake()->randomElement($transactionTypes[$type]);

        return [
            'member_id' => CooperativeMember::factory(),
            'title' => $transaction['title'],
            'subtitle' => $transaction['subtitle'],
            'amount' => fake()->randomFloat(2, 15000, 2000000),
            'type' => $type,
            'category' => $transaction['category'],
            'transaction_date' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}