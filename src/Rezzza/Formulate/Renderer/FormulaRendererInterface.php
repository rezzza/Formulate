<?php

namespace Rezzza\Formulate\Renderer;

use Rezzza\Formulate\Formula;
use Rezzza\Formulate\TokenCollector\TokenCollectorInterface;

/**
 * FormulaRendererInterface
 *
 * @package Formulate
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface FormulaRendererInterface
{
    /**
     * @param Formula                 $formula        formula
     * @param TokenCollectorInterface $tokenCollector tokenCollector
     *
     * @return string
     */
    public function render(Formula $formula, TokenCollectorInterface $tokenCollector);
}
