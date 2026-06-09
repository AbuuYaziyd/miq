<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3><?= lang('app.classSubReg') ?></h3>
            </div>
            <div class="card-content">
                <?php $validation = \Config\Services::validation() ?>
                <?= form_open('class/reg/' . $class['id']) ?>
                <div class="row container">
                    <div class="col ">
                        <div class=" addNew">
                            <div class="row mx-1">
                                <div class="col-md-5">
                                    <fieldset class="form-group">
                                        <label for=""><b><?= lang('app.className') ?></b></label>
                                        <input type="hidden" name="class_id[]" value="<?= $class['id'] ?>">
                                        <input type="text" class="form-control" value="<?= $class['name'] ?>" readonly>
                                    </fieldset>
                                </div>
                                <div class="col-md-5">
                                    <fieldset class="form-group">
                                        <label for=""><b><?= lang('app.subName') ?></b></label>
                                        <select class="custom-select" name="subId[]">
                                            <option selected disabled><?= lang('app.choose') ?></option>
                                            <?php foreach ($sub as $key => $data) : ?>
                                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-2">
                                    <span class="btn btn-outline-success addEvent round mt-2"><?= lang('app.add') ?></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-1"><?= lang('app.save') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div style="visibility: hidden;">
    <div class="itemAdd" id="itemAdd">
        <div class="itemDelete" id="itemDelete">
            <div class="form-row">

                <div class="col-md-5">
                    <fieldset class="form-group">
                        <label for=""><b><?= lang('app.className') ?></b></label>
                        <input type="hidden" name="class_id[]" value="<?= $class['id'] ?>">
                        <input type="text" class="form-control" value="<?= $class['name'] ?>" readonly>
                    </fieldset>
                </div>
                <div class="col-md-5">
                    <fieldset class="form-group">
                        <label for=""><b><?= lang('app.subName') ?></b></label>
                        <select class="custom-select" name="subId[]">
                            <option selected disabled><?= lang('app.choose') ?></option>
                            <?php foreach ($sub as $key => $data) : ?>
                                <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-2">
                    <span class="btn btn-outline-danger removeEvent round mt-2"><?= lang('app.delete') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addEvent", function() {
            var newItem = $('#itemAdd').html();
            $(this).closest(".addNew").append(newItem);
            counter++;
        });
        $(document).on("click", ".removeEvent", function(event) {
            $(this).closest(".itemDelete").remove();
            counter--;
        });
    });
</script>
<?= $this->endSection() ?>