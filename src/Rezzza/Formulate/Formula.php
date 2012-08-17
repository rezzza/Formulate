<?php

namespace Rezzza\Formulate;

use Rezzza\Formulate\Renderer\FormulaRendererInterface;
use Rezzza\Formulate\Renderer\StrtrFormulaRenderer;

/**
 * Formula
 *
 * @package Formulate
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Formula
{
    public $formula;
    private $renderer;
    private $token;
    private $subFormulas = array();

    /**
     * @param string $formula formula
     */
    public function __construct($formula)
    {
        $this->formula = (string) $formula;
    }

    /**
     * Build the formula with his subformulas and render it
     *
     * @return string
     */
    public function render()
    {
        return $this->renderer->render($this);
    }

    /**
     * @param string  $ident   ident
     * @param Formula $formula formula
     */
    public function setSubFormula($ident, Formula $formula)
    {
        $this->subFormulas[(string) $ident] = $formula;
    }

    /**
     * @return array
     */
    public function getSubFormulas()
    {
        return $this->subFormulas;
    }

    /**
     * @param FormulaRendererInterface $renderer renderer
     */
    public function setRenderer(FormulaRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return FormulaRendererInterface
     */
    public function getRenderer()
    {
        if (null === $this->renderer) {
            $this->renderer = new StrtrFormulaRenderer();
        }

        return $this->renderer;
    }

    /**
     * @param Token $token token
     *
     * @return Formula
     */
    public function setToken(Token $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }
}
