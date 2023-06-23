<div class="container-fluid">
    <div class="toggleArtList d-block d-sm-none"><i class="fa-brands fa-readme"></i></div>
    <div class="main-content">
        <div class="row">
            <div class="col-sm-3 artList">
                <div class="sidebar">
                    <div class="sidebar-section">
                        <h5><span>Latest Blogpost</span></h5>
                        <?php if (count($blgData) > 0) { ?>
                            <ul>
                                <li>
                                    <ul>
                                        <?php foreach ($blgData as $bd) { ?>
                                            <li id="<?= $bd['bid'] ?>" onclick="getArtPos(this)">
                                                <a href="<?= base_url('blog/' . $bd['bslug']) ?>"><?= $bd['btitle'] ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <span class="text-danger">No blogpost found to read.</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 artDesc">
                <div class="row">
                    <div class="col-sm-9">
                        <?php if ($artData) { ?>
                            <div class="mainheading">
                                <h1 class="posttitle"><?= $artData['btitle'] ?></h1>
                            </div>
                            <div class="article-post">
                                <?php if ($artData['bimg']) {
                                    echo "<img class='my-4' src='" . base_url('uploads/bimg/' . $artData['bimg']) . "'>";
                                } ?>
                                <?= $artData['bdesc'] ?>
                            </div>
                            
                            <small class="d-flex justify-content-between">
                                <span class="text-primary"><?= date("d/m/Y, g:i a", strtotime($artData['bdate'])) ?></span>
                                <span class="text-primary">Read : <?= $pageHit ?> times</span>
                            </small>
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
                    <div class="col-sm-3">
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