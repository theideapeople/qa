@layout('master')
@section('content')
<div class="span8">
    <h2>Creating new post</h2>
    <hr />
    {{ Form::open('posts') }}
       
       
        {{ Form::label('title', 'Title') }}

        {{Form::text('title', '',array('class'=> 'span3', 'placeholder'=> 'Write title' ))}}
        
        {{ Form::label('body', 'Body') }}
       
        {{Form::textarea('body', '',array('class'=> 'span3', 'placeholder'=> 'Write your question here...' ))}}
       
        <p>{{ Form::submit('Create') }}</p>
    {{ Form::close() }}
</div>
@endsection