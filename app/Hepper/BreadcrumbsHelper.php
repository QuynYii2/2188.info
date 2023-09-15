<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

if (!function_exists('getBreadcrumbs')) {
    function getBreadcrumbs($breadcrumbName, ...$params)
    {
        return Breadcrumbs::render($breadcrumbName, ...$params);
    }
}