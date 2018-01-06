
 <?php foreach ($this->oPosts as $oPost): ?>
<div class="col-xs-12 col-sm-12 col-md-12">   
  
       <div class="row col-xs-12 col-sm-12 col-md-12 wall-blog-btm-banner hmBtm">
                                <a href="#" rel=" noopener noreferrer" class="blog-poster">
                                    <span><?=$oPost->AuthorName?></span>
                                </a>
                                
                                <span class="blog-postdate">
                                    <span><?=$oPost->DateUpdated?></span></span>
            <?php if($oPost->IsConsultation>0): ?>                    
                <img src="images/ic_consultation.png" />
<?php endif; ?>

                            </div>
    <a href="<?=ROOT_URL?>?p=blog&amp;a=answerpost&amp;id=<?=$oPost->AnswerId?>">
    <p><?=nl2br(htmlspecialchars(mb_strimwidth($oPost->Answer, 0, 200, '...')))?></p>
    </a>
</div>
        
    <?php endforeach ?>
