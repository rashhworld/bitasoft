<section class="intro">
    <div class="wrapintro">
        <h2 class="lead">Themed specifically for students who keeps keen interest in technology and are in need of complete explanatory content.</h2>
        <a href="#explore" class="btn">Get Started</a>
    </div>
</section>

<div class="container">
    <div class="main-content">
        <section class="recent-posts row">
            <div class="col-sm-8">
                <div class="section-title" id="explore">
                    <h2><span>Things to Explore</span></h2>
                </div>
                <?php if (count($catData) > 0) { ?>
                    <div class="masonrygrid row listrecent">
                        <?php
                        foreach ($catData as $ct) { ?>
                            <div class="col-md-6 grid-item">
                                <div class="card">
                                    <img class="img-fluid rounded" src="<?= base_url('uploads/cimg/' . $ct['category']['cimg']) ?>">
                                    <div class="card-block">
                                        <h2 class="card-title"><?= $ct['category']['cname'] ?></h2>
                                        <h4 class="card-text"><?= $ct['category']['cdesc'] ?></h4>
                                    </div>
                                    <?php if (strpos(strtolower($ct['category']['cname']), 'blog') !== false) { ?>
                                        <a class="btn btn-primary" href="<?= base_url('blog') ?>">Read Blogs</a>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" id="subdown" data-toggle="dropdown">Choose your subject</button>
                                        <div class="dropdown-menu" aria-labelledby="subdown">
                                            <?php if (count($ct['subjects']) > 0) {
                                                foreach ($ct['subjects'] as $sb) { ?>
                                                    <a class="dropdown-item" href="<?= base_url('material/' . $ct['category']['cslug'] . "/" . $sb['sslug'] . "/first") ?>"><?= $sb['sname'] ?></a>
                                            <?php }
                                            } else {
                                                print "<span class='text-danger px-2'>No subject found ...</span>";
                                            } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else {
                    print "<span class='text-danger'>No catagory found to read!</span>";
                } ?>
            </div>
            <div class="col-sm-4">
                <div class="sidebar">
                    <div class="sidebar-section">
                        <h5><span>Latest Material</span></h5>
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