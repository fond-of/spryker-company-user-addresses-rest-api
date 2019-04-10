<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Validation;

use FondOfSpryker\Glue\CompanyUserAddressesRestApi\CompanyUserAddressesRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addRequiredParameterIsMissingError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanyUserAddressesRestApiConfig::RESPONSE_CODE_REQUIRED_PARAMETER_IS_MISSING)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompanyUserAddressesRestApiConfig::RESPONSE_MESSAGE_REQUIRED_PARAMETER_IS_MISSING);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyUserNotFoundError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompanyUserAddressesRestApiConfig::RESPONSE_CODE_COMPANY_USER_NOT_FOUND)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompanyUserAddressesRestApiConfig::RESPONSE_MESSAGE_COMPANY_USER_NOT_FOUND);

        return $restResponse->addError($restErrorMessageTransfer);
    }
}
