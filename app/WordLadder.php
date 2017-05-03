<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


define('DATAFILE_PREFIX', __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
define('DATAFILE_POSTFIX', '-letters');
define('DATAFILE_EXTENSION', '.json');

class WordLadder extends Model
{
    public static function solve($start, $finish, $steps = null, $first = false)
    {
        $return         = false;
        $word_size      = strlen($start);
        $proc_PREFIX    = DATAFILE_PREFIX . $word_size . DATAFILE_POSTFIX;
        $words_dir_proc = $proc_PREFIX . DATAFILE_EXTENSION;
        
        if (!file_exists($words_dir_proc)) {
            throw new Exception('Cannot find relevant data file.');
        } else {
            $words_dir = json_decode(file_get_contents($words_dir_proc), true);
            
            if (!isset($words_dir[$start])) {
                throw new Exception('Could not find ' . $start . ' in dictionary.');
            } else if (!isset($words_dir[$finish])) {
                throw new Exception('Could not find ' . $finish . ' in dictionary.');
            } else {
                $start_data =& $words_dir[$start];
                
                $group        = $start_data['group'];
                $start_index  = $start_data['index'];
                $finish_index = $words_dir[$finish]['index'];
                
                if ($group !== $words_dir[$finish]['group']) {
                    throw new Exception('Unsolvable; ' . $start . ' and ' . $finish . ' are not connected.');
                } else {
                    $words_proc = $proc_PREFIX . DIRECTORY_SEPARATOR . $group . DATAFILE_EXTENSION;
                    
                    if (!file_exists($words_proc)) {
                        throw new Exception('Cannot find relevant data file.');
                    } else {
                        $words = json_decode(file_get_contents($words_proc), true);
                        
                        $lookups  = 0;
                        $solver   = new Solver\AStar($words, $lookups, $word_size, $start_index, $finish_index, $steps);
                        $solution = $solver->solve($first);
                        
                        if ($solution === false) {
                            throw new Exception('FAIL.');
                        } else {
                            $return = new Solution(count($words), $lookups, $solution);
                        }
                    }
                }
            }
        }
        
        return $return;
    }
}
