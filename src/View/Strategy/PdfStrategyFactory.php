<?php
namespace Webowy\Pdf\View\Strategy;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class PdfStrategyFactory
 * @package Webowy\Pdf\View\Strategy
 */
class PdfStrategyFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     * @return PdfStrategy
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $pdfRenderer = $container->get('ViewPdfRenderer');

        return new PdfStrategy($pdfRenderer);
    }
}
