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
    <?php foreach ($stu as $key => $data) : ?>
        <div class="col-md-4 col-12">
            <div class="card profile-card-with-stats">
                <div class="text-center">
                    <div class="card-body">
                        <img src="https://ui-avatars.com/api/?name=<?= $data['name_ar'] ?? $data['lname'] ?>&background=random&length=1&font-size=0.7" class="rounded-circle  height-150" alt="avatar">
                    </div>
                    <div class="card-body">
                        <h5><?= ($data['kun_yah'] ?? '') ?></h5>
                        <h3><b><?= ($data['name_ar'] ?? '') ?></b><br></h3>
                        <h4 class="profile"><?= $data['name'] . ' ' . $data['lname'] ?><br></h4>
                        <hr>
                        <?php if ($_SESSION['role'] == 'admin' ) : ?>
                        <ul class="list-inline list-inline-pipe">
                            <li>
                                <a href="tel:+255<?= $data['phone'] ?>" class="btn btn-outline-info btn-sm round">
                                    <i class="icon-call-out"></i>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:<?= $data['email'] ?>" class="btn btn-outline-purple btn-sm round">
                                    <i class="icon-envelope"></i>
                                </a>
                            </li>
                        </ul>
                        <h5><b><a href="<?= base_url('students/info/'.$data['id']) ?>" class="btn round btn-outline-black"><?= $data['malaf'] ?></a></b></h5>
                        <?php elseif ($data['sex'] == $_SESSION['sex'] ) : ?>
                        <ul class="list-inline list-inline-pipe">
                            <li>
                                <a href="tel:+255<?= $data['phone'] ?>" class="btn btn<?= $data['phone']==null?'-outline':'' ?>-info btn-sm round">
                                    <i class="icon-call-out"></i>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:<?= $data['email'] ?>" class="btn btn<?= $data['email']==null?'-outline':'' ?>-purple btn-sm round">
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