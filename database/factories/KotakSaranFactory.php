<?php

namespace Database\Factories;

use App\Models\KotakSaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KotakSaran>
 */
class KotakSaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */
    protected $model = KotakSaran::class;
    protected $fillable = [
        'nama',
        'email',
        'isi_saran',
    ];
    public function definition(): array
    {
        return [
            //
        ];
    }
}
