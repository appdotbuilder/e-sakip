<?php

namespace Database\Factories;

use App\Models\PerformanceIndicator;
use App\Models\PerformanceMeasurement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerformanceMeasurement>
 */
class PerformanceMeasurementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\PerformanceMeasurement>
     */
    protected $model = PerformanceMeasurement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $targetValue = fake()->randomFloat(2, 50, 100);
        $actualValue = fake()->randomFloat(2, 30, 120);
        $achievementPercentage = ($actualValue / $targetValue) * 100;

        return [
            'performance_indicator_id' => PerformanceIndicator::factory(),
            'actual_value' => $actualValue,
            'target_value' => $targetValue,
            'achievement_percentage' => round($achievementPercentage, 2),
            'measurement_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'notes' => fake()->optional()->paragraph(),
            'supporting_documents' => fake()->optional()->randomElements([
                'laporan-bulanan.pdf',
                'data-survey.xlsx',
                'foto-kegiatan.jpg',
                'surat-keterangan.pdf',
            ], fake()->numberBetween(0, 3)),
            'created_by' => User::factory(),
        ];
    }
}