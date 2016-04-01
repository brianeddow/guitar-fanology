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
                <h2>Axe Info...</h2>

                @if ($guitar)
                    Name: {{ $guitar->name }}<br />
                    Model: {{ $guitar->model }}<br />
                    Notes: {{ $guitar->notes }}<br />
                @endif


                <br />
                <a href="/guitars/<?php echo $guitar->id ?>/like">like</a> (<a href="/guitars/<?php echo $guitar->id ?>/unlike">unlike</a>)<br />
                <a href="/guitars/<?php echo $guitar->id ?>/edit">edit</a><br />
                <a href="/guitars/<?php echo $guitar->id ?>/remove">delete</a><br />
                <a href="/guitars">back</a>

                <h3>Posts</h3>

                <div style="padding-left: 10px;">
                    @if ($guitar->posts)
                        @foreach ($guitar->posts as $post)
                            <p style="background-color: #eee; border-radius: 6px; padding-left: 10px;">{{ $post->body }}<br />
                            by {{ $post->user->email }} - <a href="/posts/<?php echo $post->id; ?>/delete/">delete</a></p>

                            @if ($guitar->comments)
                                @foreach ($guitar->comments as $comm)
                                    @if ($comm->post_id == $post->id)
                                        <p style="padding-left: 20px;">{{ $comm->body }} by {{ $comm->email }} - <a href="/comments/<?php echo $comm->id; ?>/delete/">delete</a></p>
                                    @endif
                                @endforeach
                            @endif

                            <div style="padding-left: 20px;">
                                <form action="/comments/<?php echo $post->id ?>/add" method="post">
                                    <input type="text" name="body" placeholder="Comment...">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="submit" value="+" class="btn btn-danger">
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
                    @endif
                </div>

            </td>
            <td style="vertical-align: top;" class="col-md-6">
                <h2>Add a post!</h2>

                <form action="/posts/<?php echo $guitar->id ?>/new" method="post">
                <table>
                    <tr>
                        <td style="vertical-align: top;">
                            Post: </td><td><textarea name="body" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
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
            </td>
        </tr>
    </table>
    </div>

    </body>
</html>
