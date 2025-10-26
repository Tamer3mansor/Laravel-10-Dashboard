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
        Schema::create('class_translations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
    $table->string('locale')->index(); // ar / en
    $table->string('name');
    $table->unique(['class_id', 'locale']);
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
