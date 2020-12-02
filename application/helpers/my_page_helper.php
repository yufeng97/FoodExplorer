<?php

function page($key=null, $value=false) {
    $name = array('Home', 'Menu', 'Shop');
    $is_active = array(false, false, false);
    $tabs = array_combine($name, $is_active);
    if ($key && $value) {
        $tabs[$key] = $value;
    }
    return $tabs;
}