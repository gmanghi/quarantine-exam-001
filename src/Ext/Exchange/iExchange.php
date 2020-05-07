<?php declare(strict_types=1);
namespace Src\Ext\Exchange;

interface iExchange {
	
	public function _call();
	
	public function get_rate($currency);
	
}