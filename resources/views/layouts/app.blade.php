<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CouchDB Shoes - @yield('title', 'Home')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.1/css/bulma.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/css/app.css" />
    </head>
    <body>
        @include('partials.nav')

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <section class="section main">
            <div class="container">
                @if (session()->has('flash_notification.message'))
                    <div class="notification is-{{ session('flash_notification.level') }}">
                            <button class="delete"></button>
                            
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif

                @yield('content')
            </div>            
        </section>

        <script type="text/javascript">
            $('.notification button.delete').click(function (e) {
                $(this).parent().remove();
            });

            $('div.notification').delay(3000).fadeOut(350);
        </script>
    </body>
</html>
