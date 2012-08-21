<?php

namespace tests\units\Rezzza\Formulate\Renderer;

require_once __DIR__ . '/../../../../../vendor/autoload.php';

use mageekguy\atoum;
use Rezzza\Formulate\Token;
use Rezzza\Formulate\Formula as Formula;

/**
 * AbstractFormulaRenderer
 *
 * @uses atoum\test
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AbstractFormulaRenderer extends atoum\test
{
    public function testPrepare()
    {
        $formula = '{{ var}} {{var}}   {{  var             }}';

        $this->getRendererMock()->prepare($formula);

        $this->string($formula)
            ->isEqualTo('{{var}} {{var}}   {{var}}');
    }

    /**
     * @return \Mock\AbstractFormulaRenderer
     */
    public function getRendererMock()
    {
        $this->mockClass('Rezzza\Formulate\Renderer\AbstractFormulaRenderer', '\Mock');
        return new \Mock\AbstractFormulaRenderer();
    }
}
