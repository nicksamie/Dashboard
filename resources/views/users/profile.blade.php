<h1>Profile Page</h1>
@foreach($info as $value)
	{{$value->id}}
	{{$value->firstname}}
	{{$value->lastname}}
	{{$value->email}}
	{{$value->id}}

@endforeach
