@extends('layouts.app')
@section('content')
<div class="container">
    <form class="form" method="post" action="{{route('links.update',$link->id)}}">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{auth()->id()}}">
        <label for="url">Url</label>
        <input type="text" name="url" class="form-control" value="{{$link->url}}">
        <label for="short_link">Short Link</label>
        <input type="text" name="short_link" class="form-control" value="{{$link->short_link}}">
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection