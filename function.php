<?php

function testFunction($argument)
{
	if (empty($argument['text'])) return '@GET parameter "text" empty!';
	return $argument['text'];
}

?>
