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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livestock_id')->constrained('livestocks')->onDelete('cascade');
            $table->date('record_date');
            $table->string('record_type'); // vaccination, treatment, checkup, etc.
            $table->string('diagnosis')->nullable();
            $table->string('treatment')->nullable();
            $table->string('medication')->nullable();
            $table->string('dosage')->nullable();
            $table->string('administered_by')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable(); // for any documents or images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
