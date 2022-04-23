<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course Certificate</title>
    <style>
        @import url({{url('https://fonts.googleapis.com/css2?family=Lato&family=Playfair+Display&display=swap')}});
        body{
            background-color: red;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: auto;
            font-family: 'Lato', sans-serif;
        }
        .application__title{
            font-size: 32px;
            color: #434343;
            line-height: 32px;
            font-weight: bold;
            margin-top: 280px;
            text-align: center;
        }
        .certificate__title{
            font-weight: bold;
            font-size: 35px;
            font-family: "Playfair Display", serif;
            font-style: normal;
            text-decoration: none;
            color: rgb(67, 67, 67);
            text-align: center;
        }
        .awarded__title{
            font-weight: normal;
            font-size: 20px;
            font-style: normal;
            text-decoration: none;
            color: rgb(67, 67, 67);
            text-align: center;
        }
        .person__title{
            font-weight: bold;
            font-size: 30px;
            font-family: "Playfair Display", serif;
            font-style: normal;
            text-decoration: none;
            color: rgb(151, 141, 88);
            text-align: center;
        }
        .course__title__p{
            font-weight: normal;
            font-size: 20px;
            font-style: normal;
            text-decoration: none;
            color: rgb(67, 67, 67);
            text-align: center;
        }
        .course__title{
            font-weight: bold;
            font-size: 22px;
            font-family: "Playfair Display", serif;
            font-style: normal;
            text-decoration: none;
            color: rgb(151, 141, 88);
            text-align: center;
        }
        .certificate__date{
            font-weight: normal;
            font-size: 12px;
            font-style: normal;
            text-decoration: none;
            color: rgb(67, 67, 67);
            text-align: center;
            line-height: 30px;
        }
        .signature__line{
            font-size: 14px;
            font-family: "Open Sans", sans-serif;
            font-style: normal;
            text-decoration: none;
            color: rgb(0, 0, 0);
            margin-top: 55px;
            text-align: center;
        }
        .admin__name{
            font-weight: bold;
            font-size: 25px;
            font-style: normal;
            text-decoration: none;
            color: rgb(67, 67, 67);
            line-height: 0px;
            text-align: center;
        }

    </style>
</head>
<body style="background-image: url('cirtificate.png'); background-position: center; background-repeat: no-repeat; background-attachment: fixed; background-size: 750px 800px;">
    <div class="parent__class">
        <p class="application__title">SKILL DEV BD</p>
        <p class="certificate__title">CERTIFICATE OF ACHIEVEMENT</p>
        <p class="awarded__title">This certificate is awarded to</p>
        <p class="person__title">{{$name->name}}</p>
        <p class="course__title__p">For successfully completing Online Course</p>
        <p class="course__title">"{{$course->title}}"</p>
        <p class="signature__line">Provided By</p>
        <p class="admin__name">skilldevbd.com</p>
        <p class="certificate__date">{{\Carbon\Carbon::parse($date)->format("j S F Y")}}</p>
    </div>
</body>
</html>
