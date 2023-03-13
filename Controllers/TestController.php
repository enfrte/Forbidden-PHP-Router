<?php 

namespace Controllers;

class TestController 
{
	public function index()
	{
		echo 'test->index';
	}

	public function test($foo)
	{
		echo 'test says '.$foo;
	}
}
