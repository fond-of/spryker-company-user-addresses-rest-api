<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompanyUserAddressesRestApiConfig extends AbstractBundleConfig
{
    public const ACTION_GET = 'get';

    public const RESOURCE_ADDRESSES = 'addresses';

    public const CONTROLLER_ADDRESSES = 'addresses-resource';

    public const RESPONSE_CODE_REQUIRED_PARAMETER_IS_MISSING = '3000';
    public const RESPONSE_CODE_COMPANY_USER_NOT_FOUND = '3001';

    public const RESPONSE_MESSAGE_REQUIRED_PARAMETER_IS_MISSING = 'Required parameter is missing.';
    public const RESPONSE_MESSAGE_COMPANY_USER_NOT_FOUND = 'Company user not found.';
}
