<?php

class Create_Comments_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function($table) {
            $table->increments('id');
            $table->text('comment');
            $table->integer('status');
            $table->integer('like_it');
            $table->integer('no_like');
            $table->integer('postid');
            $table->integer('authorid');
            $table->timestamps();
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}