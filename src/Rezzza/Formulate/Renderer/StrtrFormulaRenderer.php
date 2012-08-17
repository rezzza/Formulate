<?php

namespace Rezzza\Formulate\Renderer;

/**
 * StrtrFormulaRenderer
 *
 * @package Formulate
 * @uses AbstractFormulaRenderer
 * @uses FormulaRendererInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class StrtrFormulaRenderer extends AbstractFormulaRenderer implements FormulaRendererInterface
{
    /**
     * @param string $formulaString formulaString
     * @param array $replacements  replacements
     *
     * @return string
     */
    public function replace($formulaString, array $replacements)
    {
        return empty($replacements) ? $formulaString : strtr($formulaString, $replacements);
    }
}
