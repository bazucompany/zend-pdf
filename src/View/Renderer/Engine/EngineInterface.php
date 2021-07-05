<?php
namespace Webowy\Pdf\View\Renderer\Engine;

/**
 * Interface EngineInterface
 * @package Webowy\Pdf\View\Renderer\Engine
 */
interface EngineInterface
{
    /**
     * @param null $fileName
     * @return mixed
     */
    public function output($fileName = null);

    /**
     * @param $author
     * @return mixed
     */
    public function setAuthor($author);

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @param $subject
     * @return mixed
     */
    public function setSubject($subject);

    /**
     * @param $keywords
     * @return mixed
     */
    public function setKeywords($keywords);

    /**
     * @param $pageOrientation
     * @return mixed
     */
    public function setPageOrientation($pageOrientation);

    /**
     * @param $unit
     * @return mixed
     */
    public function setPageUnit($unit);

    /**
     * @param $format
     * @return mixed
     */
    public function setPageFormat($format);

    /**
     * @param $html
     * @return mixed
     */
    public function loadHTML($html);
}
