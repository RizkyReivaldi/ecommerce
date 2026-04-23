<?php


namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Starting database seeding...');

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->command->info('✅ Admin user created: admin@example.com');

      
        User::factory(10)->create(['role' => 'customer']);
        $this->command->info('✅ 10 customer users created');


        $this->call(CategorySeeder::class);



        $this->command->newLine();
        $this->command->info('🎉 Database seeding completed!');
        $this->command->info('📧 Admin login: admin@example.com / password');
    }
}
