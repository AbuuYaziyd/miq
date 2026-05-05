<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 offset-md-2 mb-4">
        <form>
            <div class="input-group">
                <input type="search" onkeyup="mySearch()" id="search" class="form-control form-control-lg" placeholder="<?= lang('app.find') ?>">
            </div>
        </form>
    </div>
</div>
<div class="row" id="div">
    <?php foreach ($stu as $key => $dt) : ?>
        <div class="col-md-4 col-12">
            <div class="card profile-card-with-stats">
                <div class="text-center">
                    <div class="card-body">
                        <img src="<?= $dt['avatar'] != null ? base_url($dt['avatar']) : base_url('app-assets/images/avatar/av' . ($dt['sex'] != 'M' ? 'f' : '') . '.png') ?>" class="rounded-circle  height-150" alt="avatar">
                    </div>
                    <div class="card-body">
                        <span class="mute"><?= $dt['kun_yah'] ?> | <?= $dt['kun_yah_ar'] ?></span>
                        <h3 class="profile text-center"><b><?= $dt['name'] ?> <?= $dt['mname'] ?> <?= $dt['lname'] ?></b><br></h3>
                        <h5></h5>
                        <h3 class="profile text-center"><b><?= $dt['name_ar'] ?> <?= $dt['mname_ar'] ?> <?= $dt['lname_ar'] ?></b><br></h3>
                        <hr>
                        <?php if (session('role') == 'admin') : ?>
                            <ul class="list-inline list-inline-pipe">
                                <li>
                                    <a href="tel:+255<?= $dt['phone'] ?>" class="btn btn-outline-info btn-sm round" target="_blank">
                                        <i class="icon-call-out"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:<?= $dt['email'] ?>" class="btn btn-outline-purple btn-sm round" target="_blank">
                                        <i class="icon-envelope"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://wa.me/255<?= str_replace(' ', '', $dt['phone']) ?>" class="btn btn-outline-success btn-sm round" target="_blank">
                                        <i class="la la-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="sms:+255<?= str_replace(' ', '', $dt['phone']) ?>" class="btn btn-outline-secondary btn-sm round" target="_blank">
                                        <i class="icon-speech"></i>
                                    </a>
                                </li>
                            </ul>
                            <h5><b><a href="<?= base_url('student/page/' . $dt['id']) ?>" class="btn round btn-outline-black"><?= $dt['username'] ?></a></b></h5>
                        <?php elseif ($dt['sex'] == session('sex')) : ?>
                            <ul class="list-inline list-inline-pipe">
                                <li>
                                    <a href="tel:+255<?= $dt['phone'] ?>" class="btn btn<?= $dt['phone'] == null ? '-outline' : '' ?>-info btn-sm round">
                                        <i class="icon-call-out"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:<?= $dt['email'] ?>" class="btn btn<?= $dt['email'] == null ? '-outline' : '' ?>-purple btn-sm round">
                                        <i class="icon-envelope"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:<?= $dt['email'] ?>" class="btn btn<?= $dt['email'] == null ? '-outline' : '' ?>-purple btn-sm round">
                                        <i class="icon-envelope"></i>
                                    </a>
                                </li>
                            </ul>
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