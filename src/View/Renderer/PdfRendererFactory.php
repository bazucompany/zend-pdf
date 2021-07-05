<?php
namespace Webowy\Pdf\View\Renderer;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class PdfRendererFactory
 * @package Webowy\Pdf\View\Renderer
 */
class PdfRendererFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     * @return PdfRenderer
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $viewManager = $container->get('ViewManager');

        $pdfRenderer = new PdfRenderer();
        $pdfRenderer->setResolver($viewManager->getResolver());
        $pdfRenderer->setHtmlRenderer($viewManager->getRenderer());
        $pdfRenderer->setEngine($container->get('PDF'));

        return $pdfRenderer;
    }
}
