<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\PerformanceIndicator;
use App\Models\PerformanceMeasurement;
use App\Models\StrategicPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ESakipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@esakip.gov.id',
            'password' => Hash::make('password'),
            'role' => 'system_admin',
            'email_verified_at' => now(),
        ]);

        // Create sample organizations
        $districtGov = Organization::create([
            'name' => 'Pemerintah Kabupaten Bandung',
            'code' => 'PEMKAB-BDG',
            'type' => 'district_government',
            'description' => 'Pemerintah Kabupaten Bandung adalah pemerintah daerah yang menyelenggarakan urusan pemerintahan di wilayah Kabupaten Bandung.',
            'status' => 'active',
        ]);

        $dinasEducation = Organization::create([
            'name' => 'Dinas Pendidikan Kabupaten Bandung',
            'code' => 'DISDIK-BDG',
            'type' => 'regional_apparatus',
            'description' => 'Dinas Pendidikan bertanggung jawab dalam penyelenggaraan pendidikan di Kabupaten Bandung.',
            'status' => 'active',
        ]);

        $dinasHealth = Organization::create([
            'name' => 'Dinas Kesehatan Kabupaten Bandung',
            'code' => 'DINKES-BDG',
            'type' => 'regional_apparatus',
            'description' => 'Dinas Kesehatan bertanggung jawab dalam penyelenggaraan kesehatan masyarakat di Kabupaten Bandung.',
            'status' => 'active',
        ]);

        // Create users for organizations
        $regionalOfficial = User::create([
            'name' => 'Kepala Dinas Pendidikan',
            'email' => 'kadisdik@esakip.gov.id',
            'password' => Hash::make('password'),
            'role' => 'regional_official',
            'organization_id' => $dinasEducation->id,
            'email_verified_at' => now(),
        ]);

        $regionalStaff = User::create([
            'name' => 'Staff Perencanaan',
            'email' => 'staff.perencanaan@esakip.gov.id',
            'password' => Hash::make('password'),
            'role' => 'regional_staff',
            'organization_id' => $dinasEducation->id,
            'email_verified_at' => now(),
        ]);

        $evaluator = User::create([
            'name' => 'Evaluator Internal',
            'email' => 'evaluator@esakip.gov.id',
            'password' => Hash::make('password'),
            'role' => 'evaluator',
            'organization_id' => $districtGov->id,
            'email_verified_at' => now(),
        ]);

        // Create strategic plans
        $renstraEducation = StrategicPlan::create([
            'organization_id' => $dinasEducation->id,
            'name' => 'Rencana Strategis Dinas Pendidikan 2024-2028',
            'type' => 'renstra',
            'start_year' => 2024,
            'end_year' => 2028,
            'description' => 'Rencana strategis untuk meningkatkan kualitas pendidikan di Kabupaten Bandung.',
            'objectives' => [
                'Meningkatkan akses dan pemerataan pendidikan berkualitas',
                'Meningkatkan mutu dan relevansi pendidikan',
                'Memperkuat tata kelola pendidikan yang efektif dan efisien',
                'Mengembangkan SDM pendidik dan tenaga kependidikan yang profesional',
            ],
            'status' => 'active',
        ]);

        $rpjmdDistrict = StrategicPlan::create([
            'organization_id' => $districtGov->id,
            'name' => 'RPJMD Kabupaten Bandung 2024-2028',
            'type' => 'rpjmd',
            'start_year' => 2024,
            'end_year' => 2028,
            'description' => 'Rencana Pembangunan Jangka Menengah Daerah Kabupaten Bandung.',
            'objectives' => [
                'Mewujudkan pembangunan ekonomi yang berkelanjutan',
                'Meningkatkan kualitas sumber daya manusia',
                'Memperkuat infrastruktur dan konektivitas',
                'Mengoptimalkan tata kelola pemerintahan yang baik',
            ],
            'status' => 'active',
        ]);

        // Create performance indicators
        $kpi1 = PerformanceIndicator::create([
            'strategic_plan_id' => $renstraEducation->id,
            'name' => 'Angka Partisipasi Murni (APM) Pendidikan Dasar',
            'code' => 'KPI-EDU-001',
            'definition' => 'Persentase anak usia sekolah yang bersekolah sesuai dengan jenjang pendidikan yang semestinya.',
            'unit' => '%',
            'target_value' => 95.00,
            'type' => 'outcome',
            'measurement_frequency' => 'yearly',
        ]);

        $kpi2 = PerformanceIndicator::create([
            'strategic_plan_id' => $renstraEducation->id,
            'name' => 'Jumlah Sekolah Terakreditasi A',
            'code' => 'KPI-EDU-002',
            'definition' => 'Jumlah sekolah yang memperoleh akreditasi A dari Badan Akreditasi Nasional.',
            'unit' => 'sekolah',
            'target_value' => 150.00,
            'type' => 'output',
            'measurement_frequency' => 'yearly',
        ]);

        $kpi3 = PerformanceIndicator::create([
            'strategic_plan_id' => $renstraEducation->id,
            'name' => 'Tingkat Kepuasan Layanan Pendidikan',
            'code' => 'KPI-EDU-003',
            'definition' => 'Tingkat kepuasan masyarakat terhadap layanan pendidikan yang diselenggarakan.',
            'unit' => '%',
            'target_value' => 85.00,
            'type' => 'outcome',
            'measurement_frequency' => 'quarterly',
        ]);

        // Create performance measurements for the past 6 months
        $months = [
            '2024-06', '2024-07', '2024-08', '2024-09', '2024-10', '2024-11'
        ];

        foreach ($months as $month) {
            // APM measurements
            PerformanceMeasurement::create([
                'performance_indicator_id' => $kpi1->id,
                'actual_value' => random_int(90, 97),
                'target_value' => 95.00,
                'achievement_percentage' => random_int(90, 102),
                'measurement_date' => $month . '-01',
                'notes' => 'Data berdasarkan laporan bulanan sekolah-sekolah di Kabupaten Bandung.',
                'created_by' => $regionalStaff->id,
            ]);

            // School accreditation measurements
            PerformanceMeasurement::create([
                'performance_indicator_id' => $kpi2->id,
                'actual_value' => random_int(130, 155),
                'target_value' => 150.00,
                'achievement_percentage' => random_int(85, 105),
                'measurement_date' => $month . '-01',
                'notes' => 'Data akreditasi sekolah dari BAN-SM.',
                'created_by' => $regionalStaff->id,
            ]);

            // Satisfaction measurements
            PerformanceMeasurement::create([
                'performance_indicator_id' => $kpi3->id,
                'actual_value' => random_int(82, 90),
                'target_value' => 85.00,
                'achievement_percentage' => random_int(95, 106),
                'measurement_date' => $month . '-01',
                'notes' => 'Hasil survey kepuasan masyarakat terhadap layanan pendidikan.',
                'created_by' => $regionalStaff->id,
            ]);
        }

        // Create additional organizations using factory
        Organization::factory(10)->active()->create();
        
        // Create additional strategic plans
        StrategicPlan::factory(15)->active()->create();
        
        // Create additional performance indicators
        PerformanceIndicator::factory(30)->create();
        
        // Create additional performance measurements
        PerformanceMeasurement::factory(100)->create();
    }
}