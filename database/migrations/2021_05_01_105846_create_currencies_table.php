<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string("symbol");
            $table->integer("rate");
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('currencies');
    }
}
