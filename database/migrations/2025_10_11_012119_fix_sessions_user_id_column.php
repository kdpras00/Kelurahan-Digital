<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Modify the user_id column to ensure it's properly set as a UUID column
            $table->uuid('user_id')->nullable()->change();

            // Check if the foreign key constraint already exists
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'sessions'
                AND COLUMN_NAME = 'user_id'
                AND REFERENCED_TABLE_NAME = 'users'
            ");

            // Only add the foreign key constraint if it doesn't already exist
            if (empty($foreignKeys)) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Check if the foreign key constraint exists
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'sessions'
                AND COLUMN_NAME = 'user_id'
                AND REFERENCED_TABLE_NAME = 'users'
            ");

            // Drop the foreign key constraint if it exists
            foreach ($foreignKeys as $foreignKey) {
                $table->dropForeign($foreignKey->CONSTRAINT_NAME);
            }

            // Revert to the original column type (this might not be exactly right, but it's for rollback)
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
};
