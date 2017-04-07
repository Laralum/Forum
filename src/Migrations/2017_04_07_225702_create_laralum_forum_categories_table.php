<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaralumForumCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('laralum_forum_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('laralum_forum_categories');
	}
}
