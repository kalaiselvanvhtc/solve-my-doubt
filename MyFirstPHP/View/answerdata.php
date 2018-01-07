
 <?php foreach ($this->oPosts as $oPost): ?>
<div class="col-xs-12 col-sm-12 col-md-12 paddingL0 paddingR0 borderbottom padding20">   
  
       <div class="row col-xs-12 col-sm-12 col-md-12">
                                <a href="#" rel=" noopener noreferrer" class="blog-poster">
                                    <span><?=$oPost->AuthorName?></span>
                                </a>
                                
                                <span class="blog-postdate">
                                    <span><?=$oPost->DateUpdated?></span></span></div>
           <div class="row col-xs-12 col-sm-12 col-md-12 marginT20">
       <div class="col-xs-10 col-sm-10 col-md-10 paddingL0">
                       
                <a class="content_answer" href="<?=ROOT_URL?>?p=blog&amp;a=answerpost&amp;id=<?=$oPost->AnswerId?>">
    <p><?=nl2br(htmlspecialchars(mb_strimwidth($oPost->Answer, 0, 200, '...')))?></p>
    </a>
                </div>
                      <div class="col-xs-2 col-sm-2 col-md-2 paddingR0">

            <?php if($oPost->IsConsultation>0): ?>                    
                <img class="consult_img" src="images/ic_consultation.png" />
<?php endif; ?>
</div>
</div>
     

</div>
        
    <?php endforeach ?>
