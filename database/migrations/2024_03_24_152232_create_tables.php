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
        Schema::dropIfExists('clinic_specialty');
        Schema::dropIfExists('specialist_specialty');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('availabilities');
        Schema::dropIfExists('images');
        Schema::dropIfExists('clinics');
        Schema::dropIfExists('specialists');
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('users');

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->integer('owner_id')->nullable();
            $table->string('owner_type');
            $table->timestamps();
        });

        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('cnpj')->unique()->nullable();
            $table->string('email')->unique();
            $table->text('description')->nullable();
            $table->json('opening_hours')->nullable();
            $table->integer('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('CRM')->unique()->nullable();
            $table->string('sex')->nullable();
            $table->integer('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable();
            $table->integer('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->unique();
            $table->string('rg')->unique()->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('user_name')->unique();
            $table->integer('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('clinic_specialty', function (Blueprint $table) {
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->primary(['clinic_id', 'specialty_id']);
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('reason_for_consultation');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->string('payment');
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->time('arrival_time');
            $table->time('departure_time')->nullable();
            $table->string('day');
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('specialist_specialty', function (Blueprint $table) {
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->primary(['specialist_id', 'specialty_id']);
        });


        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_specialty');
        Schema::dropIfExists('specialist_specialty');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('availabilities');
        Schema::dropIfExists('images');
        Schema::dropIfExists('clinics');
        Schema::dropIfExists('specialists');
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('users');
    }
};