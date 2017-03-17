        <div class="container">
            <div class="row news-header">
                <span>Latest News</span>
                <span><a href="<?php echo site_url('news'); ?>">Archive</a></span>
            </div>

            <div class="row news-block">
<?php foreach ($news as $news_item): ?>
                <div class="col-md-3">
                    <h4><a href="<?php echo site_url('news/'.$news_item['slug']) . '">' . $news_item['title']; ?></a></h4>
                    <h5><?php echo date('d-M-Y H-i', strtotime($news_item['timestamp'])); ?></h5>
                    <div>
                        <?php echo $news_item['text']; ?>
                    </div>
                </div>
<?php endforeach; ?>
            </div>
        </div>