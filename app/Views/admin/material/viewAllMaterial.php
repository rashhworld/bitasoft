<div class="card">
    <div class="card-header text-center">
        <h5>View Material</h5>
    </div>
    <div class="card-body">
        <div class="row g-5 mb-3" id="viewAllMaterial">
            <div class="col-md-5">
                <div class="row g-2">
                    <div class="col-md-4">
                        <a class="btn btn-outline-secondary w-100" href="<?= base_url('admin/material/') ?>">Total Post : <?= count($material) ?></a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-outline-secondary w-100" href="<?= base_url('admin/material?type=published') ?>">Published : <?= $pubMatCount ?></a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-outline-secondary w-100" href="<?= base_url('admin/material?type=unpublished') ?>">Unpublished : <?= $unpubMatCount ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <form class="row g-2 sortnfilterMat">
                    <div class="col-md-3">
                        <select class="form-select" name="cid" id="cid" onchange="fetchSubject('.sortnfilterMat', this)">
                            <?php foreach ($catagory as $c) { ?>
                                <option value="" selected disabled hidden>Choose Catagory</option>
                                <option value="<?= $c['cid'] ?>"><?= $c['cname'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="sid" id="sid" onchange="fetchModule('.sortnfilterMat', this, 'view')">
                            <option value="" selected disabled hidden>Choose Subject</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="mdid" id="mdid">
                            <option value="" selected disabled hidden>Choose Module</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-outline-primary w-100" onclick="sortnfilterMat('Arrange')">Arrange</button>
                        <button class="btn btn-outline-primary w-100" onclick="sortnfilterMat('Filter')">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="d-flex gap-2 mb-2 text-danger">
            <p for="plim">Show</p>
            <select class="border" id="plim">
                <option value="" selected disabled hidden><?= $plim ?></option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="<?= $countMatData ?>">All (<?= $countMatData ?>)</option>
            </select>
            <p>Results</p>
        </div>
        <?php if (count($matData) > 0) { ?>
            <table class="table">
                <tbody>
                    <?php $sl = 1;
                    foreach ($matData as $m) { ?>
                        <tr class='align-middle' id="<?= $m['mid'] ?>">
                            <td><?= $sl++ ?></td>
                            <td><a href="<?= base_url('admin/material/read/' . $m['mid']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i> <?= $m['mtitle'] ?></a></td>
                            <td><?= $m['cname'] ?></td>
                            <td><?= $m['sname'] ?></td>
                            <td><?= $m['mdname'] ?></td>
                            <td><?= $m['mstatus'] == 1 ? '<i class="fa-solid fa-check text-primary"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>' ?></td>
                            <td><?= date("d/m/Y, g:i a", strtotime($m['mdate'])) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/material/update/' . $m['mid']) ?>"><i class="fa-regular fa-pen-to-square text-success"></i></a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="deleteMaterial(<?= $m['mid'] ?>)"><i class="fa-regular fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links() ?>
        <?php } else {
            print "<span class='text-danger'>No material found!</span>";
        } ?>
    </div>
</div>