<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi;

use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\CompanyUserAddresses\CompanyUserAddressesReader;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\CompanyUserAddresses\CompanyUserAddressesReaderInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapper;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidator;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyUserAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\CompanyUserAddresses\CompanyUserAddressesReaderInterface
     */
    public function createCompanyUserAddressesReader(): CompanyUserAddressesReaderInterface
    {
        return new CompanyUserAddressesReader(
            $this->getResourceBuilder(),
            $this->createRestApiError(),
            $this->createRestApiValidator(),
            $this->createCompanyUserAddressesMapper(),
            $this->getCompanyUsersRestApiClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected function createRestApiValidator(): RestApiValidatorInterface
    {
        return new RestApiValidator(
            $this->createRestApiError()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface
     */
    protected function createCompanyUserAddressesMapper(): CompanyUserAddressesMapperInterface
    {
        return new CompanyUserAddressesMapper();
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface
     */
    protected function getCompanyUsersRestApiClient(): CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface
    {
        return $this->getProvidedDependency(CompanyUserAddressesRestApiDependencyProvider::CLIENT_COMPANY_USERS_REST_API);
    }
}
