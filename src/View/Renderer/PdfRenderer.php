<?php
namespace Webowy\Pdf\View\Renderer;

use Webowy\Pdf\View\Model\PdfModel;
use Webowy\Pdf\View\Renderer\Engine\EngineInterface;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;

/**
 * Class PdfRenderer
 * @package Webowy\Pdf\View\Renderer
 */
class PdfRenderer implements Renderer
{
    /**
     * @var EngineInterface
     */
    protected $engine;

    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * @var Renderer
     */
    protected $htmlRenderer;

    /**
     * @param Renderer $renderer
     * @return $this
     */
    public function setHtmlRenderer(Renderer $renderer)
    {
        $this->htmlRenderer = $renderer;
        return $this;
    }

    /**
     * @return Renderer
     */
    public function getHtmlRenderer()
    {
        return $this->htmlRenderer;
    }

    /**
     * @param EngineInterface $engine
     * @return $this
     */
    public function setEngine(EngineInterface $engine)
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return EngineInterface
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Renders values as a PDF
     *
     * @param  string|PdfModel $nameOrModel The script/resource process, or a view model
     * @param  null|array|\ArrayAccess Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        $html = $this->getHtmlRenderer()->render($nameOrModel, $values);

        $author = $nameOrModel->getOption('author');
        $title = $nameOrModel->getOption('title');
        $subject = $nameOrModel->getOption('subject');
        $keywords = $nameOrModel->getOption('keywords');
        $pageOrientation = $nameOrModel->getOption('pageOrientation');
        $pageUnit = $nameOrModel->getOption('pageUnit');
        $pageFormat = $nameOrModel->getOption('pageFormat');
        $attachments = $nameOrModel->getOption('attachments');

        $pdf = $this->getEngine();
        $pdf->setAuthor($author);
        $pdf->setTitle($title);
        $pdf->setSubject($subject);
        $pdf->setKeywords($keywords);

        if ($pageOrientation) {
            $pdf->setPageOrientation($pageOrientation);
        }

        if ($pageUnit) {
            $pdf->setPageUnit($pageUnit);
        }

        if ($pageFormat) {
            $pdf->setPageFormat($pageFormat);
        }

        $pdf->loadHTML($html);

        $output = $pdf->output();

        if ($attachments) {
            $pdfMerger = new \Webowy\Pdf\Merger();
            $pdfMerger->loadFromString($output);

            foreach ($attachments as $attachment) {
                $pdfMerger->loadFromFile($attachment);
            }

            $output = $pdfMerger->output();
        }

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;
        return $this;
    }
}
