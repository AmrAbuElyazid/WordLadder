<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\WordLadder;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('calculate', function(Request $request) {
	$start  = $request->get('start');
	$finish = $request->get('finish');

	try
	{
		$solution = WordLadder::solve($start, $finish);
		$solutions = $solution->solution();
		$words = [];
		foreach($solutions as $e)
		{
			$words[] = $e->word();
		}
		return $words;
	}
	catch(Exception $e)
	{
		die('Error: ' . $e->getMessage() . "\n");
	}
});