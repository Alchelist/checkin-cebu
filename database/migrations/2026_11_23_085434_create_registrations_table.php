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
    Schema::create('registrations', function (Blueprint $table) {
        $table->id();

        $table->foreignId('event_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('checked_in_by')
            ->nullable()
            ->constrained('staff_users')
            ->nullOnDelete();

        $table->string('full_name');
        $table->string('email');
        $table->string('mobile', 11);

        $table->string('ticket_code')->unique();
        $table->string('qr_token', 64)->unique();

        $table->string('status')->default('confirmed');

        $table->unsignedInteger('waitlist_position')->nullable();

        $table->timestamp('registered_at')->nullable();
        $table->timestamp('checked_in_at')->nullable();
        $table->timestamp('cancelled_at')->nullable();

        $table->timestamps();

        $table->index(['event_id', 'email', 'status']);
        $table->index(['event_id', 'status']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
