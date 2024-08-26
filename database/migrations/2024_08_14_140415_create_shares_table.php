<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('todo_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('shares');
    }
};
