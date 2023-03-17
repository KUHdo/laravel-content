<?php

namespace KUHdo\Content\Tests\Fixtures;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentablesTable extends Migration
{
    /**
     * Creates contentable table for tests.
     */
    public function up()
    {
        Schema::create('contentables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Drops contentable table for tests.
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
