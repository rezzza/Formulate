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
        $formula  = new Formula('formula');
        $formula->setToken(new Token());
        $renderer = new StrtrFormulaRendererModel();

        $this->string($renderer->render($formula))
            ->isEqualTo('formula');
    }

    public function testOneLevel()
    {
        $token        = new Token();
        $token->key   = "VIC";
        $token->value = "MCKEY";

        $formula  = new Formula('{{key}} key {{value}} {{key}} {{anotherone}}');
        $formula->setToken($token);

        $renderer = new StrtrFormulaRendererModel();

        $this->string($renderer->render($formula))
            ->isEqualTo('VIC key MCKEY VIC {{anotherone}}');
    }

    public function testMultiLevel()
    {
        $token        = new Token();
        $token->key   = "VIC";
        $token->sf2   = "valuesf2";
        $token->sf3   = "valuesf3";
        $token->value = "MCKEY";

        $formula  = new Formula('{{key}} key {{subformula2}} {{subformula1}} {{subformula2}} {{anotherone}}');
        $formula->setSubFormula('subformula1', new Formula('{{key}} and {{sf3}}'));
        $formula->setSubFormula('subformula2', new Formula('{{sf2}}'));
        $formula->setSubFormula('subformula3', new Formula('UNUSED'));
        $formula->setToken($token);

        $renderer = new StrtrFormulaRendererModel();

        $this->string($renderer->render($formula))
            ->isEqualTo('VIC key valuesf2 VIC and valuesf3 valuesf2 {{anotherone}}');
    }
}
