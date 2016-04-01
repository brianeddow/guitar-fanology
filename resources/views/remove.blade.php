<!DOCTYPE html>
<html>
    <head>
        <title>Guitars</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="./../../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>

    <div class="container">
    <table style="padding-left: 20px; background-color: #fff; border-radius: 8px;" class="col-md-8">
        <tr>
            <td>
                <h1>Guitar Fanology</h1>
            </td>
            <td style="text-align: right;" class="col-md-4">
                <a href="/home">Logout</a> (as <?php echo Auth::user()->email; ?>)
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; width: 400px; background-color: #FAD2B1; border-radius: 8px;" class="col-md-4">
                <h2>Destroy Axe...</h2>

                @if ($guitar)
                    Are you sure you want to remove the {{ $guitar->name }} {{ $guitar->model }}?<br />
                @endif

                <br />
                <a href="/guitars/<?php echo $guitar->id ?>/destroy">remove</a><br />
                <a href="/guitars/<?php echo $guitar->id ?>/">back</a>

            </td>
            <td style="vertical-align: top;" class="col-md-4">

            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
