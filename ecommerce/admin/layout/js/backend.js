$(function(){
    'use strict';
    // hide placeholder on focus
    $('[placeholder]').focus (function(){
        $(this).attr('data-text' , (tisi).attr('placeholder'));
        $(this).attr('placeholder' , '');
    }).blur(function(){
        $(this).attr('placeholder' , (tisi).attr('data-text'));
    });
    });