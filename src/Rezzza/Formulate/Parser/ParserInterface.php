<?php

namespace Rezzza\Formulate\Parser;

use Rezzza\Formulate\TokenCollector\TokenCollectorInterface;
use Rezzza\Formulate\Formula;

/**
 * ParserInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface ParserInterface
{
	/**
	 * @param TokenCollectorInterface $tokenCollector tokenCollector
	 */
	public function __construct(TokenCollectorInterface $tokenCollector);

	/**
	 * @param Formula $formula formula
	 */
	public function parse(Formula $formula);

	/**
	 * @return TokenCollector
	 */
	public function getTokenCollector();
}
