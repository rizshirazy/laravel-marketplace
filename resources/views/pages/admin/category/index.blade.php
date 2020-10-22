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
				Manage store category
			</p>
		</div>
		<div class="dashboard-content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Add New Category</a>

							<div class="table-responsive">
								<table class="table table-hover scroll-horizontal-vertical w-100" id="resultTable">
									<thead>
										<tr>
											<td>ID</td>
											<td>Name</td>
											<td>Slug</td>
											<td>Icon</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@push('addon-scripts')
<script>
	const  dataTable = $('#resultTable').DataTable({
			processing: true,
			serverSide: true,
			ordering: true,
			ajax: {
				url: '{!! url()->current() !!}'
			},
			columns: [
				{	data: 'id', name: 'id' },
				{	data: 'name', name: 'name' },
				{	data: 'slug', name: 'slug' },
				{	data: 'image', name: 'image' },
				{	
					data: 'action', 
					name: 'action',
					orderable: false,
					searchable: false,
					width: '15%'
				},
			]
	})
</script>
@endpush