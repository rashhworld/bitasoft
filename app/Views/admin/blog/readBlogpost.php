<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $artData['btitle'] ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="artDesc">
                            <?php if ($artData['bimg']) echo "<img src='" . base_url('uploads/bimg/' . $artData['bimg']) . "'>"; ?>
                            <div><?= $artData['bdesc'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-3">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h5>Recommended Blogpost</h5>
                        </div>
                        <div class="card-body">
                            <?php if (count($blogpost) > 0) { ?>
                                <div class="row g-3">
                                    <?php foreach ($blogpost as $b) { ?>
                                        <a href="<?= base_url('admin/blog/read/' . $b['bid']) ?>"><i class="fa-regular fa-hand-point-right"></i> <?= $b['btitle'] ?></a>
                                    <?php } ?>
                                </div>
                            <?php } else {
                                print "<span class='text-danger'>No blog found!</span>";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>