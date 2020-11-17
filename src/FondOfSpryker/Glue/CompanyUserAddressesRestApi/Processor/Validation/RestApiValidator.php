<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestApiValidator implements RestApiValidatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $apiErrors;

    /**
     * @param \FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation\RestApiErrorInterface $apiErrors
     */
    public function __construct(RestApiErrorInterface $apiErrors)
    {
        $this->apiErrors = $apiErrors;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserResponseTransfer $companyUserResponseTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function validateCompanyUserResponseTransfer(
        CompanyUserResponseTransfer $companyUserResponseTransfer,
        RestRequestInterface $restRequest,
        RestResponseInterface $restResponse
    ): RestResponseInterface {
        if ($companyUserResponseTransfer->getCompanyUser() === null) {
            return $this->apiErrors->addCompanyUserNotFoundError($restResponse);
        }

        return $restResponse;
    }
}
