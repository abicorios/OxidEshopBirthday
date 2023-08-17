[{$smarty.block.parent}]

[{if $oxcmp_user}]
    [{if $oxcmp_user->hasBirthday()}]
        [{assign var="conf" value=$oViewConf->getConfig()}]
        [{$conf->getConfigParam('sBirthdayTextStart')}]
    [{else}]
        sorry - no birthday
    [{/if}]
[{else}]
    you are not logged in
[{/if}]
