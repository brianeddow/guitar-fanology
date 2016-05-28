<!DOCTYPE html>
<html>
    <head>
        <title>Guitars</title>

        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script>
        var updateClock = function() {
            function pad(n) {
                return (n < 10) ? '0' + n : n;
            }

            var now = new Date();
            var s = pad(now.getHours()) + ':' +
                    pad(now.getUTCMinutes()) + ':' +
                    pad(now.getUTCSeconds());

            $('#clock').html(s);

            var delay = 1000 - (now % 1000);
            setTimeout(updateClock, delay);
        };

        $('#clock').html(updateClock());
        </script>
    </head>
    <body>

    <div class="container">
    <table style="padding-left: 20px; background-color: #fff; border-radius: 8px;" class="col-md-offset-1 col-md-10">
        <tr>
            <td>
                <h1 style="font-family: Indie Flower;">Guitar Fanology</h1>
            </td>
            <td style="text-align: right;" class="col-md-4">
                @if($guitar->fanologists)
                    {{ $guitar->fanologists }} fans
                @endif
                | <span id="clock"></span> | <a href="/logout">Logout</a> (as <?php echo Auth::user()->email; ?>)
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; background-image: url('/img/side.jpg'); background-repeat: repeat-y; background-color: #B8B8B8; border: 1px solid black;" class="col-md-5">
                <h3>Destroy Axe...</h3>

                @if ($guitar)
                    Are you sure you want to remove the {{ $guitar->name }} {{ $guitar->model }}?<br />
                @endif

                <br />
                <a href="/guitars/<?php echo $guitar->id ?>/destroy">Yes, Remove</a><br />
                <a href="/guitars/<?php echo $guitar->id ?>/"><< Back</a><br /><br />

            </td>
            <td style="vertical-align: top;" class="col-md-4">

            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
