<?php
DEFINE ('DB_USER', 'reimsysUser');
DEFINE ('DB_PASSWORD', 'reimbsysPass');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'reimbursement');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
mysqli_connect_error());
?>