<?php

function generate()
{
	$alpha = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

	$str = '';
	for ($i=0; $i<16; $i++)
	{
		$x = random_int(0,35);
		$str .= $alpha[$x];
	}
	return $str;
}
