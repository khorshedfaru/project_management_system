@extends('layouts.app')

@section('content')
<div class="col-md-9 cpl-lg-9 col-sm-9 pull-left">
	<!-- the justified navigation menu is meant for single line per Multiple lines will require custom code not provided by Bootstrap. -->
	

	<div class="jumbotron">
		<h1>{{$project->name}}</h1>
		<p class="lead">{{ $project->description }}</p>
		<!-- <p> <a href="#" class="btn btn-lg btn-success" role="button">Get started today</a></p> -->
	</div>

	<div class="row" style="background-color: white; padding: 10px;">
		{{-- <a href="{{route('projects.create')}}" class="pull-right btn btn-default btn-sm">Add project</a> --}}
		<br>
		<br>
	<div class="row container-fluid">
		@include('partials.comments')
		<form method="post" action="{{ route('comments.store')}}">
			{{csrf_field()}}
			<input type="hidden" name="commentable_type" value="App\Project">
			<input type="hidden" name="commentable_id" value="{{$project->id}}">

			<div class="form-group">
				<label for="comment-content">Comment<span class="required">*</span></label>
				<textarea name="body" id="comment-content" spellcheck="false" class="form-control authorize-target text-left" placeholder="Enater comment" style="resize: vertical;" rows="3" required></textarea>
			</div>
			<div class="form-group">
				<label for="comment-content">Proof of work done (Url/Photos) <span class="required">*</span></label>
				<textarea name="url" id="comment-content" spellcheck="false" class="form-control authorize-target text-left" placeholder="Enater description" style="resize: vertical;" rows="2" required></textarea>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Submit">
			</div>
		</form>
	</div>
		
	</div>
</div>

<div class="col-sm-3 pull-right">
	<div class="sidebar-module">
		<h4>Actions</h4>
		<ol class="list-unstyled">
			<li><a href="/projects/{{$project->id}}/edit">Edit</a></li>
			<li><a href="/projects">My Projects</a></li>
			<li><a href="/projects/create">Create new Project</a></li>

			<br>
			@if($project->user_id == Auth::user()->id)
			<li><a href="#" onclick="var result = confirm('Are you sure you want to delete this Project?');
			if(result){
				event.preventDefault();
				document.getElementById('delete-form').submit();
			}">Delete</a>
			<form id="delete-form" action="{{route('projects.destroy',[$project->id])}}" method="POST" style="display: none;">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="delete">
				
			</form>
		</li> 
		@endif
		</ol>
		<h4>Add members</h4>
	<div class="row">
  
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
<form id="add-user" action="{{route('projects.adduser',[$project->id])}}" method="POST">
	{{csrf_field()}}
    <div class="input-group">
      <input type="hidden" class="form-control" value="{{$project->id}}" name="project_id">
      <input type="text" class="form-control" name="email" placeholder="E-mail">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Add!</button>
      </span>
    </div><!-- /input-group -->
</form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
	<h4>Team Members</h4>
		<ol class="list-unstyled">
			@foreach($project->users as $user)
			<li><a href="#">{{$user->name}}</a></li>
			@endforeach
			
		</ol>
</div>
@endsection