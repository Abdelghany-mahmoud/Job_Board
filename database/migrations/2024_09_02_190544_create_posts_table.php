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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('responsibilities');
            $table->string('requirements');
            $table->string('benefits');
            $table->string('location');
            $table->enum('work_type',['remote','on_site','hybrid']);
            $table->decimal('min_salary',10,2);
            $table->decimal('max_salary',10,2);
            $table->string('file')->nullable();
            $table->date('application_deadline');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
