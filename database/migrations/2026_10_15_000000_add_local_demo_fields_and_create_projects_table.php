<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tenant_id')->nullable();
            $table->boolean('can_use_database_assistant')->default(false);
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('name', 120);
            $table->string('status', 30)->default('planned');
            $table->timestamps();
            $table->index(['tenant_id', 'id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tenant_id', 'can_use_database_assistant']);
        });
    }
};
