<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLinkIntoPostDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_details', function (Blueprint $table) {
            $table->string('title', 250)->change();
            $table->string('slug', 250)->change();
            $table->string('link', 250)->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_details', function (Blueprint $table) {
            $table->string('title', 50)->change();
            $table->string('slug', 50)->change();
            $table->dropColumn('link');
        });
    }
}
