<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->foreignId('script_id');
            $table->foreignId('language_id')->default(1);
            $table->foreignId('binding_id');
            $table->foreignId('format_id');
            $table->foreignId('publisher_id');

            $table->string('title', 256);
            $table->integer('pages');
            $table->integer('publishYear');
            $table->string('ISBN', 20);
            $table->integer('quantity');
            $table->integer('rentedBooks')->default(0);
            $table->integer('reservedBooks')->default(0);
            $table->string('summary', 4128);
            $table->timestamps();

            $table->foreign('script_id')
                ->references('id')
                ->on('scripts');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages');

            $table->foreign('binding_id')
                ->references('id')
                ->on('bindings');

            $table->foreign('format_id')
                ->references('id')
                ->on('formats');

            $table->foreign('publisher_id')
                ->references('id')
                ->on('publishers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
