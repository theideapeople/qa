@layout('master')
@section('content')
<h2> Welcome to our Blog Test</h2>
    @foreach ($posts -> results as $post)
        <div class="span8">
            <h3>{{ HTML::link_to_route('posting',$post->title,array($post->id)) }}</h3>
            <p>{{ $post->body }}</p>
            <span class="badge badge-warning">Posted {{$post->updated_at}}</span>
        </div>
         
    @endforeach
@endsection
@section('pagination')
        <div class="row">
            <div class="span8">
                {{ $posts -> links(); }}
             </div>
        </div>
@endsection


