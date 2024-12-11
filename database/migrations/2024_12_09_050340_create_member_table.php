<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->uuid('member_uuid')->primary(); // UUID sebagai primary key
            $table->string('member_nama');
            $table->string('member_email')->unique();
            $table->string('member_pass');
            $table->string('member_telp')->nullable();
            $table->boolean('member_status')->default(true);
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('member');
    }
}