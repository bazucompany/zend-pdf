# webowy/zend-pdf

[![Build Status](https://travis-ci.org/webowy/zend-pdf.svg?branch=master)](https://travis-ci.org/webowy/zend-pdf)
[![Latest Stable Version](https://poser.pugx.org/webowy/zend-pdf/v/stable)](https://packagist.org/packages/webowy/zend-pdf)
[![Total Downloads](https://poser.pugx.org/webowy/zend-pdf/downloads)](https://packagist.org/packages/webowy/zend-pdf)
[![License](https://poser.pugx.org/webowy/zend-pdf/license)](https://packagist.org/packages/webowy/zend-pdf)

Provides an easy to use functionality to output PDF in Zend Framework.

## Installation

Installation of this module uses composer. For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

```sh
composer require webowy/zend-pdf
```

That's all ;-)

## Usage

Copy default configuration file `./config/pdf.global.php.dist` to Your configuration directory removing `.dist`.

In Your action instead of using ViewModel or JsonModel use `\Webowy\Pdf\View\Model\PdfModel`.

#### Available renderer engines

* DOMPDF ([webowy/zend-pdf-engine-dompdf](https://github.com/webowy/zend-pdf-engine-dompdf)) - DOMPDF Engine.

You are free to create other engines based on interface `Webowy\Pdf\View\Renderer\Engine\EngineInterface`.