<div class="card">
    <div class="card-header text-center">
        <h5>Total Blogpost</h5>
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <a class="btn btn-outline-secondary my-1" href="<?= base_url('admin/blog/') ?>">Total Post : <?= count($blogpost) ?></a>
            <a class="btn btn-outline-secondary my-1" href="<?= base_url('admin/blog?type=published') ?>">Published Post : <?= $pubBlgCount ?></a>
            <a class="btn btn-outline-secondary my-1" href="<?= base_url('admin/blog?type=unpublished') ?>">Unpublished Post : <?= $unpubBlgCount ?></a>
        </div>
        <?php if (count($blgData) > 0) { ?>
            <table class="table">
                <tbody>
                    <?php $sl = 1;
                    foreach ($blgData as $b) { ?>
                        <tr class='align-middle'>
                            <td><?= $sl++ ?></td>
                            <td><a href="<?= base_url('admin/blog/read/' . $b['bid']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i> <?= $b['btitle'] ?></a></td>
                            <td><?= $b['bstatus'] == 1 ? '<i class="fa-solid fa-check text-primary"></i>' : '<i class="fa-solid fa-xmark text-danger"></i>' ?></td>
                            <td><?= date("d/m/Y, g:i a", strtotime($b['bdate'])) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/blog/update/' . $b['bid']) ?>"><i class="fa-regular fa-pen-to-square text-success"></i></a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="deleteBlogpost(<?= $b['bid'] ?>)"><i class="fa-regular fa-trash-can text-danger"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links() ?>
        <?php } else {
            print "<span class='text-danger'>No blogpost found!</span>";
        } ?>
    </div>
</div>