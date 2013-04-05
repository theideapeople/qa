<?php

class Home_Controller extends Base_Controller {

public $restful = true;

	public function get_index()
	{
		$title = "Home";
		$posts = Post::with('user')->order_by('updated_at', 'desc')->paginate(5);
		return View::make('home.index')
			->with('title',$title)
			->with('posts', $posts);
	}
    
}