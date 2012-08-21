<?php

namespace Rezzza\Formulate;

/**
 * ParameterBag
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class ParameterBag
{
    public $datas = array();

    /**
     * @param string $key   key
     * @param mixed  $value value
     *
     * @return ParameterBag
     */
    public function set($key, $value)
    {
        $this->datas[$key] = $value;

        return $this;
    }
}
