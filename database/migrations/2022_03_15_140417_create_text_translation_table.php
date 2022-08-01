<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use KUHdo\Content\Models\Text;
use KUHdo\Content\Models\Translation;

return new class extends Migration {
    public function up()
    {
        Schema::create('text_translation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Translation::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Text::class)
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('text_translation');
    }
};
