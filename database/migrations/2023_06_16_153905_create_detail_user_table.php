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
        Schema::create('detail_user', function (Blueprint $table) {
            $table->id();
            // $table->integer("users_id")->nullable();
            $table->foreignId("users_id")->nullable()->index("fk_detail_user_to_users");
            $table->longText("photo")->nullable();
            $table->string("role")->nullable();
            $table->string("contact_number")->nullable();
            $table->longText("biography")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_user');
    }
};
