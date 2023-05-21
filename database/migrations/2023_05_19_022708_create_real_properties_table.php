<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('real_properties', function (Blueprint $table) {
            $table->id();
            $table->integer('receipt_no_pf_no_25');
            $table->string('period_covered');
            $table->integer('classification');
            $table->string('tax_declaration_no');
            $table->string('barangay');
            $table->foreignId('accountable_form_id')->constrained(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_properties');
    }
};
