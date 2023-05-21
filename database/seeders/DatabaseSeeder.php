<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RevenueType;
use Illuminate\Database\Seeder;
use App\Models\AccountableFormType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        AccountableFormType::factory()->create(['name' => 'Official Receipt', 'number' => '51', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Certificate of Transfer of Large Cattle', 'number' => '52', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Certificate of Ownership of Large Cattle', 'number' => '53', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Marriage License Certificate', 'number' => '54', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Cash Ticket @ 5', 'number' => '55A', 'default_amount' => "5"]);
        AccountableFormType::factory()->create(['name' => 'Cash Ticket @ 10', 'number' => '55B', 'default_amount' => "10"]);
        AccountableFormType::factory()->create(['name' => 'Real Property Tax Receipt', 'number' => '56', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Community Tax Certificate (Individual)', 'number' => 'CTC-I', 'default_amount' => null]);
        AccountableFormType::factory()->create(['name' => 'Community Tax Certificate (Corporation)', 'number' => 'CTC-C', 'default_amount' => null]);
        
        // CTC Fees
        RevenueType::factory()->create(['column_display' => 'A', 'single_display' => 'Basic Community Tax', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'B', 'single_display' => 'Individual Additional Community Tax', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'C', 'single_display' => 'C', 'fund' => 100]);        
        RevenueType::factory()->create(['column_display' => 'C1', 'single_display' => 'C1', 'fund' => 100]);
        
        // RevenueType::factory()->create(['name' => 'Real Property Tax']);
        
        RevenueType::factory()->create(['column_display' => 'Stall Fees', 'single_display' => 'Stall Fees', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Special Permit', 'single_display' => 'Special Permit', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'Cash Ticket', 'single_display' => 'Cash Ticket', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Bagsakan', 'single_display' => 'CT Bagsakan', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Parking Fee', 'single_display' => 'CT Parking Fee', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Amusement Park', 'single_display' => 'CT Amusement Park', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Amusement Terminal', 'single_display' => 'CT Amusement Terminal', 'fund' => 100]);
        RevenueType::factory()->create(['column_display' => 'CT Amusement Big Bus AM', 'single_display' => 'CT Amusement Big Bus AM', 'fund' => 100]);




    }
}
