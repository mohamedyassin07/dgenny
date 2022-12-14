<?php 
/**
	Admin Page Framework v3.8.34 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/dgenny>
	Copyright (c) 2013-2021, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AdminPageFramework_Form_View___CSS_Field extends AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->___getFormFieldRules();
    }
    static private function ___getFormFieldRules() {
        return "td.dgenny-field-td-no-title {padding-left: 0;padding-right: 0;}.dgenny-fields {display: table; width: 100%;table-layout: fixed;}.dgenny-field input[type='number'] {text-align: right;} .dgenny-fields .disabled,.dgenny-fields .disabled input,.dgenny-fields .disabled textarea,.dgenny-fields .disabled select,.dgenny-fields .disabled option {color: #BBB;}.dgenny-fields hr {border: 0; height: 0;border-top: 1px solid #dfdfdf; }.dgenny-fields .delimiter {display: inline;}.dgenny-fields-description {margin-bottom: 0;}.dgenny-field {float: left;clear: both;display: inline-block;margin: 1px 0;}.dgenny-field label {display: inline-block; width: 100%;}@media screen and (max-width: 782px) {.form-table fieldset > label {display: inline-block;}}.dgenny-field .dgenny-input-label-container {margin-bottom: 0.25em;}@media only screen and ( max-width: 780px ) { .dgenny-field .dgenny-input-label-container {margin-top: 0.5em; margin-bottom: 0.5em;}} .dgenny-field .dgenny-input-label-string {padding-right: 1em; vertical-align: middle; display: inline-block; }.dgenny-field .dgenny-input-button-container {padding-right: 1em; }.dgenny-field .dgenny-input-container {display: inline-block;vertical-align: middle;}.dgenny-field-image .dgenny-input-label-container { vertical-align: middle;}.dgenny-field .dgenny-input-label-container {display: inline-block; vertical-align: middle; } .repeatable .dgenny-field {clear: both;display: block;}.dgenny-repeatable-field-buttons {float: right; margin: 0.1em 0 0.5em 0.3em;vertical-align: middle;}.dgenny-repeatable-field-buttons .repeatable-field-button {margin: 0 0.1em;font-weight: normal;vertical-align: middle;text-align: center;}@media only screen and (max-width: 960px) {.dgenny-repeatable-field-buttons {margin-top: 0;}}.dgenny-sections.sortable-section > .dgenny-section,.sortable > .dgenny-field {clear: both;float: left;display: inline-block;padding: 1em 1.32em 1em;margin: 1px 0 0 0;border-top-width: 1px;border-bottom-width: 1px;border-bottom-style: solid;-webkit-user-select: none;-moz-user-select: none;user-select: none; text-shadow: #fff 0 1px 0;-webkit-box-shadow: 0 1px 0 #fff;box-shadow: 0 1px 0 #fff;-webkit-box-shadow: inset 0 1px 0 #fff;box-shadow: inset 0 1px 0 #fff;-webkit-border-radius: 3px;border-radius: 3px;background: #f1f1f1;background-image: -webkit-gradient(linear, left bottom, left top, from(#ececec), to(#f9f9f9));background-image: -webkit-linear-gradient(bottom, #ececec, #f9f9f9);background-image: -moz-linear-gradient(bottom, #ececec, #f9f9f9);background-image: -o-linear-gradient(bottom, #ececec, #f9f9f9);background-image: linear-gradient(to top, #ececec, #f9f9f9);border: 1px solid #CCC;background: #F6F6F6;} .dgenny-fields.sortable {margin-bottom: 1.2em; } .dgenny-field .button.button-small {width: auto;} .font-lighter {font-weight: lighter;} .dgenny-field .button.button-small.dashicons {font-size: 1.2em;padding-left: 0.2em;padding-right: 0.22em;min-width: 1em; }@media screen and (max-width: 782px) {.dgenny-field .button.button-small.dashicons {min-width: 1.8em; }}.dgenny-field .button.button-small.dashicons:before {position: relative;top: 7.2%;}@media screen and (max-width: 782px) {.dgenny-field .button.button-small.dashicons:before {top: 8.2%;}}.dgenny-field-title {font-weight: 600;min-width: 80px;margin-right: 1em;}.dgenny-fieldset {font-weight: normal;}.dgenny-input-label-container,.dgenny-input-label-string{min-width: 140px;}";
    }
    protected function _getVersionSpecific() {
        $_sCSSRules = '';
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= ".dgenny-field .remove_value.button.button-small {line-height: 1.5em; }";
        }
        $_sCSSRules.= $this->___getForWP38OrAbove();
        $_sCSSRules.= $this->___getForWP53OrAbove();
        return $_sCSSRules;
    }
    private function ___getForWP38OrAbove() {
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            return '';
        }
        return ".dgenny-repeatable-field-buttons {margin: 2px 0 0 0.3em;}.dgenny-repeatable-field-buttons.disabled > .repeatable-field-button {color: #edd;border-color: #edd;} @media screen and ( max-width: 782px ) {.dgenny-fieldset {overflow-x: hidden;overflow-y: hidden;}}";
    }
    private function ___getForWP53OrAbove() {
        if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
            return '';
        }
        return ".dgenny-field .button.button-small.dashicons:before {position: relative;top: -5.4px;}@media screen and (max-width: 782px) {.dgenny-field .button.button-small.dashicons:before {top: -6.2%;}.dgenny-field .button.button-small.dashicons {min-width: 2.4em;}}.dgenny-field .dgenny-repeatable-field-buttons {display: flex;}.dgenny-field .dgenny-repeatable-field-buttons {}.dgenny-field .dgenny-repeatable-field-buttons .repeatable-field-button.button {margin: 0 0.1em;display: flex;align-items: center;justify-content: center;}.dgenny-field .repeatable-field-button .dashicons {position: initial;top: initial;display: flex;align-items: center;justify-content: center;font-size: 16px;}.dgenny-repeatable-field-buttons .repeatable-field-button.button.button-small {min-width: 2.4em;min-height: 2.4em;padding: 0;}.with-nested-fields .dgenny-repeatable-field-buttons .repeatable-field-button {width: 2em;height: 2em;max-width: unset;max-height: unset;min-width: unset;min-height: unset;}@media screen and (max-width: 782px) {.dgenny-repeatable-field-buttons {margin: 0.64em 0 0 0.28em;}.dgenny-field .repeatable-field-button .dashicons {font-size: 20px;}.dgenny-repeatable-field-buttons .repeatable-field-button.button.button-small {margin-top: 0;margin-bottom: 0;min-width: 2.6em;min-height: 2.6em;}.dgenny-fields.sortable .dgenny-repeatable-field-buttons {margin: 0.6em 0 0 1em;}.with-nested-fields .dgenny-repeatable-field-buttons .repeatable-field-button {}.with-nested-fields .repeatable-field-button .dashicons {top: 4px;}}";
    }
    }
    