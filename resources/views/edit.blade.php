<!DOCTYPE html>
<html>
    <head>
        <title>Guitars</title>

        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <style>
            input.transparent-input{
               background-color: rgba(255,255,255,0.5) !important;
               border:none !important;
            }
            textarea.transparent-input{
                background-color: rgba(255,255,255,0.5) !important;
                border:none !important;
            }
        </style>
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
    <table style="padding-left: 20px; background-color: #fff;" class="col-md-offset-1 col-md-10">
        <tr>
            <td>
                <h1 style="font-family: Indie Flower;">Guitar Fanology</h1>
            </td>
            <td style="text-align: right;" class="col-md-4">
                @if($fanologists)
                    {{ $fanologists }} fans
                @endif
                | <span id="clock"></span> | <a href="/logout">Logout</a> (as <?php echo Auth::user()->email; ?>)
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; background-color: #B8B8B8; border: 1px solid black; border-right: 0px;" class="col-md-5">
                <h3>Update Axe...</h3>

                @if ($guitar)
                    <span style="font-weight: bold;">{{ $guitar->name }} {{ $guitar->model }}</span><br />
                    <span style="font-weight: bold;">Notes:</span> {{ $guitar->notes }}<br />

                <br />
                <form action="/guitars/<?php echo $guitar->id ?>/update" method="post">
                    {{ method_field('patch') }}
                <table>
                    <tr>
                        <td>
                            name:</td><td>{{ $guitar->name }}</td>
                    </tr>
                    <tr>
                        <td>
                            model:</td><td>{{ $guitar->model }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">
                            notes:</td><td><textarea name="notes" class="form-control transparent-input" style="width: 300px;"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><br />
                            <input type="submit" value="Submit Edit to Notes" class="btn btn-danger">
                        </td>
                    </tr>
                </table>
                </form>
                @endif

                @if (count($errors))
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                @endif

                <br />
                <a href="/guitars/<?php echo $guitar->id ?>/"><< Back</a><br /><br />

            </td>
            <td style="vertical-align: top; background-image: url('/img/side.jpg'); background-repeat: repeat-y; background-color: #B8B8B8; border: 1px solid black; border-left: 0px;" class="col-md-5">

                <h3>All notes submissions</h3>

                @if ($notes)
                    @foreach ($notes as $note)
                        {{ $note->notes }}
                        @if ($note->count == 0)

                        @else
                            ({{ $note->count }})
                        @endif
                         - <a href="/guitars/<?= $note->note_id ?>/like_note">like</a><br />
                    @endforeach
                @endif
                <br /><br />

            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
