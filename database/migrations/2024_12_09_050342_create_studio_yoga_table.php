<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudioYogaTable extends Migration
{
    public function up()
    {
        Schema::create('studio_yoga', function (Blueprint $table) {
            $table->uuid('studio_uuid')->primary(); // UUID sebagai primary key
            $table->uuid('owner_uuid'); // Relasi ke owner
            $table->string('studio_nama');
            $table->string('studio_desk')->nullable();
            $table->string('studio_lokasi');
            $table->string('studio_logo')->nullable(); // Tambahkan kolom studio_logo
            $table->timestamps();

            $table->foreign('owner_uuid')->references('owner_uuid')->on('owner_studio')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('studio_yoga');
    }
}