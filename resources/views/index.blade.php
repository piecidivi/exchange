<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ mix("css/app.css") }}" rel="stylesheet">
        <title>Exchange</title>
    </head>
    <body  class="bg-no-repeat bg-fixed bg-center bg-project-picture font-serif font-bold">
        <div id="app">
            <v-component :currency="{{ $currency }}"></v-component>
        </div>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <!--Get your own code at fontawesome.com-->
        <script src="{{ mix("js/app.js") }}"></script>
    </body>
</html>

