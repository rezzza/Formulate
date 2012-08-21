<?php

namespace tests\units\Rezzza\Formulate\Renderer;

require_once __DIR__ . '/../../../../../vendor/autoload.php';

use mageekguy\atoum;
use Rezzza\Formulate\Token;
use Rezzza\Formulate\Formula;
use Rezzza\Formulate\Renderer\StrtrFormulaRenderer as StrtrFormulaRendererModel;

/**
 * StrtrFormulaRenderer
 *
 * @uses atoum\test
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class StrtrFormulaRenderer extends atoum\test
{
    public function testSimple()
    {
        $renderer       = new StrtrFormulaRendererModel();
        $formula        = new Formula('formula');

        $this->string($renderer->render($formula, $formula->parse()))
            ->isEqualTo('formula');
    }

    public function testOneLevel()
    {
        $formula  = new Formula('{{key}} key {{value}} {{key}} {{anotherone}}');
        $formula->setParameter('key', 'VIC');
        $formula->setParameter('value', 'MCKEY');

        $renderer = new StrtrFormulaRendererModel();

        $this->string($renderer->render($formula, $formula->parse()))
            ->isEqualTo('VIC key MCKEY VIC {{anotherone}}');
    }

    public function testMultiLevel()
    {
        $formula  = new Formula('{{key}} key {{subformula2}} {{subformula1}} {{subformula2}} {{anotherone}}');
        $formula->setSubFormula('subformula1', new Formula('{{key}} and {{sf3}}'));
        $formula->setSubFormula('subformula2', new Formula('{{sf2}}'));
        $formula->setSubFormula('subformula3', new Formula('UNUSED'));
        $formula->setParameter('key', 'VIC');
        $formula->setParameter('value', 'MCKEY');
        $formula->setParameter('sf2', 'valuesf2');
        $formula->setParameter('sf3', 'valuesf3');

        $renderer = new StrtrFormulaRendererModel();

        $this->string($renderer->render($formula, $formula->parse()))
            ->isEqualTo('VIC key valuesf2 VIC and valuesf3 valuesf2 {{anotherone}}');
    }
}
