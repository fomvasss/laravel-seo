<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            $table->json('tags')->nullable();
            $table->string('path')->nullable()->index();
            $table->string('group')->nullable();
            $table->timestamps();

            $table->morphs('model');
            // $table->nullableUuidMorphs('model');
        });
    }

    public function down()
    {
        Schema::dropIfExists('seos');
    }
};
