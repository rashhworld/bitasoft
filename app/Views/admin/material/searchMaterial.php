<div class="card">
    <div class="card-header text-center">
        <h5>Your Searched Result</h5>
    </div>
    <div class="card-body">
        <?php if (count($srchMatData) > 0) { ?>
            <table class="table">
                <tbody>
                    <?php $sl = 1;
                    foreach ($srchMatData as $sm) { ?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><a href="<?= base_url('admin/material/read/' . $sm['mid']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i> <?= $sm['mtitle'] ?></a></td>
                            <td><?= $sm['cname'] ?></td>
                            <td><?= $sm['sname'] ?></td>
                            <td><?= $sm['mdname'] ?></td>
                            <td><?= $sm['mstatus'] == 1 ? "published" : "unpublished" ?></td>
                            <td><?= date("d/m/Y, g:i a", strtotime($sm['mdate'])) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/material/update/' . $sm['mid']) ?>"><i class="fa-regular fa-pen-to-square text-success"></i></a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="deleteMaterial(<?= $sm['mid'] ?>)"><i class="fa-regular fa-trash-can text-danger"></i></a>
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