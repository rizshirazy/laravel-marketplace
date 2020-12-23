@extends('layouts.dashboard')

@section('title')
Store Dashboard - Product
@endsection

@section('content')
<div class="section-content section-dashboard-home"
     data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Shirup Marzan</h2>
      <p class="dashboard-subtitle">
        Product Details
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

          <form action="{{ route('dashboard.products.update', $product->id)}}" method="POST"
                enctype="multipart/form-data">
            @csrf @method('PUT')
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
                             value="{{ $product->name }}" />
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
                             value="{{ $product->price }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="category_id">Category</label>
                      <select name="category_id" id="category_id" class="form-control">
                        <option value="" disabled>-- Choose Category --</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}"
                                {{ $item->id == $product->category_id ? 'selected' : '' }}>
                          {{ $item->name }}
                        </option>
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
                                class="form-control">{!! $product->description !!}
                      </textarea>
                    </div>
                  </div>
                  <div class="col">
                    <button type="submit"
                            class="btn btn-success btn-block px-5">
                      Update Product
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                @foreach ($product->galleries as $gallery)
                <div class="col-md-4">
                  <div class="gallery-container">
                    <img src="{{ Storage::url($gallery->image ?? '')}}"
                         alt=""
                         class="w-100" />
                    <a class="delete-gallery" href="{{ route('dashboard.gallery.remove', $gallery->id) }}">
                      <img src="/images/icon-delete.svg" alt="" />
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col mt-3">
                  <form action="{{ route('dashboard.gallery.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="file"
                           id="image"
                           name="image"
                           style="display: none;"
                           onchange="form.submit()" />
                    <button type="button" class="btn btn-secondary btn-block"
                            onclick="thisFileUpload();">
                      Add Photo
                    </button>
                  </form>
                </div>
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
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
  function thisFileUpload() {
    document.getElementById("image").click();
  }

  CKEDITOR.replace("description");
</script>
@endpush