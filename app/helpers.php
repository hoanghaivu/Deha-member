<?php

if (!function_exists('activeRoute')) {
    function activeRoute($arrayPrefix)
    {
        return in_array(request()->route()->getPrefix(), $arrayPrefix) ? 'active' : '';
    }
}