<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_books', function (Blueprint $table) {
            $table->id('id_book');
            $table->boolean('is_active')->nullable(false)->default(1);
            $table->string('user_in')->nullable(false);
            $table->dateTime('date_in')->nullable(false)->default(Carbon::now('Asia/Jakarta'));
            $table->string('user_up')->nullable();
            $table->dateTime('date_up')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('isbn');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('category');
            $table->boolean('is_available')->default(1);
            $table->boolean('is_borrowed')->default(0);
            $table->boolean('is_lost')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_books');
    }
};
