<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Organization>
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['regional_apparatus', 'district_government'];
        $type = fake()->randomElement($types);
        
        $names = $type === 'district_government' 
            ? [
                'Pemerintah Kabupaten Bandung',
                'Pemerintah Kota Jakarta Selatan', 
                'Pemerintah Kabupaten Surabaya',
                'Pemerintah Kota Medan',
                'Pemerintah Kabupaten Yogyakarta'
            ]
            : [
                'Dinas Pendidikan',
                'Dinas Kesehatan',
                'Dinas Pekerjaan Umum',
                'Dinas Perhubungan',
                'Bappeda',
                'Dinas Sosial',
                'Dinas Pariwisata',
                'Dinas Pertanian',
                'Dinas Perindustrian',
                'Sekretariat Daerah'
            ];

        return [
            'name' => fake()->randomElement($names),
            'code' => strtoupper(fake()->unique()->lexify('???-??')),
            'type' => $type,
            'description' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the organization is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the organization is a district government.
     */
    public function districtGovernment(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'district_government',
            'name' => fake()->randomElement([
                'Pemerintah Kabupaten Bandung',
                'Pemerintah Kota Jakarta Selatan', 
                'Pemerintah Kabupaten Surabaya',
                'Pemerintah Kota Medan',
                'Pemerintah Kabupaten Yogyakarta'
            ]),
        ]);
    }

    /**
     * Indicate that the organization is a regional apparatus.
     */
    public function regionalApparatus(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'regional_apparatus',
            'name' => fake()->randomElement([
                'Dinas Pendidikan',
                'Dinas Kesehatan',
                'Dinas Pekerjaan Umum',
                'Dinas Perhubungan',
                'Bappeda',
                'Dinas Sosial',
                'Dinas Pariwisata',
                'Dinas Pertanian',
                'Dinas Perindustrian',
                'Sekretariat Daerah'
            ]),
        ]);
    }
}