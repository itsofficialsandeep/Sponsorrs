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
        Schema::table('table_customers', function (Blueprint $table) {
            $table->string("country", 60)->nullable()->after("name");
            $table->string("state", 60)->nullable()->after("name");
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string("id", 60)->nullable();

            // this will crete a foreign key on the table
            $table->string("group_id")->references("group_id")->on("table_name");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_customers', function (Blueprint $table) {
            //
        });
    }
};
