<div class="card-body">
  <div class="row row-cols-1 row-cols-md-5 g-4">
    <div class="col">
      <a href="<?= base_url('admin/catagory') ?>">
        <div class="card card-1 border-0 text-center text-white">
          <div class="card-body">
            <h5 class="card-title fs-1"><?= count($catagory) ?></h5>
            <p class="card-text">Total Catagory</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col">
      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewSubjectModal">
        <div class="card card-2 border-0 text-center text-white">
          <div class="card-body">
            <h5 class="card-title fs-1"><?= count($subject) ?></h5>
            <p class="card-text">Total Subject</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col">
      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewModuleModal">
        <div class="card card-3 border-0 text-center text-white">
          <div class="card-body">
            <h5 class="card-title fs-1"><?= count($module) ?></h5>
            <p class="card-text">Total Module</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col">
      <a href="<?= base_url('admin/material') ?>">
        <div class="card card-4 border-0 text-center text-white">
          <div class="card-body">
            <h5 class="card-title fs-1"><?= count($material) ?></h5>
            <p class="card-text">Total Material Post</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col">
      <a href="<?= base_url('admin/blog') ?>">
        <div class="card card-5 border-0 text-center text-white">
          <div class="card-body">
            <h5 class="card-title fs-1"><?= count($blogpost) ?></h5>
            <p class="card-text">Total Blog Post</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<hr class="my-4">
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card border-0">
      <div class="card-header border">
        <h5>Latest Study Post</h5>
      </div>
      <?php if (count($matData) > 0) { ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Article Title</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($matData as $m) { ?>
              <tr>
                <td><a href="<?= base_url('admin/material/read/' . $m['mid']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i> <?= $m['mtitle'] ?></a></td>
                <td>
                  <a href="<?= base_url('admin/material/update/' . $m['mid']) ?>"><i class="fa-regular fa-pen-to-square text-success"></i></a>&nbsp;&nbsp;
                  <a href="javascript:void(0)" onclick="deleteMaterial(<?= $m['mid'] ?>)"><i class="fa-regular fa-trash-can text-danger"></i></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else {
        print "<span class='text-danger'>No material found!</span>";
      } ?>
    </div>
  </div>
  <div class="col">
    <div class="card border-0">
      <div class="card-header border">
        <h5>Latest Blog Post</h5>
      </div>
      <?php if (count($blgData) > 0) { ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Article Title</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($blgData as $b) { ?>
              <tr>
                <td><a href="<?= base_url('admin/blog/read/' . $b['bid']) ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i> <?= $b['btitle'] ?></a></td>
                <td>
                  <a href="<?= base_url('admin/blog/update/' . $b['bid']) ?>"><i class="fa-regular fa-pen-to-square text-success"></i></a>&nbsp;&nbsp;
                  <a href="javascript:void(0)" onclick="deleteBlogpost(<?= $b['bid'] ?>)"><i class="fa-regular fa-trash-can text-danger"></i></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else {
        print "<span class='text-danger'>No blogpost found!</span>";
      } ?>
    </div>
  </div>
</div>