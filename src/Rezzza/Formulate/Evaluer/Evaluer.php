<?php

namespace Rezzza\Formulate\Evaluer;

/**
 * HoaMathEvaluer
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Evaluer
{
    private static $evaluer;

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
