<?php

namespace Rezzza\Formulate;

/**
 * Token
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Token
{
    public $datas = array();

    /**
     * @param string $key   key
     * @param mixed  $value value
     *
     * @return Token
     */
    public function __set($key, $value)
    {
        $this->datas[$key] = $value;
        return $this;
    }
}
