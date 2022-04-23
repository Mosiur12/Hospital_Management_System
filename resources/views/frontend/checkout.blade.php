@extends('frontend.master')

@section('title', 'Checkout')

@push('css')
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/woocommerce.css">
@endpush

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Course <i class="fa fa-angle-double-right"> </i> Checkout </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>


    <section class="shop">
        <div class="section-padding">
            <div class="container">
                <div>

                    <div class="woocommerce">
                        @if($course->offer_price == 0)
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{route('checkout.store')}}" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                <div class="col2-set" id="customer_details">
                                    <div class="">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing details</h3>
                                            <div class="woocommerce-billing-fields__field-wrapper">
                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="billing_company" class="">Name</label>
                                                    <input name="name" class="input-text" id="" placeholder="Address" value="{{$user->name}}" autocomplete="organization" type="text" required>
                                                </p>

                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="billing_company" class="">Email</label>
                                                    <input name="email" class="input-text" id="" placeholder="Address" value="{{$user->email}}" autocomplete="organization" type="text" required>
                                                </p>


                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="phone" class="">Phone&nbsp;</label>
                                                    <input name="phone" class="input-text" id="" placeholder="phone" value="{{$user->phone}}" autocomplete="organization" type="text" required>
                                                </p>

                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="billing_company" class="">Address&nbsp;</label>
                                                    <input name="address" class="input-text" id="" placeholder="Address" value="{{$user->address}}" autocomplete="organization" type="text" required>
                                                </p>


                                                <input type="hidden" name="student_id" value="{{$user->id}}">
                                                <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">
                                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                                <input type="hidden" name="course_fee" value="{{$course->offer_price}}">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 id="order_review_heading">Your order</h3>

                                <div id="order_review" class="woocommerce-checkout-review-order">
                                    <table class="shop_table woocommerce-checkout-review-order-table" style="position: relative;">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                {{$course->title}}&nbsp; <strong class="product-quantity">× 1</strong> </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>{{$course->offer_price}}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>{{$course->offer_price}}</span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td data-title="Shipping">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span> 0 </span>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>{{$course->offer_price}}</span></strong> </td>
                                        </tr>

                                        </tfoot>
                                    </table>
                                    @php
                                        $enroll = \App\Enroll::where('student_id', $user->id)->where('course_id', $course->id)->first();
                                        $userType = \Illuminate\Support\Facades\Auth::user()->user_type;
                                    @endphp

                                    @if($enroll)
                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <a href="{{route($userType.".dashboard")}}" class="btn btn-lg enroll-btn">Go Dashboard</a>
                                        </div>
                                    @else
                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <button type="submit" class="button alt" id="place_order" value="Place order" data-value="Place order">Continue to Enroll</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        @else
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{url('/pay')}}">
                                @csrf
                                <div class="col2-set" id="customer_details">
                                    <div class="">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing details</h3>
                                            <div class="woocommerce-billing-fields__field-wrapper">
                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="billing_company" class="">Name</label>
                                                    <input name="name" class="input-text" id="" placeholder="Address" value="{{$user->name}}" autocomplete="organization" type="text" required>
                                                </p>

                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="billing_company" class="">Email</label>
                                                    <input name="email" class="input-text" id="" placeholder="Address" value="{{$user->email}}" autocomplete="organization" type="text" required>
                                                </p>


                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="phone" class="">Phone&nbsp;</label>
                                                    <input name="phone" class="input-text" id="" placeholder="phone" value="{{$user->phone}}" autocomplete="organization" type="text" required>
                                                </p>

                                                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                                    <label for="billing_company" class="">Address&nbsp;</label>
                                                    <input name="address" class="input-text" id="" placeholder="Address" value="{{$user->address}}" autocomplete="organization" type="text" required>
                                                </p>


                                                <input type="hidden" name="student_id" value="{{$user->id}}">
                                                <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">
                                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                                <input type="hidden" name="course_fee" value="{{$course->offer_price}}">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h3 id="order_review_heading">Your order</h3>

                                <div id="order_review" class="woocommerce-checkout-review-order">
                                    <table class="shop_table woocommerce-checkout-review-order-table" style="position: relative;">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                {{$course->title}}&nbsp; <strong class="product-quantity">× 1</strong> </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>{{$course->offer_price}}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>{{$course->offer_price}}</span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td data-title="Shipping">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span> 0 </span>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$&nbsp;</span>{{$course->offer_price}}</span></strong> </td>
                                        </tr>

                                        </tfoot>
                                    </table>
                                    @php
                                        $enroll = \App\Enroll::where('student_id', $user->id)->where('course_id', $course->id)->first();
                                        $userType = \Illuminate\Support\Facades\Auth::user()->user_type;
                                    @endphp

                                    @if($enroll)
                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <a href="{{route($userType.".dashboard")}}" class="btn btn-lg enroll-btn">Go Dashboard</a>
                                        </div>
                                    @else
                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <button type="submit" class="button alt" id="place_order" value="Place order" data-value="Place order">Continue to Payment</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">
@endpush
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM"></script>

    <script src="{{asset('assets/js/toastr.min.js')}}"></script>

    {!! Toastr::message() !!}

    <script type="text/javascript">
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}','Error', {closeButton:true, progressBar:true})
        @endforeach
        @endif
    </script>
@endpush
