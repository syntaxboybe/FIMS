<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First add the column without unique constraint
        Schema::table('users', function (Blueprint $table) {
            // Check if the database supports the 'after' method
            $driver = DB::connection()->getDriverName();

            if ($driver === 'pgsql') {
                // PostgreSQL doesn't support 'after', so just add the column
                $table->string('username')->nullable();
            } else {
                // For MySQL and others that support 'after'
                $table->string('username')->nullable()->after('name');
            }

            // Make email nullable
            $table->string('email')->nullable()->change();
        });

        // Update existing users to have a username based on their email
        // Use different SQL based on the database driver
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL version
            DB::table('users')->whereNull('username')->update([
                'username' => DB::raw("SPLIT_PART(email, '@', 1)")
            ]);
        } elseif ($driver === 'mysql' || $driver === 'mariadb') {
            // MySQL/MariaDB version
            DB::table('users')->whereNull('username')->update([
                'username' => DB::raw("SUBSTRING_INDEX(email, '@', 1)")
            ]);
        } elseif ($driver === 'sqlite') {
            // SQLite version
            DB::table('users')->whereNull('username')->update([
                'username' => DB::raw("SUBSTR(email, 1, INSTR(email, '@') - 1)")
            ]);
        } else {
            // For other database systems, do it in PHP
            $users = DB::table('users')->whereNull('username')->get();
            foreach ($users as $user) {
                if ($user->email) {
                    $username = explode('@', $user->email)[0];
                    DB::table('users')->where('id', $user->id)->update(['username' => $username]);
                }
            }
        }

        // Make username required and unique
        Schema::table('users', function (Blueprint $table) {
            // First make it not nullable
            $table->string('username')->nullable(false)->change();

            // Then add unique constraint
            // Some database systems might have issues with changing multiple attributes at once
            $driver = DB::connection()->getDriverName();

            if ($driver === 'pgsql') {
                // For PostgreSQL, we need to add the unique constraint separately
                // Check if the constraint already exists
                $constraintExists = DB::select(
                    "SELECT COUNT(*) as count FROM pg_constraint WHERE conname = 'users_username_unique'"
                )[0]->count > 0;

                if (!$constraintExists) {
                    DB::statement('ALTER TABLE users ADD CONSTRAINT users_username_unique UNIQUE (username)');
                }
            } else {
                // For other databases, we can use the standard approach
                $table->unique('username');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');

            // Check if email is already unique before trying to make it unique
            $driver = DB::connection()->getDriverName();
            $hasUniqueEmail = false;

            // Check if email already has a unique constraint
            if ($driver === 'pgsql') {
                $hasUniqueEmail = DB::select(
                    "SELECT COUNT(*) as count FROM pg_constraint WHERE conname = 'users_email_unique'"
                )[0]->count > 0;
            } elseif ($driver === 'mysql' || $driver === 'mariadb') {
                $hasUniqueEmail = DB::select(
                    "SELECT COUNT(*) as count FROM information_schema.statistics
                     WHERE table_schema = DATABASE() AND table_name = 'users'
                     AND index_name = 'users_email_unique'"
                )[0]->count > 0;
            }

            // Only add unique constraint if it doesn't already exist
            if (!$hasUniqueEmail) {
                $table->string('email')->unique()->change();
            }
        });
    }
};
