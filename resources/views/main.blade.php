<!DOCTYPE html>
<html>
    <head>
        <title>Guitars</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/style.css">
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
                <a href="/home">Logout</a> (as <?php echo Auth::user()->email ?>)
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; width: 400px; background-color: #FAD2B1; border-radius: 8px;" class="col-md-4">
                <h2>Guitars</h2>

                @if ($guitars)
                    <ul>
                    @foreach ($guitars as $guitar)
                        <li><a href="/guitars/<?php echo $guitar->id ?>">{{ $guitar->name }} {{ $guitar->model }}</a></li>
                    @endforeach
                    </ul>
                @endif

                <h2>Favorite Guitars</h2>

                @if ($likes)
                    <ul>
                    @foreach ($likes as $like)
                        <li><a href="/guitars/{{ $like->guitar_id }}/">{{ $like->name }} {{ $like->model }}</a></li>
                    @endforeach
                    </ul>
                @endif

            </td>
            <td style="vertical-align: top; background-color: #F7B660; border-radius: 8px;" class="col-md-6">
                <h2>Add new guitar</h2>


                <form action="/guitars/new" method="post">
                <table>
                    <tr>
                        <td>
                            name:</td><td><input type="text" name="name" value="{{ old('name') }}" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>
                            model:</td><td><input type="text" name="model" value="{{ old('model') }}" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>
                            notes:</td><td><input type="text" name="notes" value="{{ old('notes') }}" class="form-control"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><br />
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="submit" value="Add Guitar" class="btn btn-danger">
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
            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
