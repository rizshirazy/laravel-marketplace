@extends('layouts.app')

@section('title')
Store - Cart
@endsection


@section('content')
<div class="page-content page-cart">
	<section class="store-breadcrumbs"
					 data-aos="fade-down"
					 data-aos-delay="100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">
								Cart
							</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<section class="store-cart">
		<div class="container">
			<div class="row" data-aos="fade-up" data-aos-delay="100">
				<div class="col-12 table-responsive">
					<table class="table table-borderless table-cart"
								 aria-describedby="Cart">
						<thead>
							<tr>
								<th scope="col">Image</th>
								<th scope="col">Name &amp; Seller</th>
								<th scope="col">Price</th>
								<th scope="col">Menu</th>
							</tr>
						</thead>
						<tbody>
							@php
							$totalPrice = 0;
							@endphp

							@forelse ($cart as $item)
							<tr>
								<td style="width: 25%;">
									@if ($item->product->galleries)
									<img src="{{ Storage::url($item->product->galleries->first()->image) }}"
											 alt=""
											 class="cart-image" />
									@endif
								</td>
								<td style="width: 35%;">
									<div class="product-title">{{ $item->product->name }}</div>
									<div class="product-subtitle">
										by {{ $item->product->user->store_name ?? $item->product->user->name }}
									</div>
								</td>
								<td style="width: 35%;">
									<div class="product-title">{{ number_format($item->product->price, 2) }}</div>
									<div class="product-subtitle">IDR</div>
								</td>
								<td style="width: 20%;">
									<form action="{{ route('cart.delete', $item->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-remove-cart">
											Remove
										</button>
									</form>
								</td>
							</tr>

							@php
							$totalPrice += $item->product->price;
							@endphp
							@empty
							<tr>
								<td colspan="4" class="text-center">
									Your cart is empty
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
			<div class="row" data-aos="fade-up" data-aos-delay="150">
				<div class="col-12">
					<hr />
				</div>
				<div class="col-12">
					<h2 class="mb-4">Shipping Details</h2>
				</div>
			</div>
			<form action="" id="shippingForm">
				<div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
					<div class="col-md-6">
						<div class="form-group">
							<label for="address_one">Address 1</label>
							<input type="text"
										 class="form-control"
										 id="address_one"
										 name="address_one"
										 value="{{ $user->address_one }}" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="address_two">Address 2</label>
							<input type="text"
										 class="form-control"
										 id="address_two"
										 name="address_two"
										 value="{{ $user->address_two }}" />
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="province_id">Province</label>
							<select name="province_id" id="province_id" class="form-control" v-if="provinces" v-model="province_id">
								<option v-for="province in provinces"
												:value="province.id">@{{ province.name }}</option>
							</select>
							<select v-else class="form-control"></select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="regency_id">City</label>
							<select name="regency_id" id="regency_id" class="form-control" v-if="regencies" v-model="regency_id">
								<option v-for="regency in regencies"
												:value="regency.id">@{{ regency.name }}</option>
							</select>
							<select v-else class="form-control"></select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="zipcode">Postal Code</label>
							<input type="text"
										 class="form-control"
										 id="zipcode"
										 name="zipcode"
										 value="{{ $user->zipcode	}}" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="country">Country</label>
							<input type="text"
										 class="form-control"
										 id="country"
										 name="country"
										 value="Indonesia"
										 readonly />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone_number">Mobile</label>
							<input type="text"
										 class="form-control"
										 id="phone_number"
										 name="phone_number"
										 value="" />
						</div>
					</div>
				</div>
				<div class="row" data-aos="fade-up" data-aos-delay="300">
					<div class="col-12">
						<hr />
					</div>
					<div class="col-12">
						<h2>Payment Informations</h2>
					</div>
				</div>
				<div class="row" data-aos="fade-up" data-aos-delay="400">
					@php
					$taxes = $totalPrice * 0.1;
					$inscurance = $totalPrice * 0.05;
					$grandPrice = $totalPrice + $taxes + $inscurance;
					@endphp

					<div class="col-4 col-md-2">
						<div class="product-title">Rp {{ number_format($taxes, 2) }}</div>
						<div class="product-subtitle">Country Tax</div>
					</div>
					<div class="col-4 col-md-3">
						<div class="product-title">Rp {{ number_format($inscurance, 2) }}</div>
						<div class="product-subtitle">Product Insurance</div>
					</div>
					<div class="col-4 col-md-2">
						<div class="product-title">$580</div>
						<div class="product-subtitle">Ship to Jakarta</div>
					</div>
					<div class="col-4 col-md-2">
						<div class="product-title text-success">Rp {{ number_format($grandPrice, 2) }}</div>
						<div class="product-subtitle">Total</div>
					</div>
					<div class="col-8 col-md-3">
						<a href="/success.html"
							 class="btn btn-success mt-4 px-4 btn-block">
							Checkout Now
						</a>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection

@push('addon-scripts')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
	const shippingForm = new Vue({
			el: "#shippingForm",
			mounted() {
				AOS.init();
				this.getProvinces();
			},
			data: {
				provinces: null,
				province_id: '',
				regencies: null,
				regency_id: '',
			},
			methods: {
				getProvinces(){
					const self = this;
					axios.get('{{ route("api.provinces") }}')
					.then(res => {
						self.provinces = res.data
					});
				},
				getRegencies(){
					const self = this;
					axios.get('{{ route("api.regencies") }}' + '/' + self.province_id)
					.then(res => {
						self.regencies = res.data
					});
				}
			},
			watch: {
				province_id: function(val, oldVal) {
					const self = this;
					self.regency_id = null;
					this.getRegencies();
				}
			}
	});
</script>
@endpush