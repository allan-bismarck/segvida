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

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('caminho');
            $table->integer('owner_id')->nullable();
            $table->string('owner_type');
            $table->timestamps();
        });

        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('endereco')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('cnpj')->unique()->nullable();
            $table->string('email');
            $table->text('descricao')->nullable();
            $table->json('horario_funcionamento')->nullable();
            $table->integer('logomarca')->nullable();
            $table->timestamps();
        });

        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('CRM')->unique()->nullable();
            $table->string('genero')->nullable();
            $table->integer('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cor')->nullable();
            $table->integer('icone')->nullable();
            $table->timestamps();
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('Nome');
            $table->date('data_nascimento')->nullable();
            $table->string('genero')->nullable();
            $table->string('endereco')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->unique();
            $table->string('rg')->unique()->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('user_name')->unique();
            $table->integer('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('clinic_specialty', function (Blueprint $table) {
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->primary(['clinic_id', 'specialty_id']);
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('motivo_consulta');
            $table->timestamp('hora_inicio');
            $table->timestamp('hora_fim')->nullable();
            $table->string('pagamento');
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->time('horario_chegada');
            $table->time('horario_saida')->nullable();
            $table->string('dia');
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('specialist_specialty', function (Blueprint $table) {
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->primary(['specialist_id', 'specialty_id']);
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
    }
};