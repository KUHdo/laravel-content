<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use KUHdo\Content\Models\Translation;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contentable_id');
            $table->string('contentable_type');
            $table->foreignIdFor(Translation::class);
            $table->timestamps();
        });
    }

    /**
     * Revert the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
};
