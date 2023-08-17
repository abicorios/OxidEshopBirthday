[{$smarty.block.parent}]

[{if $oxcmp_user}]
    [{if $oxcmp_user->hasBirthday()}]
        [{assign var=voucherCode value=$oxcmp_user->getBirthdayVoucherCode()}]
        [{assign var=conf value=$oViewConf->getConfig()}]
        [{$conf->getConfigParam('sBirthdayTextStart')}]

        [{if $voucherCode}]
            [{oxmultilang ident='BIRTHDAY_WISHES' args=$voucherCode}]
        [{/if}]
    [{/if}]
[{/if}]
