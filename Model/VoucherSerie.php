<?php

namespace abicorios\OxidEshopBirthday\Model;

use OxidEsales\EshopCommunity\Application\Model\Voucher;
use OxidEsales\EshopCommunity\Core\Field;
use OxidEsales\EshopCommunity\Core\Registry;

class VoucherSerie extends VoucherSerie_parent
{
    /**
     * @param \OxidEsales\EshopCommunity\Application\Model\User $user
     * @return bool|string
     * @throws \Exception
     */
    public function generateVoucherForBirthday($user)
    {
        $birthdayObject = new \DateTime($user->getFieldData('oxbirthdate'));

        if ($this->load(Registry::getConfig()->getConfigParam('oxacVoucherSerieId'))) {
            $voucherCode = $this->getBirthdayVoucherCode($user);

            $newVoucher = oxNew(Voucher::class);
            $newVoucher->oxvouchers__oxvoucherserieid = new Field($this->getId());
            $newVoucher->oxvouchers__oxvouchernr = new Field($voucherCode);
            $newVoucher->oxvouchers__oxdateused = new Field('0000-00-00');
            $newVoucher->oxvouchers__oxac_birhdayvoucher = new Field(date('Y') . '-' . $birthdayObject->format('m-d'));
            $newVoucher->oxvouchers__oxac_birhdayvoucheruserid = new Field($user->getId());

            if ($newVoucher->save()) {
                return $voucherCode;
            }
        }

        return false;
    }

    /**
     * @param \OxidEsales\EshopCommunity\Application\Model\User $user
     * @return string
     */
    public function getBirthdayVoucherCode($user)
    {
        $code = 'happy_birthday_' .
            $user->getFieldData('oxfname') .
            '_' .
            substr(Registry::getUtilsObject()->generateUId(), 0, 8);
        
        return $code;
    }
}
