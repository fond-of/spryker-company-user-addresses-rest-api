<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer;

class CompanyUserAddressesMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapper
     */
    protected $companyUserAddressesMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var string
     */
    protected $iso2Code;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->iso2Code = 'iso-2-code';

        $this->companyUserAddressesMapper = new CompanyUserAddressesMapper();
    }

    /**
     * @return void
     */
    public function testMapCompanyUnitAddressTransferToRestCompanyUserAddressesAttributesTransfer(): void
    {
        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getIso2Code')
            ->willReturn($this->iso2Code);

        $this->assertInstanceOf(
            RestCompanyUserAddressesAttributesTransfer::class,
            $this->companyUserAddressesMapper->mapCompanyUnitAddressTransferToRestCompanyUserAddressesAttributesTransfer(
                $this->companyUnitAddressTransferMock
            )
        );
    }
}
