@extends('layouts.app')

@section('content')
<div class="col-md-9 cpl-lg-9 col-sm-9 pull-left">

	<div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: white; padding: 10px;">
		<form method="post" action="{{ route('companies.update',[$company->id])}}">
			{{csrf_field()}}
			<input type="hidden" name="_method" value="put">
			<div class="form-group">
				<label for="company-name">Name <span class="required">*</span></label>
				<input type="text" name="name" id="company-name" spellcheck="false" class="form-control" value="{{ $company->name }}" placeholder="Enater company name" required>
			</div>
			<div class="form-group">
				<label for="company-content">Description <span class="required">*</span></label>
				<textarea name="description" id="company-content" spellcheck="false" class="form-control authorize-target text-left" value="{{ $company->name }}" placeholder="Enater description" style="resize: vertical;" rows="5" required>{{ $company->description }}</textarea>
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
			<li><a href="/companies/{{ $company->id }}">View Company</a></li>
			<li><a href="{{route('companies.index')}}">All Companies</a></li>
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