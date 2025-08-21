<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\StrategicPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StrategicPlan>
 */
class StrategicPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\StrategicPlan>
     */
    protected $model = StrategicPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startYear = fake()->numberBetween(2020, 2024);
        $endYear = $startYear + fake()->numberBetween(1, 5);
        
        $types = ['renstra', 'renja', 'action_plan', 'rpjmd', 'rkpd'];
        $type = fake()->randomElement($types);
        
        $names = [
            'renstra' => 'Rencana Strategis ' . $startYear . '-' . $endYear,
            'renja' => 'Rencana Kerja ' . $startYear,
            'action_plan' => 'Rencana Aksi ' . $startYear,
            'rpjmd' => 'RPJMD ' . $startYear . '-' . $endYear,
            'rkpd' => 'RKPD ' . $startYear,
        ];

        return [
            'organization_id' => Organization::factory(),
            'name' => $names[$type] ?? 'Strategic Plan ' . $startYear,
            'type' => $type,
            'start_year' => $startYear,
            'end_year' => $endYear,
            'description' => fake()->paragraph(),
            'objectives' => [
                'Meningkatkan kualitas pelayanan publik',
                'Memperkuat tata kelola pemerintahan',
                'Mengoptimalkan pembangunan infrastruktur',
                'Memberdayakan ekonomi masyarakat',
            ],
            'status' => fake()->randomElement(['draft', 'active', 'completed']),
        ];
    }

    /**
     * Indicate that the strategic plan is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}