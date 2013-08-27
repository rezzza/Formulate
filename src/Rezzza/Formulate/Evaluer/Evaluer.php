<?php

namespace Rezzza\Formulate\Evaluer;

use \Hoa\Compiler\Llk;
use \Hoa\File\Read;
use \Hoa\Math\Visitor\Arithmetic;

/**
 * HoaMathEvaluer
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Evaluer
{
    /**
     * @var \Hoa\Compiler\Llk
     */
    private static $compiler;

    /**
     * @var \Hoa\Math\Visitor\Arithmetic
     */
    private static $visitor;

    /**
     * @return \Hoa\Compiler\Llk
     */
    static public function getCompiler()
    {
        if (!self::$compiler) {
            static::$compiler = Llk::load(
                new Read('hoa://Library/Math/Arithmetic.pp')
            );
        }

        return static::$compiler;
    }

    /**
     * @return \Hoa\Math\Visitor\Arithmetic
     */
    static public function getVisitor()
    {
        if (!self::$visitor) {
            static::$visitor = new Arithmetic();
        }

        return static::$visitor;
    }

    /**
     * @param string $operation operation
     *
     * @return float
     */
    static public function evaluate($operation)
    {
        return self::getVisitor()->visit(self::getCompiler()->parse($operation));
    }
}
