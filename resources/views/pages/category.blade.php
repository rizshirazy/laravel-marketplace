@extends('layouts.app')

@section('title')
Store - Categories
@endsection

@section('content')
<div class="page-content page-categories">
  <section class="store-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>All Categories</h5>
        </div>
      </div>
      <div class="row">
        @forelse ($categories as $category)
        <div class="col-6 col-md-3 col-lg-2"
             data-aos="fade-up"
             data-aos-delay="{{ $loop->iteration * 100 }}">
          <a class="component-categories d-block" href="{{ route('categories.show', $category->slug) }}">
            <div class="categories-image">
              <img src="{{ Storage::url($category->image) }}"
                   alt="{{ $category->name }} Category"
                   class="w-100" />
            </div>
            <p class="categories-text">
              {{ $category->name }}
            </p>
          </a>
        </div>
        @empty
        <div class="col-12 text-center py-5"
             data-aos="fade-up"
             data-aos-delay="100">
          No Category Found.
        </div>
        @endforelse
      </div>
    </div>
  </section>
  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>All Products</h5>
        </div>
      </div>
      <div class="row">
        @forelse ($products as $product)
        <div class="col-6 col-md-4 col-lg-3"
             data-aos="fade-up"
             data-aos-delay="{{ $loop->iteration *  100 }}">
          <a class="component-products d-block" href="{{ route('details', $product->slug) }}">
            <div class="products-thumbnail">
              <div class="products-image"
                   style="background-image: url('{{ Storage::url($product->galleries->first()->image ) }}');                    ">
              </div>
            </div>
            <div class="products-text">
              {{ $product->name }}
            </div>
            <div class="products-price">
              Rp {{ number_format($product->price, 2) }}
            </div>
          </a>
        </div>
        @empty
        <div class="col-12 text-center py-5"
             data-aos="fade-up"
             data-aos-delay="100">
          No Product Found.
        </div>
        @endforelse
      </div>
      <div class="row">
        <div class="col-md-3 mt-4 mx-auto">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection