<?php 
/**
	Admin Page Framework v3.8.34 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/dgenny>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AdminPageFramework_Form_View___CSS_widget extends AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->_getWidgetRules();
    }
    private function _getWidgetRules() {
        return ".widget .dgenny-section .form-table > tbody > tr > td,.widget .dgenny-section .form-table > tbody > tr > th{display: inline-block;width: 100%;padding: 0;float: right;clear: right; }.widget .dgenny-field,.widget .dgenny-input-label-container{width: 100%;}.widget .sortable .dgenny-field {padding: 4% 4.4% 3.2% 4.4%;width: 91.2%;}.widget .dgenny-field input {margin-bottom: 0.1em;margin-top: 0.1em;}.widget .dgenny-field input[type=text],.widget .dgenny-field textarea {width: 100%;} @media screen and ( max-width: 782px ) {.widget .dgenny-fields {width: 99.2%;}.widget .dgenny-field input[type='checkbox'], .widget .dgenny-field input[type='radio'] {margin-top: 0;}}";
    }
    protected function _getVersionSpecific() {
        $_sCSSRules = '';
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= ".widget .dgenny-section table.mceLayout {table-layout: fixed;}";
        }
        if (version_compare($GLOBALS['wp_version'], '3.8', '>=')) {
            $_sCSSRules.= ".widget .dgenny-section .form-table th{font-size: 13px;font-weight: normal;margin-bottom: 0.2em;}.widget .dgenny-section .form-table {margin-top: 1em;}";
        }
        return $_sCSSRules;
    }
    }
    