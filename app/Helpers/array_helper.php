<?php 

// Codeigniter 4 array validation leaves the key of the errors arrays with '.*'
// In order to not have problems with jQuery validation, we use this function to remove '.*'
function array_replace_key(Array $search, $replace, Array $subject) 
{
    $updatedArray = [];

    foreach($search as $val):

        foreach ($subject as $key => $value):

            // if ( ! is_array($value) && strpos($key, $val)):
                $newkey = str_replace($val, $replace, $key);
                $updatedArray = array_merge($updatedArray, [$newkey => $value]);
               //  continue;
            // endif;

            // $updatedArray = array_merge($updatedArray, [$key => $value]);

        endforeach;

    endforeach;

    return $updatedArray;
}