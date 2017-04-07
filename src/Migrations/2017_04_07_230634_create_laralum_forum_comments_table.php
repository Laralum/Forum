<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaralumForumCommentsTable extends Migration {

	public function up()
	{
		Schema::create('laralum_forum_comments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('thread_id');
			$table->text('comment');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('laralum_forum_comments');
	}
}
