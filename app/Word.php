<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
	protected $word;
	protected $definition;
	
	public function __construct($word, $definition)
	{
		$this->word       = $word;
		$this->definition = $definition;
	}
	
	public function word()
	{
		return $this->word;
	}
	
	public function definition()
	{
		return $this->definition;
	}
}
