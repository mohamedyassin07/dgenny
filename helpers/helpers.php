<?php

$helpers =  array( 'base', 'debug', 'hooked_debug', 'meta_data' );
$dir = __DIR__;
foreach ( $helpers as $helper ) {
    include_once( $dir.'/'.$helper.'.php' );
}