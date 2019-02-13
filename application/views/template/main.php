<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url()?>public/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/guestbook.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/overview.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/partyaddress.css">
    <!-- partyaddress -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/wishlist.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="background">
        <div class="container-main">

            <!-- header -->
            <div class="header">
                <div class="all-title">
                    <a href="#" class="logo">
                        <i class="fa fa-heart"></i>
                    </a>
                    <div class="title">
                        <a href="#">Maria and Paul's Wedding</a>
                    </div>
                    <div class="subTitle">
                        Welcome to our website
                    </div>
                </div>
            </div>
            <!-- menu bar -->
            <div class="menu">
                <ul>

                    <li class="active">
                        <a href="<?php echo site_url("weddingblog")?>">Wedding Blog </a>
                    </li>


                    <li>
                        <a href="<?php echo site_url("PhotoAlbum")?>">Photo Album</a>
                    </li>


                    <li>
                        <a href="<?php echo site_url("WishList")?>">Wishlist</a>
                    </li>


                    <li>
                        <a href="<?php echo site_url("GuestBook")?>">Guestbook</a>
                    </li>

                    <li>
                        <a href="<?php echo site_url("PartyAddress")?>">Party Address</a>
                    </li>
                </ul>
            </div>

            <div class="container">
                <div class="content fl">
                    <!-- content -->
                    <?php $this->load->view($view_name); ?>
                </div>
                <!-- content fr -->
                <div class="sidebar fr">
                    <div class="content-fr">

                 

                        <h4> Share this page</h4>
                        <div data-href="https://developers.facebook.com/docs/plugins/">
                            <i class="fa fa-facebook-square"></i>
                            <a href="javascript:void(0)" onClick="facebookShare()">Share on Facebook</a>
                        </div>
                        <div>
                            <i class="fa fa-twitter-square"></i>
                            <a href="javascript:void(0)" onClick="twitterShare()">Share on Twitter</a>
                        </div>
                        <div>
                            <i class="fa fa-google-plus-square"></i>
                            <a href="javascript:void(0)" onClick="googleShare()">Share on Google+</a>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="a-line">
                <hr>
            </div>


            <div class="footer-page-counter">
                <a href="#">Created with SimpleSite</a>
                <div class="view">
                    <span class="footer-page-counter-item">0</span>

                    <span class="footer-page-counter-item">6</span>

                    <span class="footer-page-counter-item">5</span>

                    <span class="footer-page-counter-item">2</span>

                    <span class="footer-page-counter-item">3</span>

                    <span class="footer-page-counter-item">7</span>

                </div>


            </div>
            <div class="hide" style="display: none"></div>
            <div id="popup">
                <button>X</button>
                <div class="popup-content"></div>
            </div>
            <div id="mask"></div>
        </div>
    </div>
<script>
    function openPopup(url, w, h) {
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;
        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        window.open(url, '_blank', 'location=yes,height='+h+',width='+w+',scrollbars=yes,status=yes,top='+top+',left='+left)
    }
    
    function facebookShare() {
        openPopup("https://www.facebook.com/sharer/sharer.php?u=http://www.simplesite.com/us-123wedding",520, 570);
    }

    function twitterShare(){
        openPopup("https://twitter.com/intent/tweet?text=http://www.simplesite.com/us-123wedding/",409, 409);
        
    }

    function googleShare(){
        openPopup("https://plus.google.com/share?url=http://www.simplesite.com/us-123wedding/",436, 692);
        
    }
</script>



</body>

</html>