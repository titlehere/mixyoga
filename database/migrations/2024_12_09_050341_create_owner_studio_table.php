<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerStudioTable extends Migration
{
    public function up()
    {
        Schema::create('owner_studio', function (Blueprint $table) {
            $table->uuid('owner_uuid')->primary(); // UUID sebagai primary key
            $table->uuid('studio_uuid')->nullable(); // Relasi dengan studio
            $table->string('owner_nama');
            $table->string('owner_email')->unique();
            $table->string('owner_pass');
            $table->string('owner_telp')->nullable();
            $table->boolean('owner_status')->default(true);
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('owner_studio');
    }
}