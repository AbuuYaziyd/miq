<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="content-body">
	<section class="row flexbox-container">
		<div class="col-12 d-flex align-items-center justify-content-center">
			<div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
				<div class="card border-grey border-lighten-3 m-0">
					<div class="card-header border-0">
						<div class="card-title text-center">
							<div>
                                <a href="<?= base_url() ?>"><img src="<?= base_url('app-assets/images/logo/logo.svg') ?>" alt="logo" height="180px"></a>
                            </div>
						</div>
						<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span><?= lang('app.maintainance') ?></span>
						</h6>
					</div>
					<div class="card-body text-center">
						<h1><?= lang('app.maintainance') ?></h1>
						<h4><?= lang('app.disturb') ?></h4>
						<div class="mt-2"><i class="la la-cog spinner font-large-2"></i></div>
					</div>
					<div class="card-footer">
						<div class="text-center">
							<div class="text-center"><a href="#"><?= lang('app.soon') ?></a></div>
							<!-- <p class="float-xl-left text-center m-0"><a href="<?= base_url('recover') ?>" class="card-link"><?= lang('app.recoverpassword') ?></a></p> -->
							<!-- <p class="float-xl-right text-center m-0"><?= lang('app.newUser') ?> <a href="<?= base_url('register') ?>" class="card-link"><?= lang('app.signup') ?></a></p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
<?= $this->endSection() ?>