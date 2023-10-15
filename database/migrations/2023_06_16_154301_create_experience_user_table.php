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
        Schema::create('experience_user', function (Blueprint $table) {
            $table->id();
            // $table->integer("detail_user_id")->nullable();
            $table->foreignId("detail_user_id")->nullable()->index("fk_experience_user_to_detail_user");
            $table->string("experience")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_user');
    }
};
