<?php

namespace Database\Seeders;

use App\Models\CooperativeMember;
use App\Models\Loan;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class CooperativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample products
        Product::create([
            'name' => 'TV LED 55"',
            'price' => 5999000,
            'status' => 'promo',
            'category' => 'Elektronik',
            'description' => 'Smart TV LED 55 inch dengan fitur lengkap',
        ]);

        Product::create([
            'name' => 'Kulkas 2 Pintu',
            'price' => 6750000,
            'status' => 'baru',
            'category' => 'Elektronik',
            'description' => 'Kulkas 2 pintu dengan teknologi inverter',
        ]);

        Product::create([
            'name' => 'Sofa Minimalis',
            'price' => 3200000,
            'status' => 'promo',
            'category' => 'Furnitur',
            'description' => 'Sofa minimalis 3 seater berbahan berkualitas',
        ]);

        Product::create([
            'name' => 'Mesin Cuci Front Loading',
            'price' => 4500000,
            'status' => 'reguler',
            'category' => 'Elektronik',
            'description' => 'Mesin cuci front loading kapasitas 8kg',
        ]);

        // Create sample user if not exists
        $user = User::firstOrCreate(
            ['email' => 'member@cooperative.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password'),
            ]
        );

        // Create cooperative member
        $member = CooperativeMember::firstOrCreate(
            ['user_id' => $user->id],
            [
                'member_number' => 'KOP-001234',
                'simpanan_pokok' => 2500000,
                'simpanan_wajib' => 4950000,
                'simpanan_sukarela' => 5000000,
                'total_pinjaman' => 10500000,
                'unread_notifications' => 3,
            ]
        );

        // Create sample loans
        Loan::firstOrCreate(
            ['member_id' => $member->id, 'loan_type' => 'TV'],
            [
                'product_name' => 'TV LED 42"',
                'amount' => 5000000,
                'remaining_balance' => 3500000,
                'status' => 'active',
            ]
        );

        Loan::firstOrCreate(
            ['member_id' => $member->id, 'loan_type' => 'Kulkas'],
            [
                'product_name' => 'Kulkas 2 Pintu',
                'amount' => 4000000,
                'remaining_balance' => 2500000,
                'status' => 'active',
            ]
        );

        Loan::firstOrCreate(
            ['member_id' => $member->id, 'loan_type' => 'Furnitur'],
            [
                'product_name' => 'Sofa Set',
                'amount' => 3000000,
                'remaining_balance' => 1500000,
                'status' => 'active',
            ]
        );

        // Create sample transactions
        Transaction::firstOrCreate(
            [
                'member_id' => $member->id,
                'title' => 'Angsuran Pinjaman (PMK-TV42)',
                'transaction_date' => now()->subDays(1),
            ],
            [
                'subtitle' => 'TV LED 42"',
                'amount' => 154000,
                'type' => 'expense',
                'category' => 'loan_payment',
            ]
        );

        Transaction::firstOrCreate(
            [
                'member_id' => $member->id,
                'title' => 'Setoran Simpanan',
                'transaction_date' => now()->subDays(2),
            ],
            [
                'subtitle' => 'SW - Simpanan Wajib',
                'amount' => 15000,
                'type' => 'income',
                'category' => 'savings_deposit',
            ]
        );

        Transaction::firstOrCreate(
            [
                'member_id' => $member->id,
                'title' => 'Angsuran Pinjaman (PMK-KLK)',
                'transaction_date' => now()->subDays(3),
            ],
            [
                'subtitle' => 'Kulkas 2 Pintu',
                'amount' => 125000,
                'type' => 'expense',
                'category' => 'loan_payment',
            ]
        );

        Transaction::firstOrCreate(
            [
                'member_id' => $member->id,
                'title' => 'Transfer Masuk',
                'transaction_date' => now()->subDays(5),
            ],
            [
                'subtitle' => 'Dari Anggota Lain',
                'amount' => 50000,
                'type' => 'income',
                'category' => 'transfer',
            ]
        );

        Transaction::firstOrCreate(
            [
                'member_id' => $member->id,
                'title' => 'Pembelian Produk',
                'transaction_date' => now()->subDays(7),
            ],
            [
                'subtitle' => 'Furnitur Sofa',
                'amount' => 300000,
                'type' => 'expense',
                'category' => 'product_purchase',
            ]
        );
    }
}