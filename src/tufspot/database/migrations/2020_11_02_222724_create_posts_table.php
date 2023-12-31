<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->string('featured_image_path')->nullable();
            $table->longText('body')->nullable();
            $table->integer('is_public');
            $table->dateTime('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('公開日');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('update_user_id')->constrained('users', 'id')->onDelete('cascade');
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
