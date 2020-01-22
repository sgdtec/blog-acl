<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            /** Relacinamento with User */
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            /** Relacionamento with Posts */
            $table->integer('post_id')->unsigned();
            $table->foreing('post_id')->references('id')->on('posts')->onDelete('cascade');
            /** Relacioamento with Comments */
            $table->integer('comment_id')->unsigned();
            $table->foreing('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->text('description');
            $table->date('date');
            $table->time('hour');
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
        Schema::dropIfExists('comment_answers');
    }
}
