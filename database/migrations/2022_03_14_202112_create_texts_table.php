<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->text('value');
            $table->string('lang');
            $table->timestamps();

        });
    }

    /**
     * Revert the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('texts');
    }
};
