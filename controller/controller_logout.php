<?php

function unsetcookie($key, $path = '', $domain = '', $secure = false){
    if (array_key_exists($key, $_COOKIE)) {
        if (false === setcookie($key, null, -1, $path, $domain, $secure)) {
            return false;
        }

        unset($_COOKIE[$key]);
    }

    return true;
}

unsetcookie('PortalSession', '/');

header ('Location: ../');

?>