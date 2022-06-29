<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountsToSiteStats extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_stats', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->bigInteger('article_count')->default(0);
            $table->bigInteger('blog_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_stats', function (Blueprint $table) {
            $table->dropColumn('article_count');
            $table->dropColumn('blog_count');
            $table->string('type');
        });
    }
}
