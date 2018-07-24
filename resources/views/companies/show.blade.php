@extends('layouts.app')

@section('content')
<div class="col-md-9 cpl-lg-9 col-sm-9 pull-left">
	<!-- the justified navigation menu is meant for single line per Multiple lines will require custom code not provided by Bootstrap. -->
	

	<div class="jumbotron">
		<h1>{{$company->name}}</h1>
		<p class="lead">{{ $company->description }}</p>
		<!-- <p> <a href="#" class="btn btn-lg btn-success" role="button">Get started today</a></p> -->
	</div>

	<div class="row" style="background-color: white; padding: 10px;">
		<a href="{{route('projects.create')}}" class="pull-right btn btn-default btn-sm">Add project</a>
		@foreach($company->projects as $project)
		<div class="col-lg-4">
			<h2>{{$project->name}}</h2>
			<p class="text-danger">{{ $project->description}}</p>
			<p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View Projects</a></p>
		</div>
		@endforeach
	</div>
</div>

<div class="col-sm-3 pull-right">
	<div class="sidebar-module">
		<h4>Actions</h4>
		<ol class="list-unstyled">
			<li><a href="/companies/{{$company->id}}/edit">Edit</a></li>
			<li><a href="/companies">My Companies</a></li>
			<li><a href="/companies/create">Create new Company</a></li>
			<li><a href="/projects/create/{{$company->id}}">Add Project</a></li>

			<br>

			<li><a href="#" onclick="var result = confirm('Are you sure you want to delete this Project?');
			if(result){
				event.preventDefault();
				document.getElementById('delete-form').submit();
			}">Delete</a>
			<form id="delete-form" action="{{route('companies.destroy',[$company->id])}}" method="POST" style="display: none;">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="delete">
				
			</form>
		</li>
			<li><a href="#">Add new member</a></li>
		</ol>
	</div>
	<div class="sidebar-module">
		<h4>Members</h4>
		<ol class="list-unstyled">
			<li> <a href="#">March 2014</a> </li>
		</ol>
	</div>
	
</div>
@endsection