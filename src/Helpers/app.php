<?php
/**
 * Helper functions
 */

/**
 * Change plain number to french formatted currency
 *
 * @param $number
 * @param $currency
 */
function formatNumberInFrench($number)
{
    return number_format($number, 2, ',', ' ');
}
