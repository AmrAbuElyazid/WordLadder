<?php

namespace App\Solver;

use Illuminate\Database\Eloquent\Model;

class AStar extends Dijkstra
{
	public function heuristic($node)
	{
		return $this->distance($this->dest_index, $node);
	}
}
