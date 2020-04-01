<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi;

use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUserReferenceClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompanyUserAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY_USER_REFERENCE = 'CLIENT_COMPANY_USER_REFERENCE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCompanyUserReferenceClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyUserReferenceClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_USER_REFERENCE] = static function (Container $container) {
            return new CompanyUserAddressesRestApiToCompanyUserReferenceClientBridge(
                $container->getLocator()->companyUserReference()->client()
            );
        };

        return $container;
    }
}
