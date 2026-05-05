<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/vendors' . (session('lang') != 'ar' ? '' : '-rtl') . '.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/tables/datatable/datatables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/tables/extensions/colReorder.dataTables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css') ?>">
<?= $this->endsection() ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/datatables.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.colReorder.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/jszip.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/buttons.print.min.js') ?>"></script>
<script>
    var tableConstructor = $('.dtTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/<?= session('lang') ?>.json"
        },
        "columnDefs": [{
            "type": "html-num",
            "targets": 0
        }],
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
    });
</script>

<script>
    var tableConstructor = $('.responsive').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/<?= session('lang') ?>.json"
        },
        "columnDefs": [{
            "type": "html-num",
            "targets": 0
        }],
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
        responsive: true
    });
</script>

<script>
    var tableConstructor = $('.result').DataTable({
        paging: false,
        searching: false,
        ordering: true,
        info: false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/<?= session('lang') ?>.json"
        },
        "columnDefs": [{
            "type": "html-num",
            "targets": 0
        }],
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
        responsive: false
    });
</script>

<script>
    var tableConstructor = $('.timetable').DataTable({
        paging: false,
        searching: false,
        ordering: true,
        info: false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/<?= session('lang') ?>.json"
        },
        "columnDefs": [{
            "type": "html-num",
            "targets": 0
        }],
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
        responsive: false
    });
</script>

<script>
    /*********************************
     *       js of Form inputs        *
     *********************************/

    var tableFormInputs = $('.submit-form-inputs').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/<?= session('lang') ?>.json"
        },
        paging: false,
    });
</script>

<script>
    var tableConstructor = $('.attendance').DataTable({
        paging: false,
        searching: false,
        ordering: false,
        info: false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/<?= session('lang') ?>.json"
        },
        "columnDefs": [{
            "type": "html-num",
            "targets": 0
        }],
    });
    new $.fn.dataTable.DataTable(tableConstructor);
</script>
<?= $this->endSection() ?>