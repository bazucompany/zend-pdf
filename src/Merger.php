<?php
namespace Webowy\Pdf;

/**
 * Class Merger
 * @package Webowy\Pdf
 */
class Merger
{
    /**
     * @var \ZendPdf\PdfDocument
     */
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new \ZendPdf\PdfDocument();
    }

    /**
     * @param $string
     */
    public function loadFromString($string)
    {
        $pdf = \ZendPdf\PdfDocument::parse($string);

        foreach ($pdf->pages as $page) {
            $this->pdf->pages[] = clone $page;
        }
    }

    /**
     * @param $file
     */
    public function loadFromFile($file)
    {
        if (file_exists($file)) {
            $pdf = \ZendPdf\PdfDocument::load($file);

            foreach ($pdf->pages as $page) {
                $this->pdf->pages[] = clone $page;
            }
        }
    }

    /**
     * @param null $fileName
     * @return void|string
     */
    public function output($fileName = null)
    {
        if ($fileName !== null) {
            $this->pdf->save($fileName);
            return;
        }

        return $this->pdf->render();
    }
}
