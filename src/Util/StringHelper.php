<?php
/**
 * AVOLUTIONS
 *
 * Just another open source PHP framework.
 *
 * @copyright	Copyright (c) 2019 - 2021 AVOLUTIONS
 * @license     MIT License (http://avolutions.org/license)
 * @link		http://avolutions.org
 */

namespace Avolutions\Util;

/**
 * StringHelper class
 *
 * Provides helper methods to handle strings.
 *
 * @author	Alexander Vogt <alexander.vogt@avolutions.org>
 * @since	0.6.0
 */
class StringHelper
{
    /**
     * interpolate
     *
     * Replaces placeholders in a string with given values.
     *
     * @param string $string String with placeholders.
     * @param array $params An array with values to replace the placeholders with.
     *
     * @return string String with replaces values.
     */
    public static function interpolate($string, $params = [])
    {
        if (is_array($params) && count($params) > 0) {
            foreach ($params as $paramKey => $paramValue) {
                $string = str_replace('{'.$paramKey.'}', $paramValue, $string);
            }
        }

        return $string;
    }
}