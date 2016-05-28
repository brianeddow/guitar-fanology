<!DOCTYPE html>
<html>
    <head>
        <title>Guitars</title>

        <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
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
            $(document).ready(function(){
                $('img').mouseenter(function(){
                    $(this).animate({width:"+=5px"}, 100);
                })
                $('img').mouseleave(function(){
                    $(this).animate({width:"-=5px"}, 100);
                })
                $('#show_woo').mouseenter(function(){
                    $('#woo').html("<span style='color: #D9534F; font-weight: bold; background-color: white; border-radius: 4px; margin-left: 6px; padding-right: 6px; padding-left: 6px;'>Woo!</span>");
                })
                $('#show_woo').mouseleave(function(){
                    $('#woo').html("");
                })

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

            })
        </script>
    </head>
    <body>

    <div class="container" style="margin-bottom: 20px;">
    <table style="padding-left: 20px; background-color: #fff; border-radius: 8px;" class="col-md-offset-1 col-md-10">
        <tr>
            <td>
                <h1 style="font-family: Indie Flower;">Guitar Fanology</h1>
            </td>
            <td style="text-align: right;" class="col-md-4">
                @if($fanologists)
                    {{ $fanologists }} fans
                @endif
                | <span id="clock"></span> | <a href="/logout">Logout</a> (as <?php echo Auth::user()->email ?>)
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; background-color: #b8b8b8; border: 1px solid black; border-right: 0px;" class="col-md-5">
                <h3>Welcome</h3>
                <p> -
                    @if($tagline)
                        {{ $tagline }}
                    @endif
                </p>

                <hr>
                <h3>Guitars</h3>

                @if ($guitars)
                    <ul>
                    @foreach ($guitars as $guitar)
                        <li><a href="/guitars/<?php echo $guitar->id ?>">{{ $guitar->name }} {{ $guitar->model }}</a></li>
                    @endforeach
                    </ul>
                @else
                    <p>Add a guitar!</p>
                @endif

                <hr>
                <h3>*Favorites</h3>

                @if ($likes)
                    <ul>
                    @foreach ($likes as $like)
                        <li><a href="/guitars/{{ $like->guitar_id }}/">{{ $like->name }} {{ $like->model }}</a></li>
                    @endforeach
                    </ul>
                @else
                    <p>You haven't liked any guitars yet</p>
                @endif

            </td>
            <td style="vertical-align: top; background-image: url('/img/side.jpg'); background-repeat: repeat-y; background-color: #b8b8b8; border: 1px solid black; border-left: 0;" class="col-md-5">
                <h3>Brands Reference</h3>

                <table style="width: 100%; height: 70px;">
                    <tr>
                        @if ($guitar_imgs)
                            @foreach ($guitar_imgs as $guitar)
                                <td style="text-align: center; width: 70px;">
                                    <img id="brand" src="/img/{{ $guitar->name }}.png" style="width:60px;heigth:40px;">
                                </td>
                            @endforeach
                        @else
                            <td>
                                <p>Guitars added will show up here</p>
                            </td>
                        @endif
                    </tr>
                </table>

                <hr>
                <h3>Add new guitar</h3>

                <form action="/guitars/new" method="post">
                <table>
                    <tr>
                        <td>
                            name:</td><td><input type="text" name="name" value="{{ old('name') }}" class="form-control transparent-input"></td>
                    </tr>
                    <tr>
                        <td>
                            model:</td><td><input type="text" name="model" value="{{ old('model') }}" class="form-control transparent-input"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">
                            notes:</td><td><textarea name="notes" value="{{ old('notes') }}" class="form-control transparent-input"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><br />
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <p><input id="show_woo" type="submit" value="Add Guitar" class="btn btn-danger"><span id="woo"></span></p>
                            <br />
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
                <br /><br />

            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
