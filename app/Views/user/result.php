<!-- <?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-2"><?= lang('app.find') ?></h3>
                <?= form_open('user/result') ?>
                <div class="row">
                    <div class="col-md-10">
                        <fieldset class="form-group form-group">
                            <select class="custom-select" name="exId" id="exId">
                                <?php foreach ($sem as $key => $data) : ?>
                                    <option <?= ($data['id'] > $user['level']  ? 'style="display: none"' : '') ?><?= ($data['id'] == $user['level']  ? 'selected' : '') ?> value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-danger btn-block round box-shadow-1 pull-right"><?= lang('app.look') ?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?> -->