@extends('vendor.layouts.app')

@section('title', 'Notifications')

@section('content')
    <div class="main-content main-content-mail">
        <div class="container">
            <div class="row row-sm">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="main-content-body main-content-body-mail card-body">
                            <div class="main-mail-list">
                                @foreach ($notifications as $notification)
                                    <div class="main-mail-item unread selected" data-redirect-to="{{ $notification->url }}">
                                        <div class="main-img-user"><img alt=""
                                                src="{{ asset('vendors') }}/assets/img/users/user.png"></div>
                                        <div class="main-mail-body">
                                            {!! $notification->message !!}
                                        </div>
                                        <div class="main-mail-date">{{ $notification->created_at->format('d F, H:i') }}</div>
                                    </div>
                                @endforeach
                            </div>
                            @include('components.admin.pagination', ['paginator' => $notifications])
                        </div>
                    </div>
                </div> <!-- Col-->
            </div>
        </div>
    </div>
@endsection()
