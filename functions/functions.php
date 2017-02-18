<?php

/** Function to clean data by user
* @param $data
* @return string
*/
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/** Function to convert date format
 * @param $date
 * @param null $type
 * @return string
 */
function convertDate($date, $type = null) {
    setlocale(LC_TIME, 'Spanish');
    if (isset($type)) {
        if ($type == 1)
            return strftime('%d-%m-%Y', strtotime($date)); //20-05-2016
        elseif ($type == 2)
            return strftime('%d/%m/%Y', strtotime($date)); //20/05/2016
        elseif ($type == 3)
            return strftime('%d-%b-%Y', strtotime($date)); //20-may.-2016
        elseif ($type == 4)
            return strftime('%d de %B del %Y', strtotime($date)); //20 de mayo del 2016
        else
            return strftime('%d - %B - %Y', strtotime($date)); //20 - mayo - 2016
    } else {
        return strftime('%d - %b - %Y', strtotime($date)); //20 - may. - 2016
    }
}

/** Function to convert datetime format
 * @param $datetime
 * @param null $type
 * @return string
 */
function convertDateTime($datetime, $type = null) {
    if (isset($type)) {
        if ($type == 2)
            return strftime('%d-%b-%Y %H:%M:%S', strtotime($datetime)); //08-jul.-2016 00:10:59
    } else {
        return strftime('%d-%m-%Y %H:%M:%S', strtotime($datetime)); //08-07-2016 00:10:59
    }
}

/* Function to convert hour type */
function convertHourMeridiem($hour) {
    return date('g:i a', strtotime($hour));
}

/** Function to convert date/datetime to info string
 * @param $date
 * @return int|string
 */
function convertLastVisitDate($date) {
    date_default_timezone_set('America/Lima');
    $today = time();
    $date = strtotime($date);
    $interval = floor(($today - $date) / 86400);
    if ($interval == 0) {
        if (date('d', $date) == date('d', $today)) $out = 'Hoy';
        else $out = 'Ayer';
    } elseif ($interval >= 1 && $interval < 7) {
        $str = '-' . $interval . 'days';
        $testTime = strtotime($str, $today);
        if (date('d', $date) == date('d', $testTime)) {
            if ($interval == 1) $out = 'Ayer';
            else $out = 'Hace ' . $interval . ' días';
        } else $out = 'Hace ' . ($interval+1) . ' días';
    } elseif ($interval >= 7 && $interval <= 14) {
        $var = ceil($interval / 7);
        $out = 'Hace ' . $var . ($var > 1 ? ' semanas' : ' semana');
    } else {
        $out = date('d-m-Y (h:i a)', $date);
    }
    return $out;
}