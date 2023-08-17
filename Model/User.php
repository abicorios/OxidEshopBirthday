<?php

namespace abicorios\OxidEshopBirthday\Model;

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
}
