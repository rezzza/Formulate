<?php

namespace tests\units\Rezzza\Formulate;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use mageekguy\atoum;
use Rezzza\Formulate\Formula as FormulaModel;
use Rezzza\Formulate\Renderer\StrtrFormulaRenderer;

/**
 * Formula
 *
 * @uses atoum\test
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Formula extends atoum\test
{
    public function testNotCalculable()
    {
        $formula = new FormulaModel('2 + 1 + {{ sf }} - {{ sf2 }}', false);
		$formula->setRenderer(new StrtrFormulaRenderer());
		$formula->setSubFormula('sf', new FormulaModel('3*10', true));
		$formula->setSubFormula('sf2', new FormulaModel('10-{{sf3}}', false));

		$this->string($formula->render())
			->isEqualTo('2 + 1 + 30 - 10-{{sf3}}');

		$formula->setSubFormula('sf3', new FormulaModel('5-3', true));
		$formula->getSubFormula('sf2')->setIsCalculable(true);

		$this->string($formula->render())
			->isEqualTo('2 + 1 + 30 - 2');

		$formula->setIsCalculable(true);

		$this->string($formula->render())
			->isEqualTo('31');
    }
}
