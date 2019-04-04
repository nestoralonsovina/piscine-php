<?php

interface ISpaceship
{
	function addWeapon($weapon);
}

class Spaceship
{
	private $name;
	private $size;
	private $img;
	private $hp;
	private $pp;
	private $speed;
	private $handling;
	private $shield;
	private $weapons;
}
