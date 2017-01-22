<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        body, html  {
            margin: 0; padding: 0; height: 100%; overflow: hidden;
        }

        #content {
            position:absolute; left: 0; right: 0; bottom: 0; top: 0px;
        }
    </style>
</head>
    <body>
        <div id="content">
            <iframe width="100%" height="100%" frameborder="0" src="{{ $launch_url }}" />
        </div>
    </body>
</html>