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
        Schema::table('user_profile', function (Blueprint $table) {
            $table->foreign(['AVATAR_ID'], 'USER_PROFILE_DOCUMENT_STORAGE_FK')->references(['ID'])->on('document_storage')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['USER_ID'], 'user_profile_FK')->references(['ID'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->dropForeign('USER_PROFILE_DOCUMENT_STORAGE_FK');
            $table->dropForeign('user_profile_FK');
        });
    }
};
