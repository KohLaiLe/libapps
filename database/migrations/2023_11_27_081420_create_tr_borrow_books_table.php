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
        Schema::create('tr_borrow_books', function (Blueprint $table) {
            $table->id('id_borrow_book');
            $table->boolean('is_active')->nullable(false)->default(1);
            $table->string('user_in')->nullable(false);
            $table->dateTime('date_in')->nullable(false)->default(Carbon::now('Asia/Jakarta'));
            $table->string('user_up')->nullable();
            $table->dateTime('date_up')->nullable();
            $table->foreignId('id_user')->nullable(false);
            $table->foreignId('id_book')->nullable(false);
            $table->dateTime('borrow_date');
            $table->dateTime('due_date');
            $table->dateTime('return_date')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')
                ->onDelete('cascade');
            $table->foreign('id_book')->references('id_book')->on('ms_books')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_borrow_books');
    }
};
