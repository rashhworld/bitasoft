<div class="row justify-content-center">
    <div class="col-md-10">
        <form class="row g-4 updateMaterial" autocomplete="off">
            <div class="col-md-8">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" name="mid" value="<?= $matData['mid'] ?>">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="mtitle" value="<?= $matData['mtitle'] ?>">
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control advTextarea" name="mdesc"><?= $matData['mdesc'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row g-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="mfile" class="form-label">Update material image/file</label>
                                    <?php if ($matData['mfile']) { ?>
                                        <a class="text-danger" href="javascript:void(0)" onclick="removeMatFile(<?= $matData['mid'] ?>)">(Remove <?= strpos(strtolower($matData['mfile']), 'pdf') ? "pdf" : "image"; ?>)</a>
                                    <?php } ?>
                                    <input type="file" class="form-control" name="mfile" id="mfile">
                                </div>
                                <div class="col-md-12">
                                    <label for="cid" class="form-label">Choose material catagory</label>
                                    <?php if (count($catagory) > 0) { ?>
                                        <select class="form-select" name="cid" id="cid" onchange="fetchSubject('.updateMaterial', this)">
                                            <option value="<?= $matData['cid'] ?>" selected hidden><?= $matData['cname'] ?></option>
                                            <?php foreach ($catagory as $ct) { ?>
                                                <option value="<?= $ct['cid'] ?>"><?= $ct['cname'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else {
                                        print "<br><span class='text-danger'>No catagory found.</span>";
                                    } ?>
                                </div>
                                <div class="col-md-12">
                                    <label for="sid" class="form-label">Choose material subject</label>
                                    <select class="form-select" name="sid" id="sid" onchange="fetchModule('.updateMaterial', this, 'view')">
                                        <option value="<?= $matData['sid'] ?>" selected hidden><?= $matData['sname'] ?></option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="mdid" class="form-label">Choose material module</label>
                                    <select class="form-select" name="mdid" id="mdid">
                                        <option value="<?= $matData['mdid'] ?>" selected hidden><?= $matData['mdname'] ?></option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="mstatus" class="form-label">Update material status</label>
                                    <select class="form-select" name="mstatus" id="mstatus">
                                        <option value="<?= $matData['mstatus'] ?>" selected hidden><?= $matData['mstatus'] == '1' ? "published" : "unpublished" ?></option>
                                        <option value="1">Publish Now</option>
                                        <option value="0">Save as Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <button class="btn btn-success w-100" onclick="updateMaterial('.updateMaterial')">Review and Update Material</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>