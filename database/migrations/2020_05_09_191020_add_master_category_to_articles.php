<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasterCategoryToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('master_category_id');
        });
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->foreignId('master_category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('master_category_id');
        });
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('master_category_id');
        });
    }
}
