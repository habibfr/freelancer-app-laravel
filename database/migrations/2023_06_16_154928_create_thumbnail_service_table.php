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
        Schema::create('thumbnail_service', function (Blueprint $table) {
            $table->id();
            // $table->integer("service_id")->nullable();
            $table->foreignId("service_id")->nullable()->index("fk_thumbnail_service_to_service");
            $table->longText("thumbnail");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thumbnail_service');
    }
};
