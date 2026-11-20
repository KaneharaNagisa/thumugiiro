<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('category', 20)->index();
            $table->string('status', 20)->default('planning')->index();
            $table->unsignedBigInteger('amount');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable()->index();
            $table->date('completed_at')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['client_id', 'status']);
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type', 20)->index();
            $table->string('category', 100)->nullable();
            $table->date('transaction_date')->index();
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('tax_amount')->default(0);
            $table->string('status', 20)->default('unpaid')->index();
            $table->date('paid_at')->nullable();
            $table->string('invoice_number')->nullable()->unique();
            $table->decimal('business_ratio', 5, 2)->default(100);
            $table->string('receipt_path')->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();

            $table->index(['type', 'transaction_date']);
            $table->index(['project_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('projects');
    }
};
