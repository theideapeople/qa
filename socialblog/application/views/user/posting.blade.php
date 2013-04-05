@layout('master')
@section('content')

	<h2>{{$posting->title}}</h2>
	<p>{{ $posting->body }}</p>
	<h4>{{'Write a comment:'}}<h4>
	@if(Auth::user())
    	<div class="span8">
    	{{ Form::open('posting') }}

        {{ Form::hidden('author', $posting->id) }}
        {{ Form::hidden('user',$posting->author)}}
       
        <p>{{Form::textarea('body', '',array('class'=> 'span3', 'placeholder'=> 'Write your comment here...' ))}}</p>
       
        <p>{{ Form::submit('Create') }}</p>

    	{{ Form::close() }}


        <h4>{{'Comments from members:'}}</h4>
        <br />

        <ul>
            @foreach ($comments as $comment)
            @if($posting->id == $comment->postid && $comment->status == '1') 
                
                <p>{{$comment->comment}}</p>
                <p><span class="badge badge-warning">Posted {{$comment->updated_at}}</span></p>
                <p>
                    <small>{{'Users that liked this answer: '}}</small>{{$comment ->like_it }}
                    <small>{{'Users that did not like this answer: '}}</small>{{$comment ->no_like }}
                    <ul>{{HTML::link_to_route('rating','Click here if you want to vote',array($comment->id))}}</ul>
                </p>
                <br />
                <br />
            
            @endif
            
            @endforeach
        </ul>
        </div>
    @else
        <li>{{HTML::link('login','To comment - Log in First!')}}</li>
    @endif        

@endsection
