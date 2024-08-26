<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('todo_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('attachments');
    }
};
