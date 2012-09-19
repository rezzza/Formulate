<?php

namespace Rezzza\Formulate\Evaluer;

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
            from('Hoa')
                ->import('Compiler.Llk')
                ->import('File.Read')
                ;

            // cannot be used actually, issue with composer
            $grammar = 'hoa://Library/Math/Arithmetic/Grammar.pp';
            /*$grammar = realpath(__DIR__.'/../../../../vendor/hoa/math/Arithmetic/Grammar.pp');

            if (!$grammar) {
                throw new \Exception('Path to \Hoa\Math\Arithmetic\Grammar is corrupted');
            }*/

            static::$compiler = \Hoa\Compiler\Llk::load(
                new \Hoa\File\Read($grammar)
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
            from('Hoa')
                ->import('Math.Visitor.Arithmetic')
                ;

            static::$visitor = new \Hoa\Math\Visitor\Arithmetic();
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
