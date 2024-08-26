<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('todos_categories_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todo_id')->constrained()->onDelete('cascade');
            $table->foreignId('todo_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('todos_categories_mapping');
    }
};
