<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('source')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->text('urlToImage')->nullable();
            $table->timestamp('publishedAt')->nullable();
            $table->text('content')->nullable();
            $table->text('typename');
            $table->timestamps();
        });


        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::dropIfExists('articles');
    }
}
