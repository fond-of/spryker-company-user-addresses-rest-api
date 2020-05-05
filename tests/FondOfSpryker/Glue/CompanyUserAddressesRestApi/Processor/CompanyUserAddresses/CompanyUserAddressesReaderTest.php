<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\CompanyUserAddresses;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\CompanyUserAddressesRestApiConfig;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUserReferenceClientInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface;
use FondOfSpryker\Glue\CompanyUsersRestApi\CompanyUsersRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserAddressesReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\CompanyUserAddresses\CompanyUserAddressesReader
     */
    protected $companyUserAddressesReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidatorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface
     */
    protected $companyUserAddressesMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUserReferenceClientInterface
     */
    protected $companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    protected $companyUserResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    protected $companyUnitAddressCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer[]
     */
    protected $companyUnitAddressTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer
     */
    protected $restCompanyUserAddressesAttributesTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $companyUserReference;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorInterfaceMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiValidatorInterfaceMock = $this->getMockBuilder(RestApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserAddressesMapperInterfaceMock = $this->getMockBuilder(CompanyUserAddressesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock = $this->getMockBuilder(CompanyUserAddressesRestApiToCompanyUserReferenceClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = '2576e080-8ee2-11ea-bc55-0242ac130003';

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressCollectionTransferMock = $this->getMockBuilder(CompanyUnitAddressCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMocks = [
            $this->companyUnitAddressTransferMock,
        ];

        $this->restCompanyUserAddressesAttributesTransferMock = $this->getMockBuilder(RestCompanyUserAddressesAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->companyUserReference = 'company-user-reference';

        $this->companyUserAddressesReader = new CompanyUserAddressesReader(
            $this->restResourceBuilderInterfaceMock,
            $this->restApiErrorInterfaceMock,
            $this->restApiValidatorInterfaceMock,
            $this->companyUserAddressesMapperInterfaceMock,
            $this->companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetAddresses(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS)
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyUserByCompanyUserReference')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('validateCompanyUserResponseTransfer')
            ->with(
                $this->companyUserResponseTransferMock,
                $this->restRequestInterfaceMock,
                $this->restResponseInterfaceMock
            )->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('getErrors')
            ->willReturn([]);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getAddressCollection')
            ->willReturn($this->companyUnitAddressCollectionTransferMock);

        $this->companyUnitAddressCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddresses')
            ->willReturn($this->companyUnitAddressTransferMocks);

        $this->companyUserAddressesMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapCompanyUnitAddressTransferToRestCompanyUserAddressesAttributesTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->restCompanyUserAddressesAttributesTransferMock);

        $this->companyUnitAddressTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                CompanyUserAddressesRestApiConfig::RESOURCE_ADDRESSES,
                $this->uuid,
                $this->restCompanyUserAddressesAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($this->companyUserReference);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('addLink')
            ->willReturnSelf();

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUserAddressesReader->getAddresses(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetAddressesParentResourceNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS)
            ->willReturn(null);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUserAddressesReader->getAddresses(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetAddressesRestResponseHasErrors(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS)
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyUserByCompanyUserReference')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('validateCompanyUserResponseTransfer')
            ->with(
                $this->companyUserResponseTransferMock,
                $this->restRequestInterfaceMock,
                $this->restResponseInterfaceMock
            )->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('getErrors')
            ->willReturn([
                'error',
            ]);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUserAddressesReader->getAddresses(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetAddressesCompanyBusinessUnitNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS)
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyUserByCompanyUserReference')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('validateCompanyUserResponseTransfer')
            ->with(
                $this->companyUserResponseTransferMock,
                $this->restRequestInterfaceMock,
                $this->restResponseInterfaceMock
            )->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('getErrors')
            ->willReturn([]);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn(null);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUserAddressesReader->getAddresses(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetAddressesCompanyUnitAddressCollectionNull(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('findParentResourceByType')
            ->with(CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS)
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->companyUserAddressesRestApiToCompanyUserReferenceClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findCompanyUserByCompanyUserReference')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('validateCompanyUserResponseTransfer')
            ->with(
                $this->companyUserResponseTransferMock,
                $this->restRequestInterfaceMock,
                $this->restResponseInterfaceMock
            )->willReturn($this->restResponseInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('getErrors')
            ->willReturn([]);

        $this->companyUserResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects($this->atLeastOnce())
            ->method('getAddressCollection')
            ->willReturn(null);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->companyUserAddressesReader->getAddresses(
                $this->restRequestInterfaceMock
            )
        );
    }
}
