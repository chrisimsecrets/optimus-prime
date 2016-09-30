<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Optimus Prime</title>
    <link rel="stylesheet" href="public/css/csshake.min.css">
    <link rel="stylesheet" href="public/build/css/app-df275f5361.css">
</head>
<body>
<div align="center" style="padding-top: 150px">
    <div class="shake shake-constant" align="center">
        <img src="public/images/optimus/social/logomin.png"><br>

    </div>
    <h1>Optimus Prime</h1>
    <a href="public" class="shake btn btn-lg btn-default"><i class="fa fa-key"></i> Login </a>
    <?php
    if (extension_loaded('sqlite3')) {
        echo '<br><span class="label label-success">Status Ok</span>';
    } else {
        echo '<br><span class="label label-danger">Sqlite Not support in this server</span>';
    }
    ?>
</div>
</body>
</html>