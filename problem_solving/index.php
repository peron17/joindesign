<?php
// e.g : aaabccddd
echo 'Sample Input 0 : '.stringReducer('aaabccddd').'<br>';
echo 'Sample Input 1 : '.stringReducer('aa').'<br>';
echo 'Sample Input 2 : '.stringReducer('baab').'<br>';

function stringReducer($s) {
    $len = strlen($s);
    $r = '';

    // sorting
    $split = str_split($s);
    sort($split);
    $s = implode('', $split);
    
    if ($len >= 1 && $len <= 100) {
        $r = check($s, '');
    }

    return $len == '' ? '' : $r;
}

function check($c, $hasil) {
    
    if ( strlen($c) > 1 ) {
        // get first character
        $a = substr($c, 0, 1);
        $b = substr($c, 1, 1);
 
        if ($a == $b) {
            $c = substr($c, 2, strlen($c));
            return check($c, $hasil);
        } else {
            $hasil .= $a;
            $c = substr($c, 1, strlen($c));
            return check($c, $hasil);
        }
    } else { // if only one left
        $hasil .= $c;
    }
    
    return $hasil;
}