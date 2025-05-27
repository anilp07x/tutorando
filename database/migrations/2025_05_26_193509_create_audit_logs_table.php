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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id');
            $table->string('admin_user_name');
            $table->string('action'); // approve, reject, delete, etc.
            $table->string('resource_type'); // projeto, publicacao, user, etc.
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->string('resource_title')->nullable();
            $table->integer('affected_count')->default(1);
            $table->json('metadata')->nullable(); // Additional data about the action
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('admin_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['admin_user_id', 'created_at']);
            $table->index(['resource_type', 'resource_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
