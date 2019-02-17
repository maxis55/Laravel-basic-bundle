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
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('content');
            $table->text('short_desc');
            $table->string('cover')->nullable();
            //comment next line if there is only 1 type of posts in app
            $table->string('type');

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->text('additional_data')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')->onDelete('set null');

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
