@extends('front.layouts.index')
@section('title')
    <title>My Profile</title>
@endsection

@section('content')

    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">Home</a></li>
                    <li class="item-link"><span>My Profile</span></li>
                </ul>
            </div>
            <div class="content">
                <style>
                    .content {
                        padding-top: 40px;
                        padding-bottom: 40px;
                    }

                    .icon-stat {
                        display: block;
                        overflow: hidden;
                        position: relative;
                        padding: 15px;
                        margin-bottom: 1em;
                        background-color: #fff;
                        border-radius: 4px;
                        border: 1px solid #ddd;
                    }

                    .icon-stat-label {
                        display: block;
                        color: #999;
                        font-size: 13px;
                    }

                    .icon-stat-value {
                        display: block;
                        font-size: 28px;
                        font-weight: 600;
                    }

                    .icon-stat-visual {
                        position: relative;
                        top: 22px;
                        display: inline-block;
                        width: 32px;
                        height: 32px;
                        border-radius: 4px;
                        text-align: center;
                        font-size: 16px;
                        line-height: 30px;
                    }

                    .bg-primary {
                        color: #fff;
                        background: #d74b4b;
                    }

                    .bg-secondary {
                        color: #fff;
                        background: #6685a4;
                    }

                    .icon-stat-footer {
                        padding: 10px 0 0;
                        margin-top: 10px;
                        color: #aaa;
                        font-size: 12px;
                        border-top: 1px solid #eee;
                    }
                </style>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="icon-stat">
                                <div class="row">
                                    <div class="col-xs-8 text-left">
                                        <span class="icon-stat-label">Total Cost</span>
                                        <span class="icon-stat-value">${{$total_cost}}</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
                                    </div>
                                </div>
                                <div class="icon-stat-footer">
                                    <i class="fa fa-clock-o"></i> Updated Now
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="icon-stat">
                                <div class="row">
                                    <div class="col-xs-8 text-left">
                                        <span class="icon-stat-label">Total Purchase</span>
                                        <span class="icon-stat-value">{{$total_purchase}}</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                                    </div>
                                </div>
                                <div class="icon-stat-footer">
                                    <i class="fa fa-clock-o"></i> Updated Now
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="icon-stat">
                                <div class="row">
                                    <div class="col-xs-8 text-left">
                                        <span class="icon-stat-label">Today Delivered</span>
                                        <span class="icon-stat-value">{{$total_delivered}}</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                                    </div>
                                </div>
                                <div class="icon-stat-footer">
                                    <i class="fa fa-clock-o"></i> Updated Now
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="icon-stat">
                                <div class="row">
                                    <div class="col-xs-8 text-left">
                                        <span class="icon-stat-label">Today Canceled</span>
                                        <span class="icon-stat-value">{{$total_canceled}}</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
                                    </div>
                                </div>
                                <div class="icon-stat-footer">
                                    <i class="fa fa-clock-o"></i> Updated Now
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5> Profile Details </h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('profile.edit' , $user_profile->user_id) }}"
                                       class="btn btn-success pull-right">Edit
                                        Profile</a>

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Profile Picture</th>
                                    @if($user_profile->image !== null)
                                        <td><img src="{{asset('assets/images/profiles/'.$user_profile->image)}}" width="50"></td>
                                    @else
                                        <td><img src="{{asset('assets/images/profiles/default.png')}}" width="50"></td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{ $user_profile->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user_profile->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $user_profile->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>Line 1</th>
                                    <td>{{ $user_profile->line1 }}</td>
                                </tr>
                                <tr>
                                    <th>Line 2</th>
                                    <td>{{ $user_profile->line2 }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $user_profile->city }}</td>
                                </tr>
                                <tr>
                                    <th>Province</th>
                                    <td>{{ $user_profile->province }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $user_profile->country }}</td>
                                </tr>
                                <tr>
                                    <th>ZipCode</th>
                                    <td>{{ $user_profile->zipcode }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
