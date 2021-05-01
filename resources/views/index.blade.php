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
        <h1 class="border-2 border-white flex justify-center w-80 py-4 px-36 rounded-xl mt-16 mr-auto ml-auto bg-green-500 text-blue-700 text-center text-3xl">Exchange</h1>
        <div id="app">
            <v-index></v-index>
            <data-component :currency="{{ $currency }}"></data-component>
        </div>
        <div>
            <button class="flex justify-center fas m-auto rounded-xl  border-2 bg-yellow-400 border-blue-500 border-opacity-0 hover:border-blue-500 p-1 px-3 text-2xl rounded"
                    type="button" id="left" name="left" onclick="">&#xf100;
            </button>
            <button class="flex justify-center fas m-auto rounded-xl  border-2 bg-yellow-400 border-blue-500 border-opacity-0 hover:border-blue-500 p-1 px-3 text-2xl rounded"
                    type="button" id="right" name="right" onclick="">&#xf101;
            </button>
        </div>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <!--Get your own code at fontawesome.com-->
        <script src="{{ mix("js/app.js") }}"></script>
    </body>
</html>

