<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_lendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_copy_id')->constrained('book_copies');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('deadline')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->double('fine')->default(0.00);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_lendings');
    }
}
