<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $artData['mtitle'] ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="artDesc">
                            <?php
                            if ($artData['mfile']) {
                                if (strpos(strtolower($artData['mfile']), 'pdf')) {
                                    echo "<div class='text-center my-4'><a href='" . base_url('uploads/mfile/mdoc/' . $artData['mfile']) . "' class='btn btn-primary' download>Download Full Notes</a></div>";

                                    echo "<embed src='" . base_url('uploads/mfile/mdoc/' . $artData['mfile']) . "' type='application/pdf' width='100%' height='600px' />";
                                } else {
                                    echo "<img src='" . base_url('uploads/mfile/mimg/' . $artData['mfile']) . "'>";
                                }
                            }
                            ?>
                            <div><?= $artData['mdesc'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-3">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h5>Recommended Material</h5>
                        </div>
                        <div class="card-body">
                            <?php if (count($material) > 0) { ?>
                                <div class="row g-3">
                                    <?php foreach ($material as $m) { ?>
                                        <a href="<?= base_url('admin/material/read/' . $m['mid']) ?>"><i class="fa-regular fa-hand-point-right"></i> <?= $m['mtitle'] ?></a>
                                    <?php } ?>
                                </div>
                            <?php } else {
                                print "<span class='text-danger'>No material found!</span>";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>