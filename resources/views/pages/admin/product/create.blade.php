@extends('layouts.admin')

@section('title')
Store Admin - Product
@endsection

@section('content')
<div class="section-content section-dashboard-home"
		 data-aos="fade-up">
	<div class="container-fluid">
		<div class="dashboard-heading">
			<h2 class="dashboard-title">Product</h2>
			<p class="dashboard-subtitle">
				Create new product
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
							<form action="{{ route('admin.products.store') }}" method="POST"
										enctype="multipart/form-data">
								@csrf

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Name</label>
											<input type="text" name="name" class="form-control" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Price</label>
											<input type="number" name="price" class="form-control" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Category</label>
											<select name="category_id" class="form-control" required>
												<option value="">-- Choose Category --</option>
												@foreach ($categories as $item)
												<option value="{{ $item->id }}">{{ $item->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Product Owner</label>
											<select name="user_id" class="form-control" required>
												<option value="">-- Choose User --</option>
												@foreach ($users as $item)
												<option value="{{ $item->id }}">{{ $item->name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Description</label>
											<textarea name="description" id="editor"
																class="form-control"></textarea>
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

@push('addon-scripts')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor');
</script>
@endpush