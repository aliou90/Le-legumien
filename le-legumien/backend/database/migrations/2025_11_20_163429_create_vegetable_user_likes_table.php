<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vegetable_user_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vegetable_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id','vegetable_id']); // éviter double like
        });
    }

    public function down(): void {
        Schema::dropIfExists('vegetable_user_likes');
    }
};
