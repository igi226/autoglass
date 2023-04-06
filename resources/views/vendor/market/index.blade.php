@extends('vendor.layouts.app')

@section('title', 'Market Place')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content-breadcrumb"> <span>Vendor</span><span>Market Place</span>
                        <div class="main-content-title ml-auto mb-0">Market Place</div>
                    </div>
                    <div class="main-content-header container p-4 bg-white">
                        <div>
                            <h6 class="main-content-title tx-18 mg-b-5 mg-t-5">Advance Search</h6>
                        </div>
                        <form class="advance_search_form" method="GET">
                            @csrf()
                            <input type="hidden" name="advance" value="1">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Year</label>

                                <input type="text" class="form-control" name="year" id="year"
                                    value="{{ request()->input('year') }}">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Make</label>

                                <input type="text" class="form-control" name="make" id="make"
                                    value="{{ request()->input('make') }}">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Model</label>

                                <select class="form-control" name="model" id="model">
                                    <option value="">Select model</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="FD,DD" {{ request()->input('type') == 'FD,DD' ? 'selected' : '' }}>Door
                                        glass</option>
                                    <option value="FW,DW" {{ request()->input('type') == 'FW,DW' ? 'selected' : '' }}>
                                        Windshield</option>
                                    <option value="FB,DB" {{ request()->input('type') == 'FB,DB' ? 'selected' : '' }}>Back
                                        glass</option>
                                    <option value="FQ,DQ" {{ request()->input('type') == 'FQ,DQ' ? 'selected' : '' }}>
                                        Quarter glass</option>
                                    <option value="FV,DV" {{ request()->input('type') == 'FV,DV' ? 'selected' : '' }}>Vent
                                        glass</option>
                                    <option value="FY,DY" {{ request()->input('type') == 'FY,DY' ? 'selected' : '' }}>
                                        Slider glass</option>
                                    <option value="Sunroof" {{ request()->input('type') == 'Sunroof' ? 'selected' : '' }}>
                                        Sunroof glass</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Part Number</label>

                                <input type="text" class="form-control" name="part_number"
                                    value="{{ request()->input('part_number') }}">
                            </div>
                            <div class="form-group">
                                {{-- <label class="main-content-label tx-11 tx-medium tx-gray-600 d-hidden">
                                    Search
                                </label> --}}
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="main-content-body">
                        <div class="d-flex flex-column flex-md-row-reverse justify-content-between">
                            <div class="col-md-12 p-0 pr-md-3">
                                <div class="row row-sm row-cards row-deck">

                                    @foreach ($products as $product)
                                        <div class="col-md-6">
                                            <div class="card mg-b-20 card-aside">
                                                <div class="card-body d-flex flex-column">
                                                    <h4>
                                                        <a href="#" class="text-dark tx-15">
                                                            {{ $product->part_number }}
                                                        </a>
                                                    </h4>
                                                    <div class="text-muted min-h-84">
                                                        <span class="text-dark">Year -
                                                            {{ $product->year }}</span> &nbsp;
                                                        <span class="text-dark">Manufactured by -
                                                            {{ $product->make }}
                                                        </span> &nbsp;
                                                        <span class="text-dark">Model -
                                                            {{ $product->model }}
                                                        </span>
                                                        <br>
                                                        {{ $product->description }}
                                                        <h6 class="text-primary fw-bold my-2"
                                                            data-latitude="{{ $product->latitude }}"
                                                            data-longitude="{{ $product->longitude }}"></h6>
                                                    </div>
                                                    <div class="row py-2 align-items-center">
                                                        <h4 class="col-md-6 text-primary fw-light">
                                                            ${{ $product->commercial_price }}
                                                        </h4>
                                                        <div class="col-md-6 text-md-right">
                                                            <button
                                                                data-action="{{ route('vendor.order.request', ['id' => @$product->ven_pro_id]) }}"
                                                                class="btn btn-primary" data-target="#checkModal"
                                                                data-toggle="modal" type="button">
                                                                Check Availability
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- row -->

                        </div>
                        @include('components.admin.pagination', ['paginator' => $products])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.vendor.check')
    <script>
        console.log('succ')

        function success(pos) {
            let crd = pos.coords;
            let {
                latitude,
                longitude
            } = crd;

            let items = document.querySelectorAll('[data-latitude]');
            items.forEach((item) => {
                let lat1 = item.dataset.latitude;
                let lon1 = item.dataset.longitude;

                let distance = calcCrow(latitude, longitude, lat1 || 0, lon1 || 0)
                distance *= .62137119;
                item.innerHTML = `${distance.toFixed(2)} Miles Away`

            })
        }
        navigator.geolocation.getCurrentPosition(success);

        function calcCrow(lat1, lon1, lat2, lon2) {
            var R = 6371; // km
            var dLat = toRad(lat2 - lat1);
            var dLon = toRad(lon2 - lon1);
            var lat1 = toRad(lat1);
            var lat2 = toRad(lat2);

            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            return d;
        }

        // Converts numeric degrees to radians
        function toRad(Value) {
            return Value * Math.PI / 180;
        }

        function searchMarket() {
            alert('hhh');
        }
    </script>
@endsection()
