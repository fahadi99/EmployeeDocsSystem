"use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
    // Private functions

    // demo initializer
    var demo = function() {

		var datatable = $('#kt_datatable').KTDatatable({
			data: {
				saveState: {cookie: false},
			},
			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},
			layout: {
				class: 'datatable-bordered'
			},
			columns: [
				{
					field: 'Status',
					title: 'Status',
					autoHide: false,
					template: function(row) {
						var status = {
							1: {
                                'title': 'Completed',
                                'class': ' label-light-success'
                            },
							2: {
                                'title': 'Pending',
                                'class': ' label-light-danger'
                            }
						};
						console.log(row);
						return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
					},
				},
			],
		});



        // $('#kt_datatable_search_status').on('change', function() {
        //     datatable.search($(this).val().toLowerCase(), 'Status');
        // });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'File Type');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
        },
    };
}();

jQuery(document).ready(function() {
	KTDatatableHtmlTableDemo.init();
});
