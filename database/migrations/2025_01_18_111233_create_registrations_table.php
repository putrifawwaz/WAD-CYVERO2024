<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    public function up()
{
    if (!Schema::hasTable('registrations')) {
        Schema::create('registrations', function ($table) {
            $table->id();
            $table->foreignId('subevent_id')->constrained()->onDelete('cascade');
            $table->string('category')->nullable();
            $table->string('captain_name')->nullable();
            $table->string('captain_nim')->nullable();
            $table->string('captain_phone')->nullable();
            $table->string('team_name')->nullable();
            $table->string('class')->nullable();
            $table->string('ktm')->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }
}

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
