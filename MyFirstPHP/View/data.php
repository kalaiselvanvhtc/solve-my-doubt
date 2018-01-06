
 <?php foreach ($this->oPosts as $oPost): ?>
<div class="contcolumn col-xs-12 col-sm-5 col-md-5">   
    <h3><a href="<?=ROOT_URL?>?p=blog&amp;a=post&amp;id=<?=$oPost->id?>"><?=htmlspecialchars($oPost->title)?></a></h3>
        <p><?=nl2br(htmlspecialchars(mb_strimwidth($oPost->body, 0, 200, '...')))?></p>
        
        <div class="pull-left"> <ul class="list-row-tags">
            <?php foreach (explode(',', $oPost->Tag) as $tag): ?>
            <li><a href="#"><?=$tag?></a></li>
    <?php endforeach ?>
</ul></div> 
        <div class="row col-xs-12 col-sm-12 col-md-12 wall-blog-btm-banner hmBtm">
                                <span class="blog-post">By </span>
                                <a href="#" rel=" noopener noreferrer" class="blog-poster">
                                    <span><?=$oPost->AuthorName?></span>
                                </a>
                                
                                <span class="blog-postdate">
                                    <span><?=$oPost->createdDate?></span></span>



                            </div>
</div>
        
    <?php endforeach ?>
