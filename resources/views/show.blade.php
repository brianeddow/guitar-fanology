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

    <div class="container" style="margin-bottom: 20px;">
    <table style="padding-left: 20px; background-color: #fff;" class="col-md-offset-1 col-md-10">
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
            <td style="vertical-align: top; background-color: #b8b8b8; border: 1px solid black; border-right: 0px;" class="col-md-5">
                <h3>Axe Info...</h3>

                @if ($guitar)
                    <span style="font-weight: bold;">Name:</span> {{ $guitar->name }}<br />
                    <span style="font-weight: bold;">Model:</span> {{ $guitar->model }}<br />
                    <span style="font-weight: bold;">Notes:</span> {{ $guitar->notes }}<br />
                @endif

                <hr>
                <h3>We like this one!</h3>

                <table style="width: 100%;">
                    <tr>
                        <td>
                            @if ($guitar->other_users)
                                <ul>
                                @foreach ($guitar->other_users as $user)
                                    <li>{{ $user->email }}</li>
                                @endforeach
                                </ul>
                            @else
                                <p>(No one else yet)</p>
                            @endif
                        </td>
                        <td style="text-align: right; vertical-align: top;">
                            @if ($guitar->other_users_count > 0)
                                <p>({{ $guitar->other_users_count }})</p>
                            @endif
                    </tr>
                </table>

                <hr>
                <h3>Posts</h3>

                <div style="padding-left: 10px;">
                    @if ($guitar->posts)
                        @foreach ($guitar->posts as $post)
                            <p style="background-color: #DDCDB6; border-radius: 6px; padding-left: 10px;">{{ $post->body }}<br />
                            by <span style="font-weight: bold;">{{ $post->user->email }}</span>

                            @if ($post->user_id == $guitar->auth_id)
                                 - <a href="/posts/<?php echo $post->id; ?>/delete/">delete</a></p>
                            @endif

                            @if ($guitar->comments)
                                @foreach ($guitar->comments as $comm)
                                    @if ($comm->post_id == $post->id)
                                        <p style="margin-left: 20px; padding-left: 5px; background-color: #E3D3BA; border-radius: 6px;">{{ $comm->body }} by <span style="font-weight: bold;">{{ $comm->email }}</span>

                                        @if ($comm->user_id == $guitar->auth_id)
                                             - <a href="/comments/<?php echo $comm->id; ?>/delete/">delete</a></p>
                                        @endif

                                    @endif
                                @endforeach
                            @endif

                            <div style="padding-left: 20px;">
                                <form action="/comments/<?php echo $post->id ?>/add" method="post">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="text" name="body" placeholder="Comment" style="width: 290px;" class="form-control transparent-input">
                                            </td>
                                            <td style="padding-left: 7px;">
                                                <input type="submit" value="+" class="btn btn-danger">
                                            </td>
                                        </tr>
                                    </table>
                                </form><br />
                                @if (count($errors))
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>

                        @endforeach

                    @else
                        <p>Add a post --></p>
                    @endif
                </div>

            </td>
            <td style="vertical-align: top; background-image: url('/img/side.jpg'); background-repeat: repeat-y; background-color: #b8b8b8; border: 1px solid black; border-left: 0px;" class="col-md-5">
                <h3>Actions</h3>

                <a href="/guitars/<?php echo $guitar->id ?>/like">like</a> (<a href="/guitars/<?php echo $guitar->id ?>/unlike">undo</a>)<br />
                <a href="/guitars/<?php echo $guitar->id ?>/edit">edit</a><br />
                <a href="/guitars/<?php echo $guitar->id ?>/remove">delete</a><br />
                <a href="/guitars"><< Home</a>

                <hr>
                <h3>Share what you think of the {{ $guitar->model }}
                </h3>

                <form action="/posts/<?php echo $guitar->id ?>/new" method="post">
                <table>
                    <tr>
                        <td style="vertical-align: top;">
                            Post:</td><td><textarea name="body" class="form-control transparent-input" style="width: 300px;"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><br />
                            <input type="submit" value="Add Post" class="btn btn-danger">
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
