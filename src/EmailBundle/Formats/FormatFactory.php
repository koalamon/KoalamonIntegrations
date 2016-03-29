<?php
/**
 * Created by PhpStorm.
 * User: nils.langner
 * Date: 26.03.16
 * Time: 22:31
 */

namespace KoalamonIntegration\EmailBundle\Formats;


class FormatFactory
{
    /**
     * @var Format[]
     */
    private $formats = [];

    public function registerFormat($name, Format $format)
    {
        $this->formats[$name] = $format;
    }

    public function hasFormat($name)
    {
        return array_key_exists($name, $this->formats);
    }

    /**
     * @param $formatName
     * return Format
     */
    public function getFormat($name)
    {
        return $this->formats[$name];
    }
}