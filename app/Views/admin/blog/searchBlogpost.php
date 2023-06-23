<div class="card">
    <div class="card-header text-center">
        <h5>Your Searched Result</h5>
    </div>
    <div class="card-body">
        <?php if (count($srchBlgData) > 0) { ?>
            <table class="table">
                <tbody>
                    <?php $sl = 1;
                    foreach ($srchBlgData as $sb) { ?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><a href="<?= base_url('admin/blog/read/' . $sb['bid']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i> <?= $sb['btitle'] ?></a></td>
                            <td><?= $sb['bstatus'] == 1 ? "published" : "unpublished" ?></td>
                            <td><?= date("d/m/Y, g:i a", strtotime($sb['bdate'])) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/blog/update/' . $sb['bid']) ?>"><i class="fa-regular fa-pen-to-square text-success"></i></a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="deleteBlogpost(<?= $sb['bid'] ?>)"><i class="fa-regular fa-trash-can text-danger"></i></a>
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