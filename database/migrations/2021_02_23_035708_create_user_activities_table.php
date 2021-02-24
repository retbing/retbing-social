<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_pub_id')->unique();
            $table->unsignedBigInteger('following_count')->default(0);
            $table->unsignedBigInteger('follower_count')->default(0);
            $table->unsignedBigInteger('posts_count')->default(0);
            $table->timestamps();

            $table->foreign('user_pub_id')->references('id')->on('user_public_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}