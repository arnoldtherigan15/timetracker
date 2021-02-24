<?php

if (! function_exists('dateID')) {         
    /**
     * dateID
     *
     * @param  mixed $tanggal
     * @return void
     */
    function dateID($tanggal) {
        $value = Carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('l, d F Y');
    }
}