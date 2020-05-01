<?php
require 'vendor/autoload.php';

use Src\Modules\Commissions;
use Src\Ext;

foreach (explode("\n", file_get_contents($argv[1])) as $params) {

	if (empty($params)) break;
	
	$commissions = new Commissions($params, new Ext\Bin\NeutrinoApiBinlist, new Ext\Exchange\ExchangeRatesApi2);
	
	echo $commissions->calculate();
	
	print "\n";
	
}