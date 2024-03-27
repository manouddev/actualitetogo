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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('est_auteur')->default(0);
            $table->integer('author_id')->nullable();
            $table->string('username')->nullable();
            $table->string('slug')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('status')->default(0);
            $table->boolean('visible')->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('visitor_matricule_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
