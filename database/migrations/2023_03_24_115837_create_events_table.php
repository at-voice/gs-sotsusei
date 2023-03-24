<?php
// イベント管理のテーブル

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_table', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time')->nullable();
            $table->string('location')->nullable();
            $table->string('event_url')->nullable();
            $table->string('organizer_name')->nullable();
            $table->decimal('price', 8, 2); //全体8桁のうち小数点以下2桁までの数値を格納可
            $table->unsignedBigInteger('user_id');
            $table->dateTime('display_until'); //いつまで表示するか
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
