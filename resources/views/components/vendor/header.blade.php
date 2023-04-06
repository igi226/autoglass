<div class="main-header shadow-none">
    <div class="container">
        @php
            $user = get_user_details();
        @endphp
        <!--logo-->
        <div class="main-header-left"> <a class="main-header-menu-icon d-lg-none" href=""
                id="mainNavShow"><span></span></a>
            <a class="main-logo text-white d-none d-md-block" href="{{ route('vendor.index') }}">
                Glass Inventory
            </a>
        </div>
        <!--/logo-->
        <div class="main-header-center">
            <form method="GET" action="{{ route('vendor.market.index') }}" class="search-element">
                <input class="form-control" placeholder="Search" type="search" name="search">
                <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
                <button class="btn">
                    <i class="ti-search"></i>
                </button>
            </a>
        </div>
        <div class="main-header-right">
            @php
                $newNotification = $user
                    ->notifications()
                    ->where('status', 0)
                    ->get()
                    ->count();
            @endphp
            <div class="dropdown main-header-notification">
                <a class="@if ($newNotification) new @endif()" href="javascript:void"
                    data-sync="{{ route('vendor.notification.mark') }}">
                    <i class="ti-bell"></i>
                </a>
                <div class="dropdown-menu notification-container">
                    <div class="main-dropdown-header mg-b-20 d-sm-none"> <a class="main-header-arrow" href=""><i
                                class="icon ion-md-arrow-back"></i></a> </div>
                    <div class="p-3 border-bottom">
                        <h6 class="main-notification-title">Notifications</h6>
                        <p class="main-notification-text mb-0">
                            @if ($newNotification)
                                You have {{ $newNotification }} unread notification
                            @endif()
                        </p>
                    </div>
                    <div class="main-notification-list">
                        @php
                            $notifications = $user
                                ->notifications()
                                ->orderBy('id', 'desc')
                                ->orderBy('status', 'desc')
                                ->limit(6)
                                ->get();
                        @endphp
                        @foreach ($notifications as $notification)
                            <div class="media @if ($notification->status == 0) new @endif()"
                                data-redirect-to="{{ $notification->url }}">
                                <div class="main-img-user"><img alt=""
                                        src="{{ asset('vendors') }}/assets/img/users/user.png">
                                </div>
                                <div class="media-body">
                                    <p class="@if ($notification->status == 0) text-dark @endif()">
                                        {!! $notification->message !!}
                                    </p>
                                    <span>
                                        {{ $notification->created_at->format('d F, H:i') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="dropdown-footer"> <a href="{{ route('vendor.notifications') }}">View All
                            Notifications</a> </div>
                </div>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="main-img-user" href="">
                    @if ($user->avatar == null)
                        <img alt="Avatar" src="{{ asset('vendors') }}/assets/img/users/user.png">
                    @else()
                        <img alt="Avatar" src="{{ asset('storage/avatars') }}/{{ $user->avatar }}">
                    @endif()
                </a>
                <div class="dropdown-menu">
                    <div class="main-dropdown-header d-sm-none"> <a class="main-header-arrow" href=""><i
                                class="icon ion-md-arrow-back"></i></a> </div>
                    <div class="main-header-profile">
                        <div class="main-img-user">
                            @if ($user->avatar == null)
                                <img alt="Avatar" src="{{ asset('vendors') }}/assets/img/users/user.png">
                            @else()
                                <img alt="Avatar" src="{{ asset('storage/avatars') }}/{{ $user->avatar }}">
                            @endif()
                        </div>
                        <h6>{{ $user->name }}</h6>
                        <p>{{ $user->company }}</p>
                    </div>
                    <a class="dropdown-item" href="{{ route('vendor.profile') }}">
                        <i class="si si-user"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('vendor.mypurchase') }}">
                        <i class="ti-shopping-cart"></i> My Puchases
                    </a>
                    <a class="dropdown-item" href="#" id="createReportContext">
                        <i class="ti-flag"></i> Report an Issue
                    </a>
                    <a class="dropdown-item" href="{{ route('vendor.logout') }}">
                        <i class="si si-power"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sticky-wrapper" class="sticky-wrapper" style="height: 3710.41px;">
    <div class="main-navbar" style="">
        <div class="container">
            <ul class="nav">
                <li class="nav-label">Main Menu</li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('vendor.index') }}"><i
                            class="ti ti-desktop"></i>Dashboard</a> </li>
                <li class="nav-item"> <a class="nav-link with-sub" href="">
                        <i class="ti-package"></i>Inventory</a>
                    <ul class="nav-sub">
                       
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.product.myproduct') }}">My Inventory</a> </li>
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.product.index') }}">Add Part</a> </li>
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.product.myproduct') }}">Remove Part</a> </li>
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.product.pending') }}">Pending Inventory</a> </li>
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.product.request') }}">Part  Requests</a> </li>
                    </ul>
                </li>
                <li class="nav-item"> <a class="nav-link with-sub" href="">
                        <i class="ti-notepad"></i>Orders</a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.orders.requests') }}">Order Requests</a> </li>
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.order.refunds') }}">Refund Requests</a>
                        </li>
                        <li class="nav-sub-item"> <a class="nav-sub-link"
                                href="{{ route('vendor.order.index') }}">Order History</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('vendor.market.index') }}"><i
                            class="ti ti-shopping-cart"></i>Part Search</a> </li>
            </ul>
        </div>
    </div>
</div>
