<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_details', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('article')->nullable();
            $table->string('image_url')->nullable();
            $table->string('org_name')->nullable();
            $table->string('org_email')->nullable();
            $table->string('org_whatsapp')->nullable();
            $table->string('org_contact')->nullable();
            $table->string('footer_tweet')->nullable();
            $table->unique('org_email');
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
        Schema::dropIfExists('blog_details');
    }
}
