<div class="container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-8">
                <div class="section-title">
                    <h2><span>Your searched result</h2>
                </div>
                <?php
                $num_results = 0;
                $results = '';

                foreach ($searchData as $subarr) {
                    foreach ($subarr as $item) {
                        if (isset($item["mtitle"])) {
                            $results .= "<p><i class='fa-solid fa-arrow-up-right-from-square'></i>&nbsp;<a href='" . base_url('material/' . $item['cslug'] . '/' . $item['sslug'] . '/' . $item['mslug']) . "'>" . $item['mtitle'] . "</a><br><span class='badge badge-primary'>Study Material</span></p>";
                            $num_results++;
                        } elseif (isset($item["btitle"])) {
                            $results .= "<p><i class='fa-solid fa-arrow-up-right-from-square'></i>&nbsp;<a href='" . base_url('blog/' . $item['bslug']) . "'>" . $item['btitle'] . "</a><br><span class='badge badge-primary'>Blogpost</span></p>";
                            $num_results++;
                        }
                    }
                }

                if ($num_results > 0) {
                    echo "<p class='text-primary mb-4'>" . $num_results . " result(s) found on your search term.</p>";
                    echo "<div class='article-post'>" . $results . "</div>";
                } else {
                    echo "<span class='text-danger'>No search result found. Please, try again with another keyword ...</span>";
                }
                ?>
            </div>
            <div class="col-sm-4">
                <div class="sidebar-right">
                    <div class="sidebar">
                        <div class="sidebar-section">
                            <h5><span>Recommended Material</span></h5>
                            <?php if (count($matDataRand) > 0) { ?>
                                <ul>
                                    <?php foreach ($matDataRand as $mt) { ?>
                                        <li><a href="<?= base_url('material/' . $mt['cslug'] . "/" . $mt['sslug'] . "/" . $mt['mslug']) ?>"><?= $mt['mtitle'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <span class="text-danger">No material found to read.</span>
                            <?php } ?>
                        </div>
                        <div class="sidebar-section">
                            <h5><span>Recommended Blogpost</span></h5>
                            <?php if (count($blgDataRand) > 0) { ?>
                                <ul>
                                    <?php foreach ($blgDataRand as $bd) { ?>
                                        <li><a href="<?= base_url('blog/' . $bd['bslug']) ?>"><?= $bd['btitle'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <span class="text-danger">No blogpost found to read.</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>