<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who made the comment
            $table->morphs('commentable'); // Polymorphic relationship (posts, etc.)
            $table->softDeletes(); // Optional: for soft deletes
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('comments');
    }
}
