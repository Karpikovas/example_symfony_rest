<?php

/*
  Generate cookie
*/
//$bytes = random_bytes(25);
//var_dump(bin2hex($bytes));
//

/*
  Generate hash
*/

//$password = 'root';
//$hash = password_hash($password, PASSWORD_BCRYPT );
//
//$flag = password_verify($password, $hash);
//
//var_dump($hash);

$exp_date = date("Y-m-d H:i:s", strtotime("+1 hours"));

var_dump($exp_date);