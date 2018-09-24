jQuery(document).ready(function($) {
    "use strict";
    
    /**
     * Script for image selected from radio option
     */
    $('.controls#relic-fashion-store-img-container li img').click(function(){
        $('.controls#relic-fashion-store-img-container li').each(function(){
            $(this).find('img').removeClass ('relic-fashion-store-radio-img-selected') ;
        });
        $(this).addClass ('relic-fashion-store-radio-img-selected') ;
    });

});