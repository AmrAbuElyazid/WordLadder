<?php

namespace App\Solver;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
	public $solution         = null;
	public $prevalence_score = 0;
	public $set_size         = 0;
	
	public function __construct($solution, $prevalence_score, $set_size)
	{
		$this->solution         = $solution;
		$this->prevalence_score = $prevalence_score;
		$this->set_size         = $set_size;
	}
}
