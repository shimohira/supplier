<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABC</title>
    <style type="text/css">
     @page {
        @top-right {
            content: "bar";
        }
     }
     .footer { position: fixed; bottom: 0px; }

     .pagenum:before { content: counter(page); }
 </style>
</head>
<body>
    <div class="header">
         <img src="img/logo1.png">
         <hr>
         
    </div>
<div class="content">
 @yield('content')
</div>
</body>
</html>
