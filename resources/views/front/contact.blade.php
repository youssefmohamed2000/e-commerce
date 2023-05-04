@extends('front.layouts.index')
@section('title')
    <title>Contact Page</title>
@endsection
@section('content')
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
                    <li class="item-link"><span>Contact us</span></li>
                </ul>
            </div>
            <div class="row">
                <div class=" main-content-area">
                    <div class="wrap-contacts ">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="contact-box contact-form">
                                <h2 class="box-title">Leave a Message</h2>
                                @if(Session::has('success'))
                                    <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                                @endif
                                <form action="{{route('contact.store')}}" method="POST" name="frm-contact">
                                    @csrf
                                    <label for="name">Name<span>*</span></label>
                                    <input type="text" value="{{$user->name}}" id="name" name="name" required>
                                    @error('name') <p class="text-danger">{{$message}}</p> @enderror

                                    <label for="email">Email<span>*</span></label>
                                    <input type="text" value="{{$user->email}}" id="email" name="email" required>
                                    @error('email') <p class="text-danger">{{$message}} </p>@enderror

                                    <label for="phone">Number Phone</label>
                                    <input type="text" value="" id="phone" name="phone" required>
                                    @error('phone') <p class="text-danger">{{$message}}</p> @enderror

                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" required></textarea>
                                    @error('comment') <p class="text-danger">{{$message}}</p> @enderror

                                    <input type="submit" name="ok" value="Submit">

                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="contact-box contact-info">
                                <div class="wrap-map">
                                    <iframe
                                        src="{{$setting->map}}"
                                        width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <h2 class="box-title">Contact Detail</h2>
                                <div class="wrap-icon-box">

                                    <div class="icon-box-item">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>Email</b>
                                            <p>{{$setting->email}}</p>
                                        </div>
                                    </div>

                                    <div class="icon-box-item">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>Phone</b>
                                            <p>{{$setting->phone}}</p>
                                        </div>
                                    </div>

                                    <div class="icon-box-item">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <div class="right-info">
                                            <b>Address</b>
                                            <p>{{$setting->address}}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end main products area-->
            </div><!--end row-->
        </div><!--end container-->
    </main>
@endsection
