@extends('frontend.master')

@section('title', 'Successfully enroll')

@push('css')
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/woocommerce.css">
@endpush

@section('main-content')
    <div class="my-section">
        <div class="my-card">
            <div class="card-body">
                <div class="my-icon">
                    <img class="img-fluid" src="{{asset('frontend/images/check.png')}}" alt="">
                   {{-- <i class="icon-check"></i>--}}
                </div>
                <div>
                    <h1>Thank you</h1>
                    <p>You are successfully placed order. Please follow the bellow link to go dashboard</p>
                </div>
                <div>
                    @php
                        $user_type = \Illuminate\Support\Facades\Auth::user()->user_type;
                    @endphp
                    <a href="{{route($user_type.'.dashboard')}}" class="btn btn-lg mt-4 text-uppercase">G0 to Dashboard and see your course</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .my-section{
            background: #ddd;
            padding: 150px 0px;
        }
        .my-card{
            text-align: center;
            width: 700px;
            height: 450Px;
            background: #fff;
            border-radius: 4px;
            margin: 0px auto;
        }
        .my-card h1{
            font-size: 50px;
            color: #0d47a1;
        }

        .my-card p{
            color: #636363;
        }

        .my-icon{
            width: 50px;
            margin: 0 auto;
            padding-top: 70px;
        }

    </style>
@endpush
