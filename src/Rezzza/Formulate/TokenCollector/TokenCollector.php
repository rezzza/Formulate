<?php

namespace Rezzza\Formulate\TokenCollector;

use Rezzza\Formulate\ParameterBag;
use Rezzza\Formulate\Renderer\FormulaRendererInterface;

/**
 * TokenCollector
 *
 * @uses TokenCollectorInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class TokenCollector implements TokenCollectorInterface
{
	//@todo We could use parameter bag for the formula only
	protected $globals = array();

	/**
	 * @{inheritdoc}
	 */
	public function addParameterBag(ParameterBag $parameterBag)
	{
		foreach ($parameterBag->datas as $key => $value) {
			$this->globals[$key] = $value;
		}
	}

	/**
	 * @{inheritdoc}
	 */
	public function set($key, $value)
	{
		$this->globals[$key] = $value;
	}

	/**
	 * @{inheritdoc}
	 */
	public function getGlobals()
	{
		return $this->globals;
	}

	/**
	 * @{inheritdoc}
	 */
	public function build(FormulaRendererInterface $renderer)
	{
		$start = $renderer->getOption('separator_start');
        $end   = $renderer->getOption('separator_end');

		$needs = array();
		foreach ($this->globals as $key => $global) {

			$preg   = sprintf('/%s(?<needs>[a-zA-Z0-9 ]+)%s/', $start, $end);

			while (preg_match_all($preg, $global, $matches)) {

				$unknown = 0;
				foreach ($matches['needs'] as $need) {
					if (!isset($this->globals[$need])) {
						$unknown++;
					} else {
						$replacements = array(
							$need => $this->globals[$need],
						);

						$global = $renderer->prepare($global);
						$global = $renderer->replace($global, $renderer->buildReplacements($replacements));
						$this->globals[$key] = $global;
					}
				}

				if ($unknown == count($matches['needs'])) {
					break;
				}
			}
		}

		return $this;
	}
}
