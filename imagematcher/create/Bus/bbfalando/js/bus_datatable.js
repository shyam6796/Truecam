var TableDatatablesAjax = function () {

    var handleTable = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#bus_table_id"),
            onSuccess: function (grid, response) {
			     // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },

            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

			"columns": [
						{"data":"id"},{"data":"bus_no"},{"data":"latitude"},{"data":"longitude"}						
					],
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
               
                "dom": "<'row'<'col-md-8 col-sm-12'i><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'i><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "pageLength": 10, // default record count per page

                "ajax": {
                    "url": "bus_ajax_function.php", // ajax source
					data:{s:"bus_view_datatable_function",key:1226}
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc,

                "language": {
                    "loadingRecords": "Please wait ...",
                    "zeroRecords": "No records",
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                },

                scrollY: 400,
                deferRender:    true,
                scroller: {
                    loadingIndicator: true
                }
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        //grid.setAjaxParam("customActionType", "group_action");
        //grid.getDataTable().ajax.reload();
        //grid.clearAjaxParams();
    }

    return {

        //main function to initiate the module
        init: function () {         
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesAjax.init();
});