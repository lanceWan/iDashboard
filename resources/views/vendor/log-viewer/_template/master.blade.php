<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogViewer-晚黎后台</title>
    <meta name="description" content="LogViewer">
    <meta name="author" content="ARCANEDEV">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link href="http://cdn.bootcss.com/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    @include('log-viewer::_template.style')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    @include('log-viewer::_template.navigation')

    <div class="container-fluid">
        @yield('content')
    </div>

    @include('log-viewer::_template.footer')

    <script src="{{asset('vendors/jquery/jquery-2.1.1.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="http://cdn.bootcss.com/moment.js/2.15.2/moment-with-locales.min.js"></script>
    <script src="http://cdn.bootcss.com/Chart.js/2.3.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        Chart.defaults.global.responsive      = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
    @yield('scripts')
</body>
</html>
