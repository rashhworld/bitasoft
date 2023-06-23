<?php if (count($catagory) > 0) { ?>
    <div class="catagory row row-cols-1 row-cols-md-4 g-4 mt-1" id="updateCatPos">
        <?php foreach ($catagory as $ct) { ?>
            <div class="col" id="<?= $ct['cid'] ?>">
                <div class="card">
                    <img src="<?= base_url('uploads/cimg/' . $ct['cimg']) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title mb-4 fw-bold"><?= $ct['cname'] ?></p>
                        <p class="card-text"><?= $ct['cdesc'] ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <a class="text-primary" href="javascript:void(0)" onclick="viewUpdateCatagory('#updateCatagoryModal', <?= $ct['cid'] ?>)">Edit catagory</a>&emsp;&emsp;
                            <a class="text-danger" href="javascript:void(0)" onclick="deleteCatagory(<?= $ct['cid'] ?>)">Delete catagory</a>
                        </small>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } else {
    print "No catagory found!";
} ?>

<!-- Catagory Modal -->
<div class="modal fade" id="updateCatagoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Catagory</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="col-md-12 d-none">
                        <input type="text" class="form-control" id="cid" name="cid">
                    </div>
                    <div class="col-md-12">
                        <label for="cname" class="form-label">Update Catagory Name</label>
                        <input type="text" class="form-control" id="cname" name="cname">
                    </div>
                    <div class="col-md-12">
                        <label for="cimg" class="form-label">Update Catagory Image</label>&emsp;<span id="imgExist"></span>
                        <input type="file" class="form-control" id="cimg" name="cimg">
                    </div>
                    <div class="col-md-12">
                        <label for="cdesc" class="form-label">Update Catagory Description</label>
                        <textarea class="form-control" id="cdesc" name="cdesc" style="height:100px"></textarea>
                    </div>
                    <div class="col-md-12 mt-5">
                        <button class="btn btn-outline-primary w-100" type="submit" onclick="updateCatagory('#updateCatagoryModal')">Update Catagory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>