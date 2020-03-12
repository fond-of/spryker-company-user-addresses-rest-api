<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Plugin\ResourceRoute;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\CompanyUserAddressesRestApiConfig;
use FondOfSpryker\Glue\CompanyUsersRestApi\CompanyUsersRestApiConfig;
use Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompanyUserAddressesResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Plugin\ResourceRoute\CompanyUserAddressesResourceRoutePlugin
     */
    protected $companyUserAddressesResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserAddressesResourceRoutePlugin = new CompanyUserAddressesResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionInterfaceMock->expects($this->atLeastOnce())
            ->method('addGet')
            ->with(CompanyUserAddressesRestApiConfig::ACTION_GET)
            ->willReturnSelf();

        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->companyUserAddressesResourceRoutePlugin->configure(
                $this->resourceRouteCollectionInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            CompanyUserAddressesRestApiConfig::RESOURCE_ADDRESSES,
            $this->companyUserAddressesResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            CompanyUserAddressesRestApiConfig::CONTROLLER_ADDRESSES,
            $this->companyUserAddressesResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestCompanyUserAddressesAttributesTransfer::class,
            $this->companyUserAddressesResourceRoutePlugin->getResourceAttributesClassName()
        );
    }

    /**
     * @return void
     */
    public function testGetParentResourceType(): void
    {
        $this->assertSame(
            CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS,
            $this->companyUserAddressesResourceRoutePlugin->getParentResourceType()
        );
    }
}
