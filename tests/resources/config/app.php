<?php
return [
	'name' => env('APP_NAME', 'Simpl Config Example'),
	'author' => env('AUTHOR'),
	'debug' => env('DEBUG', false),
	'environment' => env('APP_ENV', 'default'),
	'should-be-false' => env('BOOL_FALSE'),
	'captain' => env('CAPTAIN', 'Picard'),
];