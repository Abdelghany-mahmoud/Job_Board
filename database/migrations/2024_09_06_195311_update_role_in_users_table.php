<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // You can only drop and recreate enum field with correct values
            $table->dropColumn('role'); // Drop the existing enum column

            // Recreate the enum column with the corrected value
            $table->enum('role', ['admin', 'job_seeker', 'employer'])->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes by dropping the new column and recreating the old one
            $table->dropColumn('role'); // Drop the modified enum column

        });
    }
};
