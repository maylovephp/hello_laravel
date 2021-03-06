<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <form method="POST" action="/goRegister">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
        <div class="content">
            帐 号：<input type="text" name="userName" value="">
            <br /><br />
            密码1：<input type="passWord" name="passWord1" value="">
            <br /><br />
            密码2：<input type="passWord" name="passWord2" value="">
            <br /><br />
            昵 称：<input type="text" name="nickName" value="">
            <br /><br />
            <button type="submit" value="Submit">保存</button>
            <button type="reset" value="reset">复位</button>
        </div>
    </form>
</div>
</body>
</html>
