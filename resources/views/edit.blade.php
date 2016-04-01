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
                <h2>Update Axe...</h2>

                @if ($guitar)
                    {{ $guitar->name }} {{ $guitar->model }}<br />
                    - {{ $guitar->notes }}<br />
                @endif

                <br />
                <form action="/guitars/<?php echo $guitar->id ?>/" method="post">
                    {{ method_field('patch') }}
                <table>
                    <tr>
                        <td>
                            name:</td><td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>
                            model:</td><td><input type="text" name="model"></td>
                    </tr>
                    <tr>
                        <td>
                            notes:</td><td><input type="text" name="notes"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><br />
                            <input type="submit" value="Update Guitar" class="btn btn-danger">
                        </td>
                    </tr>
                </table>
                </form>

                @if (count($errors))
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                @endif

                <br />
                <a href="/guitars/<?php echo $guitar->id ?>/">back</a>

            </td>
            <td style="vertical-align: top;" class="col-md-4">

            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
