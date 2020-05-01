<?php
namespace Src\Ext\Exchange;

interface iExchange {
	
	public function _call();
	
	public function get_rate($currency);
	
}