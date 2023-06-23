<div class="container-fluid">
    <div class="toggleArtList d-block d-sm-none"><i class="fa-brands fa-readme"></i></div>
    <div class="main-content">
        <div class="row">
            <div class="col-sm-3 artList">
                <div class="sidebar">
                    <div class="sidebar-section">
                        <h5>
                            <span><?= $subData['sname'] ?> syllabus</span>
                        </h5>
                        <?php if (count($matData) > 0) { ?>
                            <ul>
                                <?php $c = 1;
                                foreach ($matData as $chapter) { ?>
                                    <li>
                                        <a href="javascript:void(0)" class="chapter-dropdown text-primary" onclick="toggleChapter(this)">
                                            <div class="chapter-header d-flex justify-content-between">
                                                <span><?= $chapter['mdname'] ?></span>
                                                <i class="fa-solid fa-caret-down ms-2"></i>
                                            </div>
                                        </a>
                                        <ul class="chapter-child-list d-none">
                                            <?php foreach (array_slice($chapter, 1) as $content) { ?>
                                                <li id="<?= $content['mid'] ?>" onclick="getArtPos(this)">
                                                    <a href="<?= base_url('material/' . $catData['cslug'] . "/" . $subData['sslug'] . "/" . $content['mslug']) ?>">
                                                        <?= $c++ ?>. <?= $content['mtitle'] ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else {
                            print "<span class='text-danger'>No content found.</span>";
                        } ?>
                    </div>
                    <div class="sidebar-section text-warning text-center p-2">
                        <em>Click on the chapter name to expand or collapse it and continue reading.</em> 
                    </div>
                </div>
            </div>
            <div class="col-sm-9 artDesc">
                <div class="row">
                    <div class="col-sm-10">
                        <?php if (isset($artData) && $artData) { ?>
                        <div class="mainheading">
                            <div class="after-post-tags">
                                <ul class="tags">
                                    <li>
                                        <a href="javascript:void(0)"><?= $catData['cname'] ?></a>
                                    </li>
                                    <li>
                                        <div class="subdown">
                                            <a href="javascript:void(0)">
                                                <?= $subData['sname'] ?>
                                                <?php if (count($fetchAllSub) > 0) {
                                                    echo "<i class='fa-solid fa-caret-down'></i>";
                                                } ?>
                                            </a>
                                            <div class="subdown-content">
                                                <?php foreach ($fetchAllSub as $sub) {
                                                    echo "<a href='" . base_url('material/' . $catData['cslug'] . "/" . $sub['sslug']) . "/first" . "'>" . $sub['sname'] . "</a>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h1 class="posttitle"><?= $artData['mtitle'] ?></h1>
                        </div>
                        <div class="article-post">
                            <?php
                            if ($artData['mfile']) {
                                if (strpos(strtolower($artData['mfile']), 'pdf')) {
                                    echo "<div class='text-center my-4'><a href='" . base_url('uploads/mfile/mdoc/' . $artData['mfile']) . "' class='btn btn-primary' download>Download Full Notes</a></div>";
    
                                    echo "<embed class='mb-4' src='" . base_url('uploads/mfile/mdoc/' . $artData['mfile']) . "' type='application/pdf' width='100%' height='600px' />";
                                } else {
                                    echo "<img class='my-4' src='" . base_url('uploads/mfile/mimg/' . $artData['mfile']) . "'>";
                                }
                            }
                            ?>
                            <?= $artData['mdesc'] ?>
                        </div>
                        
                        <small class="d-flex justify-content-between">
                            <span class="text-primary"><?= date("d/m/Y, g:i a", strtotime($artData['mdate'])) ?></span>
                            <span class="text-primary">Read : <?= $pageHit ?> times</span>
                        </small>
                        <hr>
                        <!-- <div class="row PageNavigation mt-4 prevnextlinks">
                            <div class="col-md-6 rightborder pl-0">
                                <a class="thepostlink" href="single.html">« Red Riding Hood</a>
                            </div>
                            <div class="col-md-6 text-right pr-0">
                                <a class="thepostlink" href="single-right-sidebar.html">We all wait for summer »</a>
                            </div>
                        </div> -->
                        <section>
                            <div id="comments">
                                <section class="disqus">
                                    <div id="disqus_thread">
                                    </div>
                                    <script type="text/javascript">
                                        var disqus_shortname = 'rashh-in';
                                        var disqus_developer = 0;
                                        (function() {
                                            var dsq = document.createElement('script');
                                            dsq.type = 'text/javascript';
                                            dsq.async = true;
                                            dsq.src = window.location.protocol + '//' + disqus_shortname + '.disqus.com/embed.js';
                                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                        })();
                                    </script>
                                    <noscript>
                                        Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
                                    </noscript>
                                </section>
                            </div>
                        </section>
                    <?php } else {
                        print "<span class='text-danger'>This article no longer exists. It may be because you have used the wrong URL or may be removed or modified by the admin. Please choose an article to read from the syllabus.</span>";
                    } ?>
                    </div>
                    <div class="col-sm-2">
                        <div class="sidebar">
                            <div class="sidebar-section">
                                <h5><span>External Content</span></h5>
                                <img src="<?= base_url('assets/lander/images/testfree-ads.png') ?>" alt="">
                                <p class="mt-3">Create your Test or Quiz for free now with much advanced and easy to use dashboard.</p>
                                <a class="btn btn-primary w-100 mt-4" href="https://testfree.in/" target="_blank">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>