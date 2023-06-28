<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('parent')->nullable();
            $table->string('thumbnail');
            $table->integer('publish')->default(1)->comment('0-unpublish, 1-publish');
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
        Schema::dropIfExists('categories');
	}
};
