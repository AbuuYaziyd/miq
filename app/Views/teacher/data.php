<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 mb-4">
        <form>
            <div class="input-group">
                <input type="search" onkeyup="mySearch()" id="search" class="form-control form-control-lg" placeholder="<?= lang('app.find') ?>">
            </div>
        </form>
    </div>
    <div class="col-md-3 mb-4">
        <a href="<?= base_url('teacher/add') ?>" class="btn btn-lg btn-block btn-primary"><?= lang('app.newTeacher') ?></a>
    </div>
</div>
<div class="row" id="div">
    <?php foreach ($teacher as $key => $dt) : ?>
        <div class="col-md-4 col-12">
            <div class="card profile-card-with-stats">
                <div class="text-center">
                    <div class="card-body">
                        <img src="<?= $dt['avatar'] != null ? base_url($dt['avatar']) : base_url('app-assets/images/avatar/av.png') ?>" class="rounded-circle  height-150" alt="avatar">
                    </div>
                    <div class="card-body">
                        <span class="mute"><?= $dt['kun_yah'] ?> | <?= $dt['kun_yah_ar'] ?></span>
                        <h3 class="profile text-center"><b><?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?></b></h3>
                        <h3 class="profile text-center"><b><?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?></b></h3>
                        <hr>
                        <?php if (session('role') == 'admin') : ?>
                            <ul class="list-inline list-inline-pipe">
                                <?php if ($dt['phone'] != null) : ?>
                                    <li>
                                        <a href="tel:+255<?= $dt['phone'] ?>" class="btn btn-primary btn-sm round" target="_blank">
                                            <i class="icon-call-out"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://wa.me/255<?= str_replace(' ', '', $dt['phone']) ?>" class="btn btn-success btn-sm round" target="_blank">
                                            <i class="la la-whatsapp"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="sms:+255<?= str_replace(' ', '', $dt['phone']) ?>" class="btn btn-pink btn-sm round" target="_blank">
                                            <i class="ft ft-navigation"></i>
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <span class="btn btn-outline-primary btn-sm round">
                                            <i class="icon-call-out"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="btn btn-outline-success btn-sm round">
                                            <i class="la la-whatsapp"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="btn btn-outline-pink btn-sm round">
                                            <i class="ft ft-navigation"></i>
                                        </span>
                                    </li>
                                <?php endif ?>
                                <?php if ($dt['email'] != null) : ?>
                                    <li>
                                        <a href="mailto:<?= $dt['email'] ?>" class="btn btn-warning btn-sm round" target="_blank">
                                            <i class="icon-envelope"></i>
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <span class="btn btn-outline-warning btn-sm round">
                                            <i class="icon-envelope"></i>
                                        </span>
                                    </li>
                                <?php endif ?>
                            </ul>
                            <h5><b><a href="<?= base_url('teacher/page/' . $dt['id']) ?>" class="btn round btn-outline-black"><?= $dt['username'] ?></a></b></h5>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<script>
    function mySearch() {
        var input, filter, cards, cardContainer, title, i, search;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("div");
        cards = cardContainer.getElementsByClassName("card");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".profile")

            if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    };
    $(document).ready(function() {
        alert(cards.length);
    });
</script>
<?= $this->endSection() ?>