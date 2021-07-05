<?php
namespace Webowy\Pdf\View\Strategy;

use Webowy\Pdf\View\Model;
use Webowy\Pdf\View\Renderer\PdfRenderer;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\ViewEvent;

/**
 * Class PdfStrategy
 * @package Webowy\Pdf\View\Strategy
 */
class PdfStrategy extends AbstractListenerAggregate
{
    /**
     * @var PdfRenderer
     */
    protected $renderer;

    /**
     * @param PdfRenderer $renderer
     */
    public function __construct(PdfRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Attach the aggregate to the specified event manager
     *
     * @param  EventManagerInterface $events
     * @param  int $priority
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    /**
     * Detect if we should use the PdfRenderer based on model type
     *
     * @param  ViewEvent $e
     * @return void|PdfRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if ($model instanceof Model\PdfModel) {
            return $this->renderer;
        }

        return;
    }

    /**
     * Inject the response with the PDF payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        $result = $e->getResult();

        if (!is_string($result)) {
            // @todo Potentially throw an exception here since we should *always* get back a result.
            return;
        }

        $response = $e->getResponse();
        $response->setContent($result);
        $response->getHeaders()->addHeaderLine('content-type', 'application/pdf');

        $fileName = $e->getModel()->getOption('filename');
        if (isset($fileName)) {
            if (substr($fileName, -4) != '.pdf') {
                $fileName .= '.pdf';
            }

            $response->getHeaders()->addHeaderLine(
                'Content-Disposition',
                'attachment; filename=' . $fileName
            );
        }
    }
}
