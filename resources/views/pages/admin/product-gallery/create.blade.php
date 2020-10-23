@extends('layouts.admin')

@section('title')
Store Admin - Product Gallery
@endsection

@section('content')
<div class="section-content section-dashboard-home"
	 data-aos="fade-up">
	<div class="container-fluid">
		<div class="dashboard-heading">
			<h2 class="dashboard-title">Product Gallery</h2>
			<p class="dashboard-subtitle">
				Create new product gallery
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
							<form action="{{ route('admin.galleries.store') }}" method="POST"
								  enctype="multipart/form-data">
								@csrf

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Product</label>
											<select name="product_id" class="form-control" required>
												<option value="">-- Choose Product --</option>
												@foreach ($products as $item)
												<option value="{{ $item->id }}">{{ $item->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Image</label>
											<input type="file" name="image" class="form-control" required>
										</div>
									</div>

								</div>


								<div class="row mt-3">
									<div class="col text-right">
										<button type="submit" class="btn btn-success px-5">Save</button>
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