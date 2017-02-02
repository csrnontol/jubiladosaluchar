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

/** Function to convert date type
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
        else
            return strftime('%d - %B - %Y', strtotime($date)); //20 - mayo - 2016
    } else {
        return strftime('%d - %b - %Y', strtotime($date)); //20 - may. - 2016
    }
}

/** Function to convert datetime type
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