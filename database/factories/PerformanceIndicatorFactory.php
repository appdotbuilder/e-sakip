<?php

namespace Database\Factories;

use App\Models\PerformanceIndicator;
use App\Models\StrategicPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerformanceIndicator>
 */
class PerformanceIndicatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\PerformanceIndicator>
     */
    protected $model = PerformanceIndicator::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indicators = [
            [
                'name' => 'Tingkat Kepuasan Masyarakat',
                'unit' => '%',
                'type' => 'outcome',
                'target' => fake()->numberBetween(80, 95),
            ],
            [
                'name' => 'Jumlah Layanan Digital',
                'unit' => 'unit',
                'type' => 'output',
                'target' => fake()->numberBetween(10, 50),
            ],
            [
                'name' => 'Waktu Proses Perizinan',
                'unit' => 'hari',
                'type' => 'output',
                'target' => fake()->numberBetween(3, 14),
            ],
            [
                'name' => 'Jumlah Program Pelatihan',
                'unit' => 'program',
                'type' => 'output',
                'target' => fake()->numberBetween(5, 20),
            ],
            [
                'name' => 'Tingkat Partisipasi Masyarakat',
                'unit' => '%',
                'type' => 'outcome',
                'target' => fake()->numberBetween(70, 90),
            ],
        ];

        $indicator = fake()->randomElement($indicators);

        return [
            'strategic_plan_id' => StrategicPlan::factory(),
            'name' => $indicator['name'],
            'code' => 'KPI-' . strtoupper(fake()->unique()->lexify('???-???')),
            'definition' => fake()->paragraph(),
            'unit' => $indicator['unit'],
            'target_value' => $indicator['target'],
            'type' => $indicator['type'],
            'measurement_frequency' => fake()->randomElement(['monthly', 'quarterly', 'yearly']),
            'cascading_data' => [
                'level' => fake()->randomElement(['strategic', 'operational', 'tactical']),
                'weight' => fake()->numberBetween(10, 30),
            ],
        ];
    }
}