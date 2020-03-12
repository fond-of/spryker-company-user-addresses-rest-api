<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class CompanyUserAddressesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\CompanyUserAddressesRestApiDependencyProvider
     */
    protected $companyUserAddressesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserAddressesRestApiDependencyProvider = new CompanyUserAddressesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companyUserAddressesRestApiDependencyProvider->provideDependencies(
                $this->containerMock
            )
        );
    }
}
