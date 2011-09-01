<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="GET">
            <label for="file">File:</label>
            <input id="file" name="file" type="text" />
            <input type="submit" />
        </form>
<?php
if(isset($_GET['file']))
{
    include_once('Classes/TraceFile.php');
    $file = new TraceFile($_GET['file']);
    $main = $file->get_main();
    echo $main->do_print();
}
else
{
    echo '<p class="help-text">Select a file above to begin</p>';
}
?>
    </body>
</html>