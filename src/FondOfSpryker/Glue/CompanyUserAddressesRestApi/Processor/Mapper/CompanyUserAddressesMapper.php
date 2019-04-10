<?php

namespace FondOfSpryker\Glue\CompanyUserAddressesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer;

class CompanyUserAddressesMapper implements CompanyUserAddressesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserAddressesAttributesTransfer
     */
    public function mapCompanyUnitAddressTransferToRestCompanyUserAddressesAttributesTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): RestCompanyUserAddressesAttributesTransfer {
        $restCompanyUserAddressesAttributesTransfer = new RestCompanyUserAddressesAttributesTransfer();

        $restCompanyUserAddressesAttributesTransfer->fromArray(
            $companyUnitAddressTransfer->toArray(),
            true
        );

        $restCompanyUserAddressesAttributesTransfer->setCountry($companyUnitAddressTransfer->getIso2Code());

        return $restCompanyUserAddressesAttributesTransfer;
    }
}
