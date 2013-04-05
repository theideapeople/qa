@layout('master')
@section('content')
<div class="row-fluid">
	<div class="span8 well">
		<h1>Welcome to your profile page: {{ucwords(Auth::user()->first)}}</h1>
		<br />
		<br />
		<h4>Notifications:</h4>
	
		 @foreach ($comments as $comment)
		 	@if(Auth::user()->id == $comment->authorid && $comment->status=='0')
		 		{{Form::open('profile')}}
		 		<p>{{$comment->comment}}</p>
		 		{{ Form::hidden('commentid',$comment->id)}}
		 		{{ Form::hidden('accepts',$comment->status ='1')}}
		 		<p>{{ Form::submit('Accept Comment') }}</p>
		 		{{Form::close()}}
		 	@endif
		 @endforeach

		 <h4>Personal Information:</h4>
		 <p>{{'Name:'}}
		 {{Auth::user()->first}}</p>
		 <p>{{'Last Name:'}}
		 {{Auth::user()->last}}</p>
		 <p>{{'Username: '}}
		 {{Auth::user()->username}}</p>
		 <p>{{"Email: "}}
		 {{Auth::user()->email}}</p>
	</div>
</div>
@endsection