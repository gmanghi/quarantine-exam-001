<?php declare(strict_types=1);
require 'vendor/autoload.php';

use Src\Modules\Commissions;
use Src\Ext;

putenv("ENV=dev");

foreach (explode("\n", file_get_contents($argv[1])) as $params) {

	if (empty($params)) break;
	
	$commissions = new Commissions($params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
	
	echo $commissions->calculate();
	
	print "\n";
	
}