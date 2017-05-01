<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
	protected $graph_size       = 0;
	protected $lookups          = 0;
	protected $solution         = null;
	protected $prevalence_score = 0;
	protected $set_size         = 0;
	
	public function __construct($graph_size, $lookups, $solver_solution)
	{
		$this->graph_size       = $graph_size;
		$this->lookups          = $lookups;
		$this->solution         = $this->objectify($solver_solution->solution);
		$this->prevalence_score = $solver_solution->prevalence_score;
		$this->set_size         = $solver_solution->set_size;
	}
	
	public function graphSize()
	{
		return $this->graph_size;
	}
	
	public function lookups()
	{
		return $this->lookups;
	}
	
	public function solution()
	{
		return $this->solution;
	}
	
	public function prevalenceScore()
	{
		return $this->prevalence_score;
	}
	
	public function setSize()
	{
		return $this->set_size;
	}
	
	protected static function objectify($solution)
	{
		$return = array();
		
		if(!is_array($solution))
		{
			throw Exception('\$solution is not an array');
		}
		else
			foreach($solution as $e)
		{
			$return[] = new Word($e['value'], $e['glossary']);
		}
		
		return $return;
	}
}

