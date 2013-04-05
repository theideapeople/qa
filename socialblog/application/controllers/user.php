<?php

class User_Controller extends Base_Controller
{
	public $restful = true;

	// get_index will give us the log in page
	public function get_index()
	{
		$title = "Login";
		return View::make('user.index')
			->with('title',$title);

	}
	//post_index will post our log in data
	public function post_index()
	{
		$input = Input::all();
		$rules = array('email'=> 'required|email', 'password'=> 'required');
		$validator = Validator::make($input,$rules);
		if($validator->fails())
		{
			return Redirect::to('login')->with_errors($validator);
		} 
		else
		{
			$credentials = array('username' => $input['email'], 'password' => $input['password']);
			if(Auth::attempt($credentials))
			{
				return Redirect::to('profile');
			} 
			else
			{
				return Redirect::to('login');
			}
		}

	}

	//get register will give us our register page
	public function get_register()
	{
		$title = "Register";
			return View::make('user.register')
				->with('title',$title);

	}

	//post register will post the info from register form
	public function post_register()
	{
		$input = Input::all();

		$rules = array(
			'username'=>'required|unique:users',
			'first'=>'required',
			'last'=>'required',
			'email'=>'required|unique:users|email',
			'password'=>'required'

			);
		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return Redirect::to('register')->with_errors($validator);
		} 
		else
		{

			$password = $input['password'];
			$password = Hash::make($password);

			$user = new User;
			$user->username=$input['username'];
			$user->first=$input['first'];
			$user->last=$input['last'];
			$user->email=$input['email'];
			$user->password = $password;
			$user->save();

			return Redirect::to('login');

		}

	}
	//returns a view of my profile
	public function get_profile()
	{
		return View::make('user.profile')
			->with('comments', Comment::order_by('updated_at', 'desc')->get())
			->with('title','Profile');

	}

	public function post_profile()
	{
		$id = Input::get('commentid');
		Comment::update($id,array('status'=>Input::get('accepts')));
		return Redirect::to('profile');

	}

	// provides our posts view
	public function get_posts()
	{
		$title = "Post";
			return View::make('user.posts')
				->with('title',$title);

	}

	// post the new posts
	public function post_posts()
	{
		$input = Input::all();

		$rules = array(
			'title'=>'required|min:2|max:100',
			'body'=>'required|min:10'
			);
		$validator = Validator::make($input,$rules);

		if($validator->fails())
		{
			return Redirect::to('posts')->with_errors($validator);
		} 
		else
		{

			$post = new Post;
			$post->author= Auth::user()->id;
			$post->title=$input['title'];
			$post->body=$input['body'];
			$post->save();

			return Redirect::to('/');

		} 

	}

	// provides view for comments
	public function get_posting($id)
	{
		return View::make('user.posting')
		->with('title','Posting page')
		->with('comments', Comment::order_by('updated_at', 'desc')->get())
		->with('posting',Post::find($id));
	}

	//provides posts for new comments
	public function post_posting() 
	{
 
    $new_comment = array(
        'comment'     => Input::get('body'),
        'postid'   => Input::get('author'),
        'authorid'  => Input::get('user')
    );
    
    $rules = array(
        'postid'     => 'required',
        'comment'      => 'required|min:10'

    );
     
    $validation = Validator::make($new_comment, $rules);
    if ( $validation -> fails() )
    {
         
        return Redirect::to('/')->with_errors($validation);
    }
    // create the new post after passing validation
    else
    {
    $comment = new Comment($new_comment);
    $comment->save();
    // redirect to viewing all posts
    return Redirect::to('profile');
	}

	}

	public function get_rating($id)
	{
			$title = "Rating";
			return View::make('user.rating')
				->with('title',$title)
				->with('rates',Comment::find($id));
	}

	public function post_rating()
	{
		$id = Input::get('commid');
		$likeup =Input::get('likes');
		$likeup++;
		Comment::update($id,array('like_it'=>$likeup));
		return Redirect::to('/');
	}

	public function get_ratingdwn($id)
	{
			$title = "Rating";
			return View::make('user.ratingdwn')
				->with('title',$title)
				->with('rates',Comment::find($id));
	}

	public function post_ratingdwn()
	{
		$id = Input::get('commid');
		$likedwn =Input::get('likes');
		$likedwn++;
		Comment::update($id,array('no_like'=>$likedwn));
		return Redirect::to('/');
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('/');

	}
	
}