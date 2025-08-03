<?php

namespace Database\Factories;

use App\Models\CooperativeMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CooperativeMember>
 */
class CooperativeMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\CooperativeMember>
     */
    protected $model = CooperativeMember::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'member_number' => 'KOP-' . str_pad((string)fake()->unique()->numberBetween(1, 999999), 6, '0', STR_PAD_LEFT),
            'simpanan_pokok' => fake()->randomFloat(2, 1000000, 5000000),
            'simpanan_wajib' => fake()->randomFloat(2, 2000000, 8000000),
            'simpanan_sukarela' => fake()->randomFloat(2, 0, 10000000),
            'total_pinjaman' => fake()->randomFloat(2, 0, 20000000),
            'unread_notifications' => fake()->numberBetween(0, 10),
        ];
    }
}