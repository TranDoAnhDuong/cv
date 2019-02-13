    
    <!-- heading -->
    <div class="heading">
        <h1 class="page-title">Wedding Blog</h1>
    </div>
    <?php foreach($data as $key){?>
        
    <!-- content photo -->
    <?php if($key->type == 'photo'){?>
    <div class="blog-item blog-<?php echo $key->type?>">
        <i class="fa fa-camera-retro" id="icon"></i>
        <div class="blog-title">
            <span class="date-text"><?php echo $key->created?></span>
            <a href="#"><?php echo $key->title?></a>
            <div class="clear"></div>
        </div>

        <img id="img" src="<?php echo base_url()?>public/img/<?php echo $key->image?>" alt="photo1" height="423" width="635" class="img-popup">
    </div>
    <div class="line"></div>
        <?php }?>  

        
    <!-- content-blog-article -->
    <?php if($key->type == 'article'){?>
    <div class="blog-item blog-<?php echo $key->type?>">
        <i class="fa fa-pagelines"></i>
        <div class="blog-title-<?php echo $key->type?>">
            <span class="date-text"><?php echo $key->created?></span>
            <a href="#"> <?php echo $key->title?></a>
            <div class="clear"></div>
        </div>

        <div class="content-paragraph">
            <p><?php echo $key->description?></p>
            <small>-Pablo Neruda</small>
        </div>
    </div>
    <div class="line"></div>
    <?php }?> 

    <!-- content-blog-diary -->
    <?php if($key->type == 'diary'){?>
    <div class="blog-item blog-<?php echo $key->type?>">
        <i class="fa fa-pencil" ></i>
        <div class="blog-title-<?php echo $key->type?>">
            <span class="date-text"><?php echo $key->created?></span>
            <a href="#"> <?php echo $key->title?></a>
            <div class="clear"></div>
        </div>

        <div class="content-<?php echo $key->type?>">
            <div class="photo2">
                <!-- <img id="img" src="<?php echo base_url()?>public/img/<?php echo $key->image?>" alt="photo1" height="466" width="311" class="img-popup"> -->
            </div>
            <div class="content-paragraph">
                <p style="font-size:16px">
                <?php echo $key->description?>
                </p>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <?php }?> 

    <!-- content quote -->
    <?php if($key->type == 'quote'){?>
    <div class="blog-item blog-<?php echo $key->type?>">
        <i class="fa fa-quote-left" ></i>
        <div class="blog-title-diary">
            <span class="date-text"><?php echo $key->created?></span>
            <a href="#"> <?php echo $key->title?></a>
            <div class="clear"></div>
        </div>

        <div class="content-quote">
            <p><?php echo $key->description?></p>
            <small>
                <cite title="Alfred Tennyson">Alfred Tennyson</cite>
            </small>
        </div>
    </div>
    <div class="line"></div>
    <?php }?> 

    <?php }?>

    <!-- overview -->
    <div class="overview">
        <a href="<?php echo site_url("weddingblog/overview")?>">Overview</a>
    </div>

<script>
$(document).ready(function() {


    $('.img-popup').click(function() {
        var pic = $(this);
        var wImg = pic.width();
        var hImg = pic.height();

        pic.removeAttr("width"); 
        pic.removeAttr("height");
        var w = pic.width();
        var h = pic.height();
        pic.attr("width", wImg + 'px');
        pic.attr("height", hImg + 'px'); 

        var width = w;
        if(w > 1500) {
            width = 1500;
        }
        height = width * (h/w);

        $('#popup, #mask').show();
        $('.popup-content').html('<img src="' + $(this).attr('src') + '" width="' + width + 'px" height="' + height + 'px" />');
        $('#popup').css({ 'margin-left': '-' + (width/2 + 20) + 'px', 'margin-top': '-' + (height/2 + 20) + 'px' })
    });

    $('#popup button').click(function() {
        $('#popup, #mask').hide();
    });

    $( window ).resize(function() {
        var wPopup = $('#popup').width();
        var hPopup =  $('#popup').height();
        if($( window ).width() < wPopup) {
            var newHeight = $( window ).width() * (hPopup/wPopup);
            $('.popup-content > img').attr("width", $( window ).width() - 40 - 40 + 'px');
            $('.popup-content > img').attr("height", (newHeight - 40) + 'px');
            $('#popup').css({ 'margin-left': '-' + ($( window ).width()/2) + 'px', 'margin-top': '-' + (newHeight/2) + 'px' })
        }
    });
});
</script>