<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1><?= $title ?></h1>
            <?php $validation = \Config\Services::validation() ?>
            <?php if ($validation->getError('image')) : ?>
                <span class="badge badge-danger"> <?= $errors = $validation->getError('image') ?></span>
            <?php endif ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card rounded p-5">
                    <div id="success"></div>
                    <?= form_open_multipart('web/signature') ?>
                    <div class="row mx-1">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="media mb-2">
                                            <input type="hidden" name="id" value="<?= $image['id'] ?>">
                                            <input type="file" name="link" id="picha" onchange="readURL(this)" style="display: none;">
                                            <label class="mr-1" for="picha">
                                                <img src="<?= $image['link'] != null ? base_url($image['link']) : base_url('app-assets/images/no-image.jpg') ?>" alt="carousel" id="img" class="users-avatar-shadow" height="350" width="550">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $image['id'] ?>">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-lg btn-primary"><?= lang('app.edit') ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector("#img").setAttribute("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>