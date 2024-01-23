"use strict";

var KTCalendarExternalEvents = function() {


    return {
        //main function to initiate the module
        init: function() {
            initExternalEvents();
            initCalendar();
        }
    };
}();

jQuery(document).ready(function() {
   // KTCalendarExternalEvents.init();
});
