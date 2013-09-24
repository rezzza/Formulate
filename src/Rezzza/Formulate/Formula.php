<?php

namespace Rezzza\Formulate;

use Rezzza\Formulate\Renderer\FormulaRendererInterface;
use Rezzza\Formulate\Renderer\StrtrFormulaRenderer;
use Rezzza\Formulate\Parser\Parser;
use Rezzza\Formulate\Parser\ParserInterface;
use Rezzza\Formulate\TokenCollector\TokenCollector;
use Rezzza\Formulate\TokenCollector\TokenCollectorInterface;

/**
 * Formula
 *
 * @package Formulate
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Formula
{
    public $formula;
    private $isCalculable = false;
    private $parameterBag;
    private $parser;
    private $renderer;
    private $subFormulas = array();
    private $tokenCollector;

    CONST CALCULABLE = true;
    CONST NOT_CALCULABLE = false;

    /**
     * @param string $formula formula
     */
    public function __construct($formula, $isCalculable = self::NOT_CALCULABLE)
    {
        $this->formula      = (string) $formula;
        $this->parameterBag = new ParameterBag();
        $this->setIsCalculable($isCalculable);
    }

    /**
     * Build the formula with his subformulas and render it
     *
     * @return string
     */
    public function render()
    {
        return $this->getRenderer()
            ->render($this, $this->parse());
    }

    /**
     * Parse formula and theses subforumlas
     */
    public function parse()
    {
        $parser = $this->getParser();
        $parser->parse($this);

        return $parser->getTokenCollector()
            ->build($this->getRenderer());
    }

    /**
     * @param string  $ident   ident
     * @param Formula $formula formula
     */
    public function setSubFormula($ident, Formula $formula)
    {
        $this->subFormulas[$ident] = $formula;
    }

    /**
     * @return array
     */
    public function getSubFormulas()
    {
        return $this->subFormulas;
    }

    /**
     * @return Formula
     */
    public function getSubFormula($key)
    {
        return $this->subFormulas[$key];
    }

    /**
     * @param FormulaRendererInterface $renderer  renderer
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
            $this->setRenderer(new StrtrFormulaRenderer());
        }

        return $this->renderer;
    }

    /**
     * @return array
     */
    public function getReplacements()
    {
        return $this->getRenderer()->getReplacements($this);
    }

    /**
     * @param TokenCollectorInterface $tokenCollector tokenCollector
     */
    public function setTokenCollector(TokenCollectorInterface $tokenCollector)
    {
        $this->tokenCollector = $tokenCollector;
    }

    /**
     * @return TokenCollector
     */
    public function getTokenCollector()
    {
        if (null === $this->tokenCollector) {
            $this->setTokenCollector(new TokenCollector());
        }

        return $this->tokenCollector;
    }

    /**
     * @param ParserInterface $parser parser
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return Parser
     */
    public function getParser()
    {
        if (null === $this->parser) {
            $this->setParser(new Parser($this->getTokenCollector()));
        }

        return $this->parser;
    }

    /**
     * @param string $key   key
     * @param mixed $value value
     *
     * @return Formula
     */
    public function setParameter($key, $value)
    {
        $this->parameterBag->set($key, $value);

        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function getParameterBag()
    {
        return $this->parameterBag;
    }

    /**
     * @param boolean $isCalculable isCalculable
     */
    public function setIsCalculable($isCalculable)
    {
        $this->isCalculable = (bool) $isCalculable;
    }

    /**
     * @return boolean
     */
    public function isCalculable()
    {
        return $this->isCalculable;
    }

}
