<?php
/**
 * Created by PhpStorm.
 * User: Finn
 * Date: 10/12/2017
 * Time: 17:51
 */

namespace App\Utils;


class TimeUtils
{
    /**
     * Converts minutes to hours and minutes e.g. 4h 30m
     *
     * @param $time
     * @return string
     */
    public static function convertToHoursAndMinutes($time)
    {
        if ($time < 1) {
            return "";
        }

        $hours = floor($time / 60);
        $minutes = $time % 60;

        $format = '';

        $format .= $hours > 0 ? '%dh ' : '';
        $format .= $minutes > 0 ? '%dm' : '';

        return $hours > 0 ? sprintf($format, $hours, $minutes) : sprintf($format, $minutes);
    }
}