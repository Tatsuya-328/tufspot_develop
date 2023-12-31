<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->char('slug', 50)->unique();
            $table->char('name', 50);
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
    }
}
