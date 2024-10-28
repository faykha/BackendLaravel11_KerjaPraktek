<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelLantaiTable extends Migration
{
    public function up()
    {
        Schema::create('tabel_lantai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lantai')->constrained('tabel_lantai')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tabel_lantai');
    }
}
