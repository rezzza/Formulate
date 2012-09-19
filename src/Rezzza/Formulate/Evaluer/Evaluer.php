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
            //$grammar = 'hoa://Library/Math/Arithmetic/Grammar.pp';
            $grammar = realpath(__DIR__.'/../../../../../../hoa/math/Arithmetic/Grammar.pp');

            if (!$grammar) {
                $grammar = realpath(__DIR__.'/../../../../vendor/hoa/math/Arithmetic/Grammar.pp');

                if (!$grammar) {
                    throw new \Exception('Path to \Hoa\Math\Arithmetic\Grammar is corrupted');
                }
            }

            static::$compiler = \Hoa\Compiler\Llk::load(
                new \Hoa\File\Read($grammar)
            );
        }

        return static::$compiler;
    }

    /**
     * @return \Hoa\Math\Evaluer\Evaluer
     */
    static public function getEvaluer()
    {
        if (!self::$evaluer) {
            from('Hoa')->import('Math.Evaluer.~');

            static::$evaluer = new \Hoa\Math\Evaluer\Evaluer();
        }

        return static::$evaluer;
    }
}
