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
        Schema::table('publicacaos', function (Blueprint $table) {
            $table->bigInteger('file_size')->nullable()->after('conteudo_url');
            $table->string('file_type')->nullable()->after('file_size');
            $table->string('original_filename')->nullable()->after('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicacaos', function (Blueprint $table) {
            $table->dropColumn(['file_size', 'file_type', 'original_filename']);
        });
    }
};
