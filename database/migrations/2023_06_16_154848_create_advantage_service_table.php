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
        Schema::create('advantage_service', function (Blueprint $table) {
            $table->id();
            // $table->integer("service_id")->nthullable();
            $table->foreignId("service_id")->nullable()->index("fk_advantage_service_to_service");
            $table->string("advantage");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advantage_service');
    }
};
