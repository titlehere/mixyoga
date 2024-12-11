<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudioUuidToOwnerStudioTable extends Migration
{
    public function up()
    {
        Schema::table('owner_studio', function (Blueprint $table) {
            // Pastikan hanya menambahkan foreign key jika kolom sudah ada
            if (!Schema::hasColumn('owner_studio', 'studio_uuid')) {
                $table->uuid('studio_uuid')->nullable()->after('owner_uuid');
            }
            
            $table->foreign('studio_uuid')
                  ->references('studio_uuid')
                  ->on('studio_yoga')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('owner_studio', function (Blueprint $table) {
            $table->dropForeign(['studio_uuid']);
        });
    }
}
