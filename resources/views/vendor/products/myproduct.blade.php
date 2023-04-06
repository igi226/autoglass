@extends('vendor.layouts.app')
@section('title', $page['heading'])
@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-content-body d-flex flex-column">
                        <!-- breadcrumb -->
                        <div class="main-content-breadcrumb"> <span>Vendor</span> <span>Products</span>
                            <span>{{ $page['heading'] }}</span>
                            <div class="main-content-title mb-0 ml-auto">{{ $page['heading'] }}</div>
                        </div> <!-- /breadcrumb -->
                        @php
                            $error_products = get_error_products();
                        @endphp
                        @if ($error_products)
                            <div class="alert alert-solid-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="fa fa-exclamation-circle"></i>

                                Looks Like You've <b>{{ $error_products }}</b> Products without a Valid Retail and
                                Commercial Price! Please Update them with proper pricing to List Them into Market Place.
                            </div>
                        @endif()
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">{{ $page['heading'] }}</div>
                                <p class="mg-b-20">{{ $page['subheading'] }}</p>
                                <form method="GET" class="col-md-4 col-6 mb-3 p-0 float-right">
                                    <div class="input-group">
                                        <input class="form-control search-input" name="search" placeholder="Search" type="text"
                                        data-table="customers-list">
                                        {{-- <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">
                                                <span class="input-group-btn">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </button>
                                        </span> --}}
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table id="example-1" class="table table-striped table-bordered nowrap text-md-nowrap customers-list">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">
                                                    #
                                                </th>
                                                <th class="border-bottom-0">Year</th>
                                                <th class="border-bottom-0">Make</th>
                                                <th class="border-bottom-0">Model</th>
                                                <th class="border-bottom-0">Type</th>
                                                <th class="border-bottom-0">Part Number</th>
                                                <th class="border-bottom-0">Brand</th>
                                                <th class="border-bottom-0">Description</th>
                                                <th class="border-bottom-0">Quantity</th>
                                                <th class="border-bottom-0">Commercial Price</th>
                                                <th class="border-bottom-0">Retail Price</th>
                                                <th class="border-bottom-0">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = generate_count($products);
                                            @endphp
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        {{ $i++ }}
                                                    </td>
                                                    <td>{{ $product->product->year }}</td>
                                                    <td>{{ $product->product->make }}</td>
                                                    <td>{{ $product->product->model }}</td>
                                                    <td>{{ $product->product->type }}</td>
                                                    <td>{{ $product->product->part_number }}</td>
                                                    <td>{{ $product->product->brand }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>{{ $product->qty }}</td>
                                                    <td>{{ $product->commercial_price }} $</td>
                                                    <td>{{ $product->retail_price }} $</td>
                                                    <td>
                                                        <a title="remove" href="{{ route('vendor.product.delete', ['id' => $product->id]) }}"
                                                            class="text-danger mx-1 fas fa-trash"></a>
                                                        <a title="edit" href="{{ route('vendor.product.edit', ['id' => $product->id]) }}"
                                                            class="text-info mx-1 fas fa-edit"></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @include('components.admin.pagination', ['paginator' => $products])
                            </div>
                        </div>
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function(document) {
            'use strict';

            var TableFilter = (function(myArray) {
                var search_input;

                function _onInputSearch(e) {
                    search_input = e.target;
                    var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                    myArray.forEach.call(tables, function(table) {
                        myArray.forEach.call(table.tBodies, function(tbody) {
                            myArray.forEach.call(tbody.rows, function(row) {
                                var text_content = row.textContent.toLowerCase();
                                var search_val = search_input.value.toLowerCase();
                                row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                            });
                        });
                    });
                }

                return {
                    init: function() {
                        var inputs = document.getElementsByClassName('search-input');
                        myArray.forEach.call(inputs, function(input) {
                            input.oninput = _onInputSearch;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                    TableFilter.init();
                }
            });

        })(document);
    </script>
@endsection()
