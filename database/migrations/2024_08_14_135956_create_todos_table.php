<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->date('due_date');
            $table->integer('priority');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('todos');
    }
};
