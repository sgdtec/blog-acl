<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            /** Relacionamento with user */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
            /** Relacionamento with Category */
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            $table->string('title')->unique();
            $table->string('redline')->unique();
            $table->text('description');
            $table->date('date');
            $table->time('hour');
            $table->boolean('featured')->default(false);
            $table->enum('status', ['A', 'R'])->default('R')->comment('A-> Ativo Postado, R-> Rascunho not posted');
            $table->string('image');
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
        Schema::dropIfExists('posts');
    }
}
