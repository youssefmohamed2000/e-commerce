@extends('front.layouts.index')
@section('title')
    <title>Edit Profile</title>
@endsection

@section('content')
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                    <li class="item-link"><a href="{{ route('profile.index') }}" class="link">Profile</a></li>
                    <li class="item-link"><span>Edit</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                <form action="{{ route('profile.update',$user_profile->user_id) }}" method="POST" enctype="multipart/form-data">
                    @include('partials._errors')
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wrap-address-billing">
                                <h3 class="box-title">Edit Profile</h3>
                                <div class="billing-address">
                                    <p class="row-in-form">
                                        <label for="name">Name<span>*</span></label>
                                        <input type="text" name="name" placeholder="Enter Your Name"
                                               value="{{$user_profile->user->name}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="email">Email Addreess:<span>*</span></label>
                                        <input type="email" name="email" placeholder="Enter Your Email"
                                               value="{{$user_profile->user->email}}" required>
                                    </p>
                                    <p class="row-in-form">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="number" name="mobile" placeholder="10 digits format"
                                               value="{{$user_profile->mobile}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="add">Line1:</label>
                                        <input type="text" name="line1" placeholder="Street at apartment number"
                                               value="{{$user_profile->line1}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="add">Line2:</label>
                                        <input type="text" name="line2" placeholder="Street at apartment number"
                                               value="{{$user_profile->line2}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="country">Country</label>
                                        <input type="text" name="country" placeholder="United States"
                                               value="{{$user_profile->country}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="province">Province</label>
                                        <input type="text" name="province" placeholder="Province"
                                               value="{{$user_profile->province}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="city">Town / City</label>
                                        <input type="text" name="city" placeholder="City Name"
                                               value="{{$user_profile->city}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="zip-code">Postcode / ZIP:</label>
                                        <input type="number" name="zipcode" placeholder="Your Postal Code"
                                               value="{{$user_profile->zipcode}}">
                                    </p>
                                    <p class="row-in-form">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </p>
                                    <button type="submit" class="btn btn-danger pull-right">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </main>
@endsection
