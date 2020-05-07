<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Src\Modules\Commissions;
use Src\Ext;
final class CommissionTest extends TestCase
{
    public function testCanCalculateFromValidJsonWithCorrectAndCompleteParameters(): void
    {
		$json_params = '{"bin":"45717360","amount":"100.00","currency":"EUR"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$this->assertGreaterThanOrEqual(0, $commissions->calculate());
    }
	
	public function testCannotCalculateFromInvalidJsonFormat(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"bin":"45717360","amount":"100.00","currency":"EUR"';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
	
	public function testCannotCalculateWhenParameterBinIsMissing(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"amount":"100.00","currency":"EUR"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
	
	public function testCannotCalculateWhenParameterBinIsInvalid(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"bin":"ABC","amount":"100.00","currency":"EUR"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
	
	public function testCannotCalculateWhenParameterAmountIsMissing(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"bin":"45717360","currency":"EUR"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
	
	public function testCannotCalculateWhenParameterAmountIsInvalid(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"bin":"45717360","amount":"100.001","currency":"EUR"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
	
	public function testCannotCalculateWhenParameterCurrencyIsMissing(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"bin":"45717360","amount":"100.00"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
	
	public function testCannotCalculateWhenParameterCurrencyIsInvalid(): void
    {	
		$this->expectException(InvalidArgumentException::class);
		
		$json_params = '{"bin":"45717360","amount":"100.00","currency":"123"}';
		
		$commissions = new Commissions($json_params, new Ext\Bin\Binlist, new Ext\Exchange\ExchangeRatesApi);
		
		$commissions->calculate();
    }
}