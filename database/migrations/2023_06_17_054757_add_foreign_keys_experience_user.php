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
        Schema::table('experience_user', function (Blueprint $table) {
            $table->foreign("detail_user_id", "fk_experience_user_to_detail_user")->references("id")->on("detail_user")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experience_user', function (Blueprint $table) {
            $table->dropForeign("fk_experience_user_to_detail_user");
        });
    }
};
