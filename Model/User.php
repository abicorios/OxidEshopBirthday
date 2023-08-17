<?php

namespace abicorios\OxidEshopBirthday\Model;

use OxidEsales\Eshop\Application\Model\VoucherSerie;

/**
 * @see \OxidEsales\Eshop\Application\Model\User
 */
class User extends User_parent
{
    /**
     * @return bool
     * @throws \Exception
     */
    public function hasBirthday()
    {
        if ($birthday = $this->getFieldData('oxbirthdate')) {
            $curDate = new \DateTime();
            $birthdayObject = new \DateTime($birthday);
            if ($birthdayObject->format('m-d') == $curDate->format('m-d')) {
                return true;
            }
        }

        return false;
    }

    public function getBirthdayVoucherCode()
    {
        if ($this->hasBirthday()) {
            $voucherSerie = oxNew(VoucherSerie::class);
            if ($voucherCode = $voucherSerie->getBirthdayVoucherCode($this)) {
                return $voucherCode;
            }
        }

        return false;
    }
}
