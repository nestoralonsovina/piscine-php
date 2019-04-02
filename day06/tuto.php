<?php

class Example {
	public $foo = 0; // constants cannot be equal to calculations or functions;

	function __constructor() {
		print("Constructor called");
	}

	function __destructor() {
		print("Destructor called");
	}

	function bar() {
		print("hey boy");
	}
}
