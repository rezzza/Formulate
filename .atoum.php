<?php
use \mageekguy\atoum;

$runner->addTestsFromDirectory(__DIR__.'/tests/units');

$script
    ->addDefaultReport()
    ->addField(new atoum\report\fields\runner\result\logo())
;

$script->noCodeCoverageForNamespaces('mageekguy');
$script->bootstrapFile(__DIR__ . DIRECTORY_SEPARATOR . '.atoum.bootstrap.php');
