<?php

include 'function.php'; // Load functions
// If the first letter of the return value is "@", it will be output as an error. If # - output the answer without quotes


// Then my sex code, you like it, right? :*
$title = '<title>Api</title>'; // Title
$version = '0.1'; // version API
$command = $_GET['command']; // Function
$blocked = array('0', 'sqlEscape', 'sqlGet', 'sqlEdit', 'sqlNew', 'sqlDelete'); // Blocked user functions for call
unset($_GET['command']);
$param = json_encode($_GET, JSON_UNESCAPED_UNICODE); // parameters in JSON format

/*CHECKS*/
if (empty($command)) die('{ "error": "empty query", "parameters": ' . $param . ', "version": "' . $version . '", "title": "' . $title . '", "time": "' . time() . '"');
if (!empty(array_search($command, $blocked)) or !function_exists($command)) die('{ "error": "unknown command", "parameters": ' . $param . ', "version": "' . $version . '", "title": "' . $title . '", "time": "' . time() . '"}');
/*CHECKS*/


$arg = null;
foreach ($_GET as $key => $value) if ($key != 'command') $arg[$key] = $value;
$response = call_user_func($command, $arg);

if ($response[0] == '@')
    die('{ "error": "' . mb_substr($response, 1) . '", "parameters": ' . $param . ', "version": "' . $version . '",  "title": "' . $title . '", "time": "' . time() . '"');
elseif ($response[0] == '#')
    die('{ "response": ' . mb_substr($response, 1) . ', "parameters": ' . $param . ', "version": "' . $version . '",  "title": "' . $title . '", "time": "' . time() . '"');
else
    die('{ "response": "' . $response . '", "parameters": ' . $param . ', "version": "' . $version . '", "title": "' . $title . '", "time": "' . time() . '"');
