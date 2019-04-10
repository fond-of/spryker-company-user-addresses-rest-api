<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer;

interface CompanyUserAddressesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer
     */
    public function mapCompanyUnitAddressTransferToRestCompanyUserAddressesAttributesTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestCompanyUserAddressesAttributesTransfer;
}
