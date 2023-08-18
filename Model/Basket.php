<?php

namespace abicorios\OxidEshopBirthday\Model;

use OxidEsales\Eshop\Application\Model\Voucher;

class Basket extends Basket_parent
{
    public function addVoucher($sVoucherId)
    {
        try { // trying to load voucher and apply it
            $voucher = oxNew(Voucher::class);
            if ($voucher->getVoucherByNr($sVoucherId)) {
                if ($voucher->isBirthdayVoucher()) {
                    $curDate = new \DateTime();
                    $voucherDate = new \DateTime($voucher->getFieldData('oxac_birthdayvoucher'));
                    if ($voucherDate->format('Y-m-d') != $curDate->format('Y-m-d')) {
                        $oEx = oxNew(\OxidEsales\Eshop\Core\Exception\VoucherException::class, 'ERROR_MESSAGE_VOUCHER_NOBIRTHDAY');
                        $oEx->setVoucherNr($voucher->oxvouchers__oxvouchernr->value);
                        throw $oEx;
                    }
                }

                return parent::addVoucher($sVoucherId);
            }
        } catch (\OxidEsales\Eshop\Core\Exception\VoucherException $oEx) {
            // problems adding voucher
            \OxidEsales\Eshop\Core\Registry::getUtilsView()->addErrorToDisplay($oEx, false, true);
        }

        $this->onUpdate();
    }
}
