@extends('front.layouts.index')
@section('title')
    <title>Review</title>
@endsection
@section('content')
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                    <li class="item-link"><span>Cart</span></li>
                </ul>
            </div>
            <div class="main-content-area">
                <div class="container" style="padding: 30px 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="review_form_wrapper">
                                <div id="comments">
                                    <h2 class="woocommerce-Reviews-title">Add Review for</h2>
                                    <ol class="commentlist">
                                        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                            id="li-comment-20">
                                            <div id="comment-20" class="comment_container">
                                                <img alt="" src="{{ $order_item->product->image }}" height="80"
                                                    width="80">
                                                <div class="comment-text">
                                                    <p class="meta">
                                                        <strong
                                                            class="woocommerce-review__author">{{ $order_item->product->name }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                                <div id="review_form">
                                    <div id="respond" class="comment-respond">

                                        <form action="{{ route('review.store', $order_item->id) }}" method="post"
                                            class="comment-form">
                                            @csrf
                                            <div class="comment-form-rating">
                                                <h4>Your rating</h4>
                                                <p class="stars">
                                                    <label for="rated-1"></label>
                                                    <input type="radio" id="rated-1" name="rating" value="1">
                                                    <label for="rated-2"></label>
                                                    <input type="radio" id="rated-2" name="rating" value="2">
                                                    <label for="rated-3"></label>
                                                    <input type="radio" id="rated-3" name="rating" value="3">
                                                    <label for="rated-4"></label>
                                                    <input type="radio" id="rated-4" name="rating" value="4">
                                                    <label for="rated-5"></label>
                                                    <input type="radio" id="rated-5" name="rating" value="5"
                                                        checked="checked">
                                                    @error('rating')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </p>
                                            </div>
                                            <p class="comment-form-comment">
                                                <label for="comment">
                                                    <h4> Your review</h4>
                                                </label>
                                                <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                                                @error('comment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </p>
                                            <p class="form-submit">
                                                <input name="submit" type="submit" id="submit" class="submit"
                                                    value="Submit">
                                            </p>
                                        </form>

                                    </div><!-- .comment-respond-->
                                </div><!-- #review_form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </main>
@endsection
