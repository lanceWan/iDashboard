var TableDatatablesResponsive = function () {
  var initTable = function () {
      var table = $('#datatableAjax');

      var oTable = table.dataTable({
          "language": {
            url: '/admin/i18n'
          },
          buttons: [
            { extend: 'print', className: 'btn dark btn-outline' },
            { extend: 'copy', className: 'btn red btn-outline' },
            { extend: 'pdf', className: 'btn green btn-outline' },
            { extend: 'excel', className: 'btn yellow btn-outline ' },
            { extend: 'csv', className: 'btn purple btn-outline ' },
            { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
          ],
          responsive: true,

          "lengthMenu": [
              [5, 10, 15, 20, -1],
              [5, 10, 15, 20, "All"]
          ],

          "pageLength": 10,
      });

      $('#sample_tools > li > a.tool-action').on('click', function() {
        var action = $(this).attr('data-action');
        oTable.DataTable().button(action).trigger();
      });
  }
  return {
      init: function () {
          if (!jQuery().dataTable) {
              return;
          }
          initTable();
      }

  };

}();
jQuery(document).ready(function() {
    TableDatatablesResponsive.init();
});
