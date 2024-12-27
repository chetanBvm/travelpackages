<?php

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($number)
    {
        return substr($number, 0, 4) . '-' . substr($number, 4, 3) . '-' . substr($number, 7);
    }
}
