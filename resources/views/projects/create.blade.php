@extends('layouts.app')

@section('content')
<div class="col-md-9 cpl-lg-9 col-sm-9 pull-left">

	<div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: white; padding: 10px;">
		<h1>Create a new Project</h1>
		<form method="post" action="{{ route('projects.store')}}">
			{{csrf_field()}}
			<div class="form-group">
				<label for="project-name">Name <i class="glyphicon glyphicon-asterisk text-danger"></i></label>
				<input type="text" name="name" id="project-name" spellcheck="false" class="form-control" placeholder="Enater project name" required>
			</div>
			@if($companies ==  null)
			<input type="hidden" name="company_id" value="{{$company_id}}" >
			@endif
			
			@if($companies != null)
			<div class="form-group">
				<label for="project-content">Select Company <i class="glyphicon glyphicon-asterisk text-danger"></i></label>
				
				<select name="company_id" class="form-control">
					<option hidden="" value="">Select Company</option>
					@foreach($companies as $company)
					<option value="$company->id">{{$company->name}}</option>
					@endforeach
				</select>
				
			</div>
			@endif
			<div class="form-group">
				<label for="project-content">Description <i class="glyphicon glyphicon-asterisk text-danger"></i></label>
				<textarea name="description" id="project-content" spellcheck="false" class="form-control authorize-target text-left" placeholder="Enater description" style="resize: vertical;" rows="5" required></textarea>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="update">
			</div>
		</form>
		
	</div>
</div>

<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
	<div class="sidebar-module">
		<h4>Actions</h4>
		<ol class="list-unstyled">
			<li><a href="/projects">My Projects</a></li>
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
