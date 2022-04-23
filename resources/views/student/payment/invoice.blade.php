<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>skilldevbd.com</title>
    <style>
        body{
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 15px 0px;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
            background-color: #0d1033;
            padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            position: relative;
        }

        .info{
            width: 100%;
        }
        .info_left{
            width: 50%;
            float: left;
        }
        .info_right{
            width: 50%;
            float: right;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
            position: absolute;
            right: 0px;
            top: 1px;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
        .clearfix{
            clear: both;
        }
    </style>
</head>
<body>

<div class="container" style="padding-top: 30px;">
    <div class="brand-section">
        <div class="row">
            <div class="col-6">
                <h1 class="text-white">skilldevbd.com</h1>
            </div>
            <div class="info-right">
                <div class="company-details">
                    <p class="text-white">Dhaka, Bangladesh</p>
                    <p class="text-white">online@suppot.gmail.com</p>
                    <p class="text-white">+88 0179999999</p>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="body-section">
        <div>
            <div>
                <h2 class="heading">Invoice No.: #{{$payment->id}}</h2>
                <p class="sub-heading">Transaction Id: {{$payment->transaction_id}}</p>
                <p class="sub-heading">Order Date: {{$payment->created_at}} </p>
                <p class="sub-heading">Email Address: {{$user->email}} </p>
            </div>
            <div>
                <p class="sub-heading">Full Name:  {{$user->name}}</p>
                <p class="sub-heading">Phone Number:  {{$user->phone}}</p>
                <p class="sub-heading">Address:  {{$user->address}}</p>
            </div>
        </div>
    </div>

    <div class="body-section">
        <h3 class="heading">Ordered Items</h3>
        <br>
        <table class="table-bordered">
            <thead>
            <tr>
                <th>Product</th>
                <th class="w-20">Price</th>
                <th class="w-20">Quantity</th>
                <th class="w-20">Grand total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$course->title}}</td>
                <td>${{$payment->amount}}</td>
                <td>1</td>
                <td>${{$payment->amount}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Sub Total</td>
                <td> ${{$payment->amount}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Tax Total %0 X</td>
                <td> $ 0</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Grand Total</td>
                <td> ${{$payment->amount}}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <h3 class="heading">Payment Status: {{$payment->status ? 'Paid':'Due'}}</h3>
    </div>
    <div class="body-section">
        <p>&copy; Copyright 2021 - skilldevbd. All rights reserved.
            <a href="https://www.online-course.com" class="float-right">www.skilldevbd.com</a>
        </p>
    </div>
</div>

</body>
</html>
