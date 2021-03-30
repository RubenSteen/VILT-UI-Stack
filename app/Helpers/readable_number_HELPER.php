<?php

if (! function_exists('readable_number')) {
    function readable_number($number, $discharge = 0, $fractional = null, $fractional_count = 1)
    {
        $int_number = intval($number);

        if ($int_number > 999) {
            $num = substr($int_number, 0, strlen($int_number) - 3);
            $discharge++;
            $fractional = substr($int_number, strlen($int_number) - 3);

            return readable_number($num, $discharge, $fractional, $fractional_count);
        }

        return $int_number . getFractional($fractional, $fractional_count) . getDischargeString($discharge);
    }
}

if (! function_exists('getDischargeString')) {
    function getDischargeString($discharge)
    {
        $discharges = ['K', 'M', 'B', 'T'];
        return $discharge ? $discharges[$discharge - 1] : '';
    }
}

if (! function_exists('getFractional')) {
    function getFractional($fractional, $fractional_count)
    {
        return $fractional ? ',' . substr($fractional, 0, $fractional_count) : '';
    }
}
