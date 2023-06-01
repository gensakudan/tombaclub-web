<?php
function msg_format(string $str): string {
    $newstr = '';
    for ($i=0; $i<mb_strlen($str); $i++) {
        $newstr .= mb_substr($str, $i, 1);
        if (mb_substr($str, $i, 1) !== ' ' && $i < mb_strlen($str)-1 && mb_substr($str, $i+1, 1) !== ' ') {
            $newstr .= '&#xFEFF;';
        }
    }
    return str_replace(' ', '&nbsp;', $newstr);
}
$messages = [
    'Tomba 1 is better than Tomba 2!',
    'Tomba 2 is better than Tomba 1!',
    'Partying like it’s 1997!',
    'Don’t click the Tomba... or do. I’m not your dad.',
    'Tomba 1 lowest% is currently at 277,100 AP, 61 events found, and 57 events cleared.'
];
?>
