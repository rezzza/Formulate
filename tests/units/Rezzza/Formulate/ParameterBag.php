<?php

namespace tests\units\Rezzza\Formulate;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use mageekguy\atoum;
use Rezzza\Formulate\ParameterBag as ParameterBagModel;

/**
 * ParameterBag
 *
 * @uses atoum\test
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class ParameterBag extends atoum\test
{
    public function testSetter()
    {
        $bag = new ParameterBagModel();

        $this->array($bag->datas)
            ->isEqualTo(array());

        $bag->set('foo', 'bar');
        $bag->set('jm', 'squirrel');

        $this->array($bag->datas)
            ->isEqualTo(array(
                'foo' => 'bar',
                'jm'  => 'squirrel',
            ));

        unset($bag->datas['foo']);

        $this->array($bag->datas)
            ->isEqualTo(array(
                'jm'  => 'squirrel',
            ));
    }
}
