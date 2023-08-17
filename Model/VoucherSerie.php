<?php

namespace abicorios\OxidEshopBirthday\Model;

use OxidEsales\Eshop\Application\Model\Voucher;
use OxidEsales\EshopCommunity\Core\DatabaseProvider;
use OxidEsales\EshopCommunity\Core\Field;
use OxidEsales\EshopCommunity\Core\Registry;

/**
 * @see \OxidEsales\Eshop\Application\Model\VoucherSerie
 */
class VoucherSerie extends VoucherSerie_parent
{
    /**
     * @param \OxidEsales\Eshop\Application\Model\User $user
     * @return bool|mixed|string
     * @throws \OxidEsales\EshopCommunity\Core\Exception\DatabaseConnectionException
     */
    public function getBirthdayVoucherCode($user)
    {
        $birthdayObject = new \DateTime($user->getFieldData('oxbirthdate'));

        if ($birthdayVoucher = $this->checkAndGetBirthdayVoucherFromDatabase($birthdayObject->format('m-d'), $user)) {
            if ($birthdayVoucher->getFieldData('oxdateused') == '0000-00-00') {
                return $birthdayVoucher->getFieldData('oxvouchernr');
            } else {
                return false;
            }
        }

        return $this->generateVoucherForBirthday($user);
    }

    /**
     * @param \OxidEsales\Eshop\Application\Model\User $user
     * @return bool|string
     * @throws \Exception
     */
    public function generateVoucherForBirthday($user)
    {
        $birthdayObject = new \DateTime($user->getFieldData('oxbirthdate'));

        if ($this->load(Registry::getConfig()->getConfigParam('oxacVoucherSerieId'))) {
            $voucherCode = $this->generateBirthdayVoucherCode($user);

            $newVoucher = oxNew(Voucher::class);
            $newVoucher->oxvouchers__oxvoucherserieid = new Field($this->getId());
            $newVoucher->oxvouchers__oxvouchernr = new Field($voucherCode);
            $newVoucher->oxvouchers__oxdateused = new Field('0000-00-00');
            $newVoucher->oxvouchers__oxac_birthdayvoucher = new Field(date('Y') . '-' . $birthdayObject->format('m-d'));
            $newVoucher->oxvouchers__oxac_birthdayvoucheruserid = new Field($user->getId());

            if ($newVoucher->save()) {
                return $voucherCode;
            }
        }

        return false;
    }

    /**
     * @param \OxidEsales\Eshop\Application\Model\User $user
     * @return string
     */
    protected function generateBirthdayVoucherCode($user)
    {
        $code = 'happy_birthday_' .
            $user->getFieldData('oxfname') .
            '_' .
            substr(Registry::getUtilsObject()->generateUId(), 0, 8);
        
        return $code;
    }

    /**
     * @param string $birthdayVoucherDate
     * @param \OxidEsales\Eshop\Application\Model\User $user
     * @return bool|Object|Voucher
     * @throws \OxidEsales\EshopCommunity\Core\Exception\DatabaseConnectionException
     */
    protected function checkAndGetBirthdayVoucherFromDatabase($birthdayVoucherDate, $user)
    {
        $db = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $sql = "SELECT oxid
        FROM oxvouchers
        WHERE 
            oxac_birthdayvoucheruserid = " . $db->quote($user->getId()) . "
        AND
            oxac_birthdayvoucher = " . $db->quote(date('Y') . '-' . $birthdayVoucherDate);
        
        if ($voucherId = $db->getOne($sql)) {
            $voucher = oxNew(Voucher::class);
            if ($voucher->load($voucherId)) {
                return $voucher;
            }
        }

        return false;
    }
}
