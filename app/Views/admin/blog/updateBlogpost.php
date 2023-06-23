<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header fw-bold">
                Update BlogPost
            </div>
            <div class="card-body">
                <form class="row g-4 updateBlogpost">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="bid" value="<?= $blgData['bid'] ?>">
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="btitle" value="<?= $blgData['btitle'] ?>">
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control advTextarea" name="bdesc"><?= $blgData['bdesc'] ?></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="bimg" class="form-label">Update blog primary image</label>
                        <?php if ($blgData['bimg']) { ?>
                            <i class="fa-regular fa-image"></i>
                        <?php } ?>
                        <input type="file" class="form-control" name="bimg" id="bimg">
                    </div>
                    <div class="col-md-4">
                        <label for="bstatus" class="form-label">Update blog publishing status</label>
                        <select class="form-select" name="bstatus" id="bstatus">
                            <option value="<?= $blgData['bstatus'] ?>" selected hidden><?= $blgData['bstatus'] == '1' ? "published" : "unpublished" ?></option>
                            <option value="1">Publish Now</option>
                            <option value="0">Save as Draft</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label invisible">.</label>
                        <button class="btn btn-success w-100" onclick="updateBlogpost('.updateBlogpost')">Review and Update Blogpost</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>