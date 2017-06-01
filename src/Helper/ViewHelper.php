<?php

namespace Antevenio\Helper;

/**
 * @author karlozz157
 */
class ViewHelper
{
    /**
     * @param string $filename
     * @param array  $data
     *
     * @return void
     */
    public static function load($filename = '', array $data = [])
    {
        $path = self::getPathOfViewsFolder();
        $file = $path . '/' . $filename;

        if (!file_exists($file)) {
            throw new \Exception(sprintf('The %s not found', $filename));
        }

        $data;
        require $file;
    }

    /**
     * @return string
     */
    public static function getPathOfViewsFolder()
    {
        return __DIR__ . '/../views';
    }
}
