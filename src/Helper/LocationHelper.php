<?php

namespace Antevenio\Helper;

class LocationHelper
{
    /**
     * @const string
     */
    const IP_ADDRESS_UNKNOWN = 'UNKNOWN';

    /**
     * @return string
     */
    public static function getIp()
    {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if(isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if(isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = self::IP_ADDRESS_UNKNOWN;
        }

        return $ipaddress;
    }

    /**
     * @return string
     */
    public static function getGeolocation()
    {
        $ipaddress = static::getIp();

        if (self::IP_ADDRESS_UNKNOWN === $ipaddress) {
            return '';
        }

        $apiUrl = 'http://ip-api.com/json/' . $ipaddress;
        $apiContent = file_get_contents($apiUrl);
        $json = JsonHelper::decode($apiContent);

        return $json['city'] . '-' . $json['region'];
    }
}
