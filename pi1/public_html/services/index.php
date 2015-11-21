<?php
session_start();

?>

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../styles/new.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <img src="../resources/smart-lock.jpg" class="img-responsive">
                        <form role="form" action="login.php" method="post">
                            <div class="form-group">
                                <label class="control-label" for="exampleInputEmail1" contenteditable="true">Identification</label>
                                <input class="form-control" name="identification" placeholder="Identification" type="text"></div>
                            <div class="form-group">
                                <label class="control-label" for="exampleInputPassword1">Password</label>
                                <input class="form-control" name="password" placeholder="Password" type="password"></div>
                            <button type="submit" name="login" class="btn btn-default">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>