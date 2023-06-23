<div class="row g-4 mb-3">
    <div class="col-md-6">
        <div class="d-flex gap-2">
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
    </div>
    <div class="col-md-6">
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

<?php if (count($matData) > 0) { ?>
    <table class="table">
        <tbody id="updateMatPos">
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
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
<?php } else {
    print "<span class='text-danger'>No material found!</span>";
} ?>