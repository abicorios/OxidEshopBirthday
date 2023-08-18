<?php

namespace abicorios\OxidEshopBirthday\Model;

class Voucher extends Voucher_parent
{
    /**
     * @return bool
     */
    public function isBirthdayVoucher()
    {
        return $this->getFieldData('oxac_birthdayvoucher') != null &&
            $this->getFieldData('oxac_birthdayvoucher') != '0000-00-00';
    }
}
