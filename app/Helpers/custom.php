<?php
use Carbon\Carbon;

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($number)
    {
        return substr($number, 0, 4) . '-' . substr($number, 4, 3) . '-' . substr($number, 7);
    }
}

function currentYear(){
    $currentYear = Carbon::now();
    
    $months = [];
        
    for ($i = 0; $i <= 12; $i++) {
        $months[] = $currentYear->copy()->addMonthsNoOverflow($i)->format('F Y');
    }
    
    return $months;
}
