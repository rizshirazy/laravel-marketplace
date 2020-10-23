@extends('layouts.admin')

@section('title')
Store Admin - User
@endsection

@section('content')
<div class="section-content section-dashboard-home"
		 data-aos="fade-up">
	<div class="container-fluid">
		<div class="dashboard-heading">
			<h2 class="dashboard-title">User</h2>
			<p class="dashboard-subtitle">
				Update user
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
							<form action="{{ route('admin.users.update', $user->id) }}" method="POST"
										enctype="multipart/form-data">

								@method('PUT')
								@csrf

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Name</label>
											<input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" class="form-control">
											<small>If empty, not update the password.</small>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Roles</label>
											<select name="roles" class="form-control" required>
												<option value="">-- Choose Roles --</option>
												<option value="ADMIN" {{ $user->roles == "ADMIN" ? 'selected' : ''}}>Admin</option>
												<option value="USER" {{ $user->roles == "USER" ? 'selected' : '' }}>User</option>
											</select>
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