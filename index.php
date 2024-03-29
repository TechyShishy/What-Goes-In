<?xml version="1.0" encoding="UTF-8" standalone="no" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/default.css" title="default" type="text/css" />
    </head>
    <body>
        <form action="" method="GET">
            <label for="file">File:</label>
            <select id="file" name="file">
<?php

	echo '<option value="" selected="selected"> -- Select -- </option>';

	$files = new DirectoryIterator ( ini_get('xdebug.trace_output_dir') );
	foreach ( $files as $file ) {

		if (substr_count ( $file->getFilename (), '.xt' ) == 0 || in_array($config['directory'] . '/' . $file->getFilename(), $ownTraces)) {
			continue;
		}

		$date = explode ( '.', $file->getFilename () );
		$date = date ( 'Y-m-d H:i:s', $date [0] );

		echo '<option value="' . $file->getFilename () . '"> ' . $date . ' - ' . $file->getFilename () . ' </option>';
	}
?>
            </select>
            <input type="submit" />
        </form>
<?php
if(isset($_GET['file']))
{
?>
        <div id="function-tree">
            <ol>
                <li>
<?php
    include_once('Classes/TraceFile.php');
    $file = new TraceFile(realpath(ini_get('xdebug.trace_output_dir').$_GET['file']));
    $main = $file->get_main();
    echo $main->do_print();
?>
                </li>
            </ol>
        </div>
<?php
}
else
{
    echo '<p class="help-text">Select a file above to begin</p>';
}
/*?>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jstree/vakata.js"></script>
        <script type="text/javascript" src="js/jstree/jstree.core.js"></script>
        <script type="text/javascript" src="js/jstree/jstree.ui.js"></script>
        <script type="text/javascript" src="js/jstree/jstree.themes.js"></script>
        <script type="text/javascript" src="js/jstree/jstree.html.js"></script>
<?php // Purely so that the themes plugin can auto-detect its load location ?>
        <script type="text/javascript" src="js/jstree/jquery.jstree.js"></script>
        <script type="text/javascript">
            $(function(){
                $('#function-tree').jstree({plugins:["ui","themes","html_data"]});
            });
        </script>
*/?>
    </body>
</html>
