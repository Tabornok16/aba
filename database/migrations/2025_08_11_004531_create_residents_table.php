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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('address');
            $table->string('contact_number')->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('occupation')->nullable();
            $table->string('civil_status');
            $table->string('nationality')->default('Filipino');
            $table->string('identification_type')->nullable(); // Type of ID provided
            $table->string('identification_number')->nullable(); // ID number
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('remarks')->nullable(); // For staff comments/notes
            $table->foreignId('validated_by')->nullable()->constrained('users');
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes for data retention
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
