@extends('layouts.admin')

@section('title')
Store Admin - Category
@endsection

@section('content')
<div class="section-content section-dashboard-home"
	 data-aos="fade-up">
	<div class="container-fluid">
		<div class="dashboard-heading">
			<h2 class="dashboard-title">Category</h2>
			<p class="dashboard-subtitle">
				Update category
			</p>
		</div>
		<div class="dashboard-content">
			<div class="row">
				<div class="col-md-12">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li> {{ $error }} </li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="card">
						<div class="card-body">
							<form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
								  enctype="multipart/form-data">

								@method('PUT')
								@csrf

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Name</label>
											<input type="text" name="name" class="form-control"
												   value="{{ $category->name }}" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Icon</label>
											<input type="file" name="image" class="form-control"
												   accept="image/x-png,image/gif,image/jpeg,image/svg+xml">
										</div>
									</div>
								</div>

								<div class="row mt-3">
									<div class="col text-right">
										<button type="submit" class="btn btn-success px-5">Update</button>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection