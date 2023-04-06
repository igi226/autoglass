@extends('vendor.layouts.app')

@section('title', 'My profile')

@section('content')
    <div class="main-content main-content-profile">
        <div class="container">
            <!-- breadcrumb -->
            <div class="main-content-breadcrumb"> <span>Vendor</span><span>My Profile</span>
                <div class="main-content-title ml-auto mb-0">My Profile</div>
            </div> <!-- /breadcrumb -->
            <!-- row -->
            <div class="row row-sm">
                <!-- Col -->
                <div class="col-lg-4">
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="pl-0">
                                <div class="main-profile-overview">
                                    <form action="{{ route('vendor.avatar.update') }}" method="post" id="avatar_form">
                                        @csrf()
                                        <input type="file" name="file" id="avatar_file" class="d-none" accept=".png,.jpeg,.jpg">
                                        <input type="hidden" name="old_file" value="{{ $user->avatar }}">
                                    </form>
                                    <div class="main-img-user profile-user">
                                        @if ($user->avatar)
                                            <img alt="Profile Image"
                                                src="{{ asset('storage/avatars') }}/{{ $user->avatar }}" id="profile_image">
                                        @else()
                                            <img alt="Profile Image" src="{{ asset('vendors/assets/img/users/user.png') }}" id="profile_image">
                                        @endif
                                        <label class="fas fa-camera profile-edit text-primary" for="avatar_file"></label>
                                    </div>
                                    <div class="d-flex justify-content-between mg-b-20">
                                        <div>
                                            <h5 class="main-profile-name">{{ $user->name }}</h5>
                                            <p class="main-profile-name-text">{{ $user->company }}</p>
                                        </div>
                                    </div>
                                </div><!-- main-profile-overview -->
                            </div>
                        </div>
                    </div>
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="main-content-label tx-13 mg-b-25"> Conatct </div>
                            <div class="main-profile-contact-list">
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-primary"> <i
                                            class="icon ion-md-phone-portrait"></i> </div>
                                    <div class="media-body"> <span>Mobile</span>
                                        <div>
                                            {{ $user->phone }}
                                            @if (!$user->phone)
                                                Not Available
                                            @endif()
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-success-transparent text-success"> <i
                                            class="icon ion-md-mail"></i> </div>
                                    <div class="media-body"> <span>E-mail</span>
                                        <div>
                                            {{ $user->email }}
                                            @if (!$user->email)
                                                Not Available
                                            @endif()
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-info-transparent text-info"> <i
                                            class="icon ion-md-locate"></i> </div>
                                    <div class="media-body"> <span>Current Address</span>
                                        <div>
                                            {{ $user->address }}
                                            @if (!$user->address)
                                                Not Available
                                            @endif()
                                        </div>
                                    </div>
                                </div>
                            </div><!-- main-profile-contact-list -->
                        </div>
                    </div>
                </div> <!-- /Col -->
                <!-- Col -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4 main-content-label">Personal Information</div>
                            <form class="form-horizontal" action="{{ route('vendor.profile.update') }}" method="POST">
                                @csrf()
                                <div class="mb-4 main-content-label">Name</div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Name</label> </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="Full Name" value="{{ $user->name }}" name="name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 main-content-label">Contact Info</div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Email<i>(required)</i></label>
                                        </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="Email" value="{{ $user->email }}" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Mobile No.</label> </div>
                                        <div class="col-md-9"> <input type="tel" class="form-control"
                                                placeholder="Contact No." value="{{ $user->phone }}" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Address</label> </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="address" rows="2" placeholder="Address" name="address">{{ $user->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">City</label> </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="City" value="{{ $user->city }}" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">State</label> </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="State" value="{{ $user->state }}" name="state">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Zip<i>(required)</i></label> </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="Zip" value="{{ $user->zip }}" name="zip" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 main-content-label">Company Information</div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Company</label> </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="Company" value="{{ $user->company }}" name="company"> </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Owner</label> </div>
                                        <div class="col-md-9"> <input type="text" class="form-control"
                                                placeholder="Owner Of the Company" value="{{ $user->owner }}"
                                                name="owner"> </div>
                                    </div>
                                </div>
                                <div class="mb-4 main-content-label"><!--Tax Information--></div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3"> <label class="form-label">Resale Certificate Number</label> </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tax_id"
                                                placeholder="Resale Certificate Number" value="{{ $user->tax_id }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Update Profile</button> </div>
                            </form>
                        </div>

                    </div>
                </div> <!-- /Col -->
            </div>
        </div>
    </div>

@endsection()

@section('script')
<script src="{{ asset('vendors') }}/assets/js/profile.js"></script>
@endsection()
