@layout('master')
@section('content')

	<h2> Rate this answer</h2>
	<div class="span8">
		<div class="well">
			<h5>{{$rates->comment}}</h5>
			{{Form::open('rating')}}

			{{Form::hidden('commid', $rates->id) }}
			{{Form::hidden('likes',$rates->like_it)}}	
			<p>{{ HTML::decode(Form::button('<i class="icon-thumbs-up"></i> Vote UP', array('class'=>'btn btn-success'))) }}</p>
			{{HTML::link_to_route('ratingdwn','Vote Down', array($rates->id))}}
			{{Form::close()}}

		</div>
	</div>
@endsection


