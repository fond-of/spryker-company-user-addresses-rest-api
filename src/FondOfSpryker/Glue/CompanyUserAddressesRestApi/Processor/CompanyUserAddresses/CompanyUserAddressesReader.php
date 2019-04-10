<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\CompanyUserAddresses;

use FondOfSpryker\Glue\CompanyUserAddressesRestApi\CompanyUserAddressesRestApiConfig;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface;
use FondOfSpryker\Glue\CompanyUsersRestApi\CompanyUsersRestApiConfig;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\CustomersRestApi\CustomersRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestLinkInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserAddressesReader implements CompanyUserAddressesReaderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface
     */
    protected $companyUsersRestApiClient;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidator;

    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface
     */
    protected $companyUserAddressesMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiValidatorInterface $restApiValidator
     * @param \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper\CompanyUserAddressesMapperInterface $companyUserAddressesMapper
     * @param \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Dependency\Client\CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface $companyUsersRestApiClient
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator,
        CompanyUserAddressesMapperInterface $companyUserAddressesMapper,
        CompanyUserAddressesRestApiToCompanyUsersRestApiClientInterface $companyUsersRestApiClient
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->restApiError = $restApiError;
        $this->companyUsersRestApiClient = $companyUsersRestApiClient;
        $this->restApiValidator = $restApiValidator;
        $this->companyUserAddressesMapper = $companyUserAddressesMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAddresses(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $parentResource = $restRequest->findParentResourceByType(CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS);

        if (!$parentResource) {
            return $this->restApiError->addRequiredParameterIsMissingError($restResponse);
        }

        $companyUserReference = $parentResource->getId();
        $companyUserTransfer = (new CompanyUserTransfer())->setCompanyUserReference($companyUserReference);

        $companyUserResponseTransfer = $this->companyUsersRestApiClient
            ->findCompanyUserByCompanyUserReference($companyUserTransfer);

        $restResponse = $this->restApiValidator->validateCompanyUserResponseTransfer(
            $companyUserResponseTransfer,
            $restRequest,
            $restResponse
        );

        if (count($restResponse->getErrors()) > 0) {
            return $restResponse;
        }

        return $this->getAddressesByCompanyUser($companyUserResponseTransfer->getCompanyUser(), $restResponse);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function getAddressesByCompanyUser(
        CompanyUserTransfer $companyUserTransfer,
        RestResponseInterface $restResponse
    ): RestResponseInterface {
        $companyBusinessUnitTransfer = $companyUserTransfer->getCompanyBusinessUnit();

        if ($companyBusinessUnitTransfer === null) {
            return $restResponse;
        }

        $companyUnitAddressCollectionTransfer = $companyBusinessUnitTransfer->getAddressCollection();

        if ($companyUnitAddressCollectionTransfer === null) {
            return $restResponse;
        }

        foreach ($companyUnitAddressCollectionTransfer->getCompanyUnitAddresses() as $companyUnitAddressTransfer) {
            $restResponse->addResource($this->getAddressResource($companyUserTransfer, $companyUnitAddressTransfer));
        }

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function getAddressResource(
        CompanyUserTransfer $companyUserTransfer,
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestResourceInterface {
        $restCompanyUserAddressesAttributesTransfer = $this->companyUserAddressesMapper
            ->mapCompanyUnitAddressTransferToRestCompanyUserAddressesAttributesTransfer(
                $companyUnitAddressTransfer
            );

        $restResource = $this->restResourceBuilder
            ->createRestResource(
                CompanyUserAddressesRestApiConfig::RESOURCE_ADDRESSES,
                $companyUnitAddressTransfer->getUuid(),
                $restCompanyUserAddressesAttributesTransfer
            )->addLink(
                RestLinkInterface::LINK_SELF,
                $this->createSelfLink($companyUserTransfer, $companyUnitAddressTransfer)
            );

        return $restResource;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return void
     */
    protected function createSelfLink(
        CompanyUserTransfer $companyUserTransfer,
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): string {
        return sprintf(
            CustomersRestApiConfig::FORMAT_SELF_LINK_ADDRESS_RESOURCE,
            CompanyUsersRestApiConfig::RESOURCE_COMPANY_USERS,
            $companyUserTransfer->getCompanyUserReference(),
            CompanyUserAddressesRestApiConfig::RESOURCE_ADDRESSES,
            $companyUnitAddressTransfer->getUuid()
        );
    }
}
