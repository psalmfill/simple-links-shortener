@extends('layouts.app')
@section('content')
<div class="container">
   <table class="table">
       <thead>
           <th>id</th>
           <th>Short link</th>
           <th>Url</th>
           <th>Views</th>
           <th>Action</th>
       </thead>
       @forelse ($links as $link)
        <tr>
           <td>{{$link->id}}</td>
           <td><a href="{{route('links.show',$link->id)}}" target="_blank">{{$link->short_link}}</a> </td>
           <td><a href="{{$link->url}}" target="_blank">{{$link->url}}</a> </td>
            <td>{{$link->view}}</td>
           <td>
               <a href="{{route('links.edit',$link->id)}}" class="btn btn-primary">Edit</a>
                <form method="post" action="{{route('links.destroy',$link->id)}}" style="display: inline">
                    @csrf
                    @method("Delete")
                    <button class="btn btn-danger">Delete</button>
                </form>
           </td>
        </tr>
       @empty
           <tr>No Link Available</tr>
       @endforelse
   </table>
</div>
@endsection