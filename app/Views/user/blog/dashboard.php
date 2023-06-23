<div class="container">
    <div class="main-content">
        <section class="recent-posts row">
            <div class="col-sm-8">
                <div class="section-title">
                    <h2><span>Featured Blogpost</span></h2>
                </div>
                <?php if (count($blogpost) > 0) { ?>
                    <div class="masonrygrid row listrecent">
                        <?php foreach ($blogpost as $bp) { ?>
                            <div class="col-md-6 grid-item">
                                <div class="card">
                                    <a href="<?= base_url('blog/' . $bp['bslug']) ?>">
                                        <img class="img-fluid rounded" src="<?= base_url('uploads/bimg/' . $bp['bimg']) ?>">
                                    </a>
                                    <div class="card-block">
                                        <h2 class="card-title"><a href="<?= base_url('blog/' . $bp['bslug']) ?>"><?= $bp['btitle'] ?></a></h2>
                                        <div class="metafooter">
                                            <div class="wrapfooter">
                                                <span class="author-meta">
                                                    <span class="post-name"><a href="javascript:void(0)">By Admin</a></span><br />
                                                    <span class="post-date"><?= date("d/m/Y, g:i a", strtotime($bp['bdate'])) ?></span>
                                                </span>
                                                <span class="post-read-more"><a href="<?= base_url('blog/' . $bp['bslug']) ?>" title="Read Story"><i class="fa-solid fa-eye fa-beat-fade"></i></a></span>
                                                <div class="clearfix">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else {
                    print "<span class='text-danger'>No blogpost found to read!</span>";
                } ?>
            </div>
            <div class="col-sm-4">
                <div class="sidebar">
                    <div class="sidebar-section">
                        <h5><span>Latest Blogpost</span></h5>
                        <?php if (count($blgData) > 0) { ?>
                            <ul>
                                <?php foreach ($blgData as $bd) { ?>
                                    <li><a href="<?= base_url('blog/' . $bd['bslug']) ?>"><?= $bd['btitle'] ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <span class="text-danger">No blogpost found to read.</span>
                        <?php } ?>
                    </div>
                    <div class="sidebar-section">
                        <h5><span>Latest Study Material</span></h5>
                        <?php if (count($matData) > 0) { ?>
                            <ul>
                                <?php foreach ($matData as $md) { ?>
                                    <li><a href="<?= base_url('material/' . $md['cslug'] . "/" . $md['sslug'] . "/" . $md['mslug']) ?>"><?= $md['mtitle'] ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <span class="text-danger">No material found to read.</span>
                        <?php } ?>
                    </div>
                    <div class="sidebar-section">
                        <h5><span>External Content</span></h5>
                        <img src="<?= base_url('assets/lander/images/testfree-ads.png') ?>" alt="">
                        <p class="mt-3">Create your Test or Quiz for free now with much advanced and easy to use dashboard.</p>
                        <a class="btn btn-primary w-100 mt-4" href="https://testfree.in/" target="_blank">Explore Now</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>