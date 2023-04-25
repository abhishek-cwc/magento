<?php
declare(strict_types=1);

namespace Webkul\Grid\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Data\OptionSourceInterface;
use Webkul\Grid\Model\Status;

class StatusTest extends TestCase
{
    
    public function setUp() : void
    {
      $this->testObj = new Status();
    }
    
    public function testGetOptionArray()
    {
    	$this->testObj->getOptionArray();
    }
}
