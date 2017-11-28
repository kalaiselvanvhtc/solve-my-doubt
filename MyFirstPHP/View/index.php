<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */


/**
 * Since PHP 5.4, the echo short tag "<?= ?> is always available, so I use it to simplify the visibility of the template
*/
?>
<?php require 'inc/header.php' ?>


<?php if (empty($this->oPosts)): ?>
    <p class="bold">There is no Blog Post.</p>
    <p><button type="button" onclick="window.location='<?=ROOT_URL?>?p=blog&amp;a=add'" class="bold">Add Your First Blog Post!</button></p>
<?php else: ?>
    <div  id="post-data">
<?php include('data.php'); ?>
    </div>
<?php endif ?>

<?php require 'inc/footer.php' ?>
<div class="ajax-load text-center" style="display:none">

    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>

</div>


<script type="text/javascript">
var offSet = 1;
    $(window).scroll(function() {

        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            loadMoreData();

        }

    });


    function loadMoreData(){

      $.ajax(

            {

                url: '/MyFirstPHP/index.php?offSet=' + offSet,

                type: "get",

                beforeSend: function()

                {

                    $('.ajax-load').show();

                }

            })

            .done(function(data)

            {

                $('.ajax-load').hide();

                $("#post-data").append(data);
                offSet++;

            })

            .fail(function(jqXHR, ajaxOptions, thrownError)

            {

                  alert('server not responding...');

            });

    }

</script>


