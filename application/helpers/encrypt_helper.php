<?php

function encryption($string)
{
	return bin2hex(base64_encode($string));
}

function decryption($string)
{
	return base64_decode(hex2bin(($string)));
}