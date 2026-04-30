@php
    $rawRole = Auth::user()->role ?? 'Admin';
    $role = trim(strtolower($rawRole));
    $username = strtolower(Auth::user()->username ?? '');

    if (str_contains($role, 'peternak') || str_contains($username, 'peternak')) {
        $sidebarFile = 'layouts.sidebar_peternak';
    } elseif (str_contains($role, 'penjualan') || str_contains($username, 'penjualan')) {
        $sidebarFile = 'layouts.sidebar_penjualan';
    } else {
        $sidebarFile = 'layouts.sidebar_admin';
    }
@endphp

@include($sidebarFile)
