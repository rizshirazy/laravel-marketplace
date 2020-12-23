@extends('layouts.dashboard')

@section('title')
Store Dashboard - Settings
@endsection

@section('content')
<div class="section-content section-dashboard-home"
     data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">My Account</h2>
      <p class="dashboard-subtitle">
        Update your current profile
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <form action="{{ route('dashboard.settings.update','dashboard.settings.account') }}" method="POST"
                enctype="multipart/form-data" id="addressForm">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Your Name</label>
                      <input type="text"
                             class="form-control"
                             id="name"
                             name="name"
                             value="{{ $user->name }}"
                             required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Your Email</label>
                      <input type="email"
                             class="form-control"
                             id="email"
                             aria-describedby="emailHelp"
                             name="email"
                             value="{{ $user->email }}"
                             required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_one">Address 1</label>
                      <input type="text"
                             class="form-control"
                             id="address_one"
                             aria-describedby=""
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
                             aria-describedby=""
                             name="address_two"
                             value="{{ $user->address_two }}" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="province_id">Province</label>
                      <select name="province_id" id="province_id" class="form-control" v-if="provinces"
                              v-model="province_id">
                        <option v-for="province in provinces"
                                :value="province.id">@{{ province.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="regency_id">City</label>
                      <select name="regency_id" id="regency_id" class="form-control" v-if="regencies"
                              v-model="regency_id">
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
                             value="{{ $user->zipcode }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <input type="text"
                             class="form-control"
                             id="country"
                             name="country"
                             value="Indonesia" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone_number">Mobile</label>
                      <input type="text"
                             class="form-control"
                             id="phone_number"
                             name="phone_number"
                             value="{{ $user->phone_number }}" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit"
                            class="btn btn-success px-5">
                      Save Now
                    </button>
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
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  const addressForm = new Vue({
			el: "#addressForm",
			mounted() {
				this.getProvinces();
				this.getRegencies();
			},
			data: {
				provinces: null,
				province_id: {{ $user->province_id }},
				regencies: null,
				regency_id: {{ $user->regency_id }},
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