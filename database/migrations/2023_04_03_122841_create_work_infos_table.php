<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('content1_id');
            $table->unsignedBigInteger('content2_id')->nullable();
            $table->unsignedBigInteger('content3_id')->nullable();
            $table->unsignedBigInteger('content4_id')->nullable();
            $table->unsignedBigInteger('content5_id')->nullable();
            $table->unsignedBigInteger('content1_posted_by')->nullable();
            $table->unsignedBigInteger('content2_posted_by')->nullable();
            $table->unsignedBigInteger('content3_posted_by')->nullable();
            $table->unsignedBigInteger('content4_posted_by')->nullable();
            $table->unsignedBigInteger('content5_posted_by')->nullable();
            $table->string('title');
            $table->string('video_url')->nullable();
            $table->string('event_name')->nullable();
            $table->dateTime('event_date')->nullable();
            $table->string('event_location')->nullable();
            $table->string('event_info_url')->nullable();
            $table->string('event_type')->nullable();
            $table->string('event_organizer')->nullable();
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('content1_id')->references('id')->on('idea_words')->onDelete('cascade');
            $table->foreign('content2_id')->references('id')->on('idea_words')->onDelete('cascade');
            $table->foreign('content3_id')->references('id')->on('idea_words')->onDelete('cascade');
            $table->foreign('content4_id')->references('id')->on('idea_words')->onDelete('cascade');
            $table->foreign('content5_id')->references('id')->on('idea_words')->onDelete('cascade');
            $table->foreign('content1_posted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('content2_posted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('content3_posted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('content4_posted_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('content5_posted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_infos');
    }
}
