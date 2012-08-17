<?php

namespace Rezzza\Formulate\Renderer;

use Rezzza\Formulate\Formula;

/**
 * FormulaRendererInterface
 *
 * @package Formulate
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface FormulaRendererInterface
{
    /**
     * render the formula
     *
     * @param Token $token token
     *
     * @return string
     */
    public function render(Formula $formula);
}
