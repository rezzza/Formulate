<?php

namespace Rezzza\Formulate\TokenCollector;

use Rezzza\Formulate\ParameterBag;
use Rezzza\Formulate\Renderer\FormulaRendererInterface;

/**
 * TokenCollectorInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface TokenCollectorInterface
{
	/**
	 * @param ParameterBag $parameterBag parameterBag
	 */
	public function addParameterBag(ParameterBag $parameterBag);

	/**
	 * @param string $key   key
	 * @param mixed $value value
	 */
	public function set($key, $value);

	/**
	 * @return string
	 */
	public function getGlobals();

	/**
	 * @param FormulaRendererInterface $renderer renderer
	 *
	 * @return TokenCollector
	 */
	public function build(FormulaRendererInterface $renderer);
}
