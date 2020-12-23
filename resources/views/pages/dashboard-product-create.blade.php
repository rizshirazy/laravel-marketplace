@extends('layouts.dashboard')

@section('title')
Store Dashboard - Product
@endsection

@section('content')
<div class="section-content section-dashboard-home"
     data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Add New Product</h2>
      <p class="dashboard-subtitle">
        Create your own product
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li> {{ $error }} </li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Product Name</label>
                      <input type="text"
                             class="form-control"
                             id="name"
                             aria-describedby="name"
                             name="name"
                             value="" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="number"
                             class="form-control"
                             id="price"
                             aria-describedby="price"
                             name="price"
                             value="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="category_id">Category</label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="" disabled>-- Choose Category --</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description"
                                id="description"
                                cols="30"
                                rows="4"
                                class="form-control">
                      </textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file"
                             multiple
                             class="form-control pt-1"
                             id="image"
                             aria-describedby="image"
                             name="image" />
                      <small class="text-muted">
                        Kamu dapat memilih lebih dari satu file
                      </small>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="text-right">
                      <button type="submit"
                              class="btn btn-success px-5">
                        Save Now
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-scripts')
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace("description");
</script>
@endpush