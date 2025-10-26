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
        
Schema::create('student_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
    $table->string('locale')->index();
    $table->string('name');
    $table->unique(['student_id', 'locale']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
