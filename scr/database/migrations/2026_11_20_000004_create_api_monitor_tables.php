<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->text('url');
            $table->string('method', 10)->default('GET');
            $table->unsignedSmallInteger('expected_status')->default(200);
            $table->unsignedSmallInteger('timeout_seconds')->default(10);
            $table->boolean('is_active')->default(true)->index();
            $table->string('last_status', 20)->nullable()->index();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();

            $table->index(['project_id', 'is_active']);
        });

        Schema::create('api_monitor_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('api_monitor_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->index();
            $table->unsignedSmallInteger('response_status')->nullable();
            $table->unsignedInteger('response_time_ms')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamp('checked_at')->index();
            $table->timestamps();

            $table->index(['api_monitor_id', 'checked_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_monitor_logs');
        Schema::dropIfExists('api_monitors');
    }
};
