<?php

namespace Rezzza\Formulate\Parser;

use Rezzza\Formulate\TokenCollector\TokenCollectorInterface;
use Rezzza\Formulate\Formula;

/**
 * Parser
 *
 * @uses ParserInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Parser implements ParserInterface
{
	/**
	 * @{inheritdoc}
	 */
	public function __construct(TokenCollectorInterface $tokenCollector)
	{
		$this->tokenCollector = $tokenCollector;
	}

	/**
	 * @{inheritdoc}
	 */
	public function parse(Formula $formula)
	{
		$this->tokenCollector->addParameterBag($formula->getParameterBag());

		foreach ($formula->getSubFormulas() as $key => $subformula) {
			$this->tokenCollector->set($key, $subformula->formula);

			$this->parse($subformula);
		}
	}

	/**
	 * @{inheritdoc}
	 */
	public function getTokenCollector()
	{
		return $this->tokenCollector;
	}
}
