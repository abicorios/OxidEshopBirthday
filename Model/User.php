<?php

namespace abicorios\OxidEshopBirthday\Model;

// use OxidEsales\EshopCommunity\Application\Model\VoucherSerie;
use abicorios\OxidEshopBirthday\Model\VoucherSerie;

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
            if ($voucherCode = $voucherSerie->generateVoucherForBirthday($this)) {
                return $voucherCode;
            }
        }

        return false;
    }
}
