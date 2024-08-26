<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('notes_categories_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->constrained()->onDelete('cascade');
            $table->foreignId('note_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('notes_categories_mapping');
    }
};
