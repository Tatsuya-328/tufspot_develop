<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gaigokai_members', function (Blueprint $table) {
            // $table->id();
            // 別サービスで存在する外語会ID(id)を外語会員テーブル（gaigokai_members）の主キーとする。
            // 外語会ID(id)は不変であるとし、CSVを再度読み込み等しても、中間テーブルや他への紐付きに影響ないとする。
            $table->string('id')->unique();
            // $table->foreignId('user_id')->constrained()->nullable();
            $table->string('phone_number')->unique();
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('gaigokai_member_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gaigokai_member_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreign('gaigokai_member_id')->references('id')->on('gaigokai_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaigokai_member');
        Schema::dropIfExists('gaigokai_member_user');
    }
};
