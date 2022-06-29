<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_discussions', function (Blueprint $table) {
            $table->integer('discussion_id')->unsigned()->index();
            $table->integer('topic_id')->unsigned()->index();
//            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade');
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
        Schema::dropIfExists('topic_discussions');
    }
}
