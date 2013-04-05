@layout('master')
@section('content')

	<h2> Are you rally going to do it? </h2>

	{{Form::open('ratingdwn')}}

			{{Form::hidden('commid', $rates->id) }}
			{{Form::hidden('likes',$rates->no_like)}}
			{{Form::label('label','Are you sure?');}}	
			{{ HTML::decode(Form::button('<i class="icon-thumbs-down"></i> Vote Down', array('class'=>'btn btn-warning'))) }}

	{{Form::close()}}
@endsection