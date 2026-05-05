<!-- <?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/calendars/fullcalendar.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css-rtl/core/colors/palette-callout.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/calendars/daygrid.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/calendars/timegrid.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css-rtl/plugins/calendars/fullcalendar.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?= lang('app.timetable') ?></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <p class="card-text">A URL of a JSON feed that the calendar will fetch Event Objects from. FullCalendar will visit the URL whenever it needs new event data. This happens when the user clicks prev/next or changes views. FullCalendar will determine the date-range it needs events for and will pass that information along in GET parameters.</p>

                    <div id='fc-json'></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url('app-assets/vendors/js/extensions/fullcalendar.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/interactions.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/daygrid.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/timegrid.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/gcal.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/locales-all.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/moment.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/moment-timezone.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/fullcalendar.min.js') ?>"></script>
<script src="<?= base_url('app-assets/js/scripts/extensions/fullcalendar-extra.js') ?>"></script>
<?= $this->endSection() ?> -->