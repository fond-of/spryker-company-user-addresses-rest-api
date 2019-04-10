<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi;

use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUsersRestApiClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompanyUserAddressesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY_USERS_REST_API = 'CLIENT_COMPANY_USERS_REST_API';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCompanyUsersRestApiClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyUsersRestApiClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_USERS_REST_API] = function (Container $container) {
            return new CompanyUserAddressesRestApiToCompanyUsersRestApiClientBridge(
                $container->getLocator()->companyUsersRestApi()->client()
            );
        };

        return $container;
    }
}
