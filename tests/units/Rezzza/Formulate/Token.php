<?php

namespace tests\units\Rezzza\Formulate;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use mageekguy\atoum;
use Rezzza\Formulate\Token as TokenModel;

/**
 * Token
 *
 * @uses atoum\test
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Token extends atoum\test
{
    public function testSetter()
    {
        $token = new TokenModel();

        $this->array($token->datas)
            ->isEqualTo(array());

        $token->foo = 'bar';
        $token->jm  = 'squirrel';

        $this->array($token->datas)
            ->isEqualTo(array(
                'foo' => 'bar',
                'jm'  => 'squirrel',
            ));

        unset($token->datas['foo']);

        $this->array($token->datas)
            ->isEqualTo(array(
                'jm'  => 'squirrel',
            ));
    }
}
