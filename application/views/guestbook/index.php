<script src="<? echo base_url();?>public/js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="<? echo base_url();?>public/css/jquery.Jcrop.css" type="text/css" />

<div class="guestbook">
    <div class="content-heading">
        <h3 class="title">Guestbook</h3>
        <button type="button" class="add">Add a message-Click here!
            <button>
    </div>

    <div id="input">
        <div class="add-content">
            <h3>Add a message</h3>
            <button type="close" id="close">x</button>
        </div>
        <form action="<? echo base_url();?>index.php/guestbook/feedback" method="post" enctype="multipart/form-data">
        <div class="input">
            <div style="display:inline-block">
                <textarea name="message" class="inp inp-textarea required" maxlength="1500" placeholder="Write your message here"></textarea>
                <span>Field is missing</span>
                <input name="name" type="text" class="inp required" placeholder="Write your name here" />
                <span>Field is missing</span>
                <input name="email" type="text" class="inp required" placeholder="Write your email here" />
                <span>Field is missing</span>
                <input name="website" type="text" class="inp" placeholder="Your website address, if you have a website" />

                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="hidden" id="img" name="img" />
                <input type="hidden" id="rotate" name="rotate" value="0"/>

            </div>
            <div id="preview" class="inp button-content" style="border-style:dashed">
                <button type="button" class="add-image">Add image</button>
                <input type="file" name="fileToUpload" id="input-file" style="display:none" />
            </div>
            <div style="clear:both"></div>
        </div>

        <div class="send">
            <button type="submit" id="send">Send - Click here</button>
        </div>
        </form>
    </div>
    <div style="clear:both"></div>

    <?php foreach($data as $row){?>
    <div class="content-main">
    <?php if($row->img != ""){?>
        <div class="header">
            <p class="author"><?php echo $row->name?></p>
            <a href="">Email</a>
            <p class="date"><?php echo $row->date?></p>
        </div>
        <div class="sub-content">
            <img class= "img" src="<?php echo base_url()?>public/uploads/<?php echo $row->img?>" alt="Smiley face">
            <p><?php echo $row->message?></p>
        </div>
    <?php }else{?>
        <div>
        
            <div class="header">
                <p class="author"><?php echo $row->name?></p>
                <a href="">Email</a>
                <p class="date"><?php echo $row->date?></p>
            </div>
            <p style="margin-bottom: 30px"><?php echo $row->message?></p>
        </div>
        <?php }?>
    </div>
    <?php }?>

</div>
<div id="fixed-picture" style="display:none;">
    <div id="mask-upload"></div>
    <div class="upload-file">
        <div class="header">
            <button type="button" id="exit">x</button>
            <h3>Image Tools
            </h3>
        </div>
        <hr style="margin:0px"/>
        <div class="content-img">
            <img id="target" src="" alt="Smiley face" style="max-height: 352px"></img>
        </div>
        <hr style="margin:0px"/>
        <div class="feature" style="margin: 10px 15px;">
            <button class="faf button left" type="button"> <i class="fa fa-undo" aria-hidden="true"></i></button>
            <button class="faf button right" type="button"><i class="fa fa-repeat" aria-hidden="true"></i></button>
            <button class="faf btn btn-upload" id="upload" type="button">Upload</button>
            <button class="faf btn cancel" type="button">Cancel</button>
        </div>
    </div>
</div>

<canvas id="c" style="display: none"/>
<script>
$(document).ready(function () {
    $("#input").css('display', 'none');

    $("#close").click(function () {
        $("#input").css('display', 'none')
    });


    $(".add").click(function () {
        $("#input").css('display', 'block')
    });

    $("input[name='email']").keyup(function(event){
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (testEmail.test($(this).val())){
            $(this).removeClass('error');
            $(this).next().css('visibility', 'hidden');
        }else{
            $(this).addClass('error');
            $(this).next().css('visibility', 'visible');
        }
    });

    $("textarea[name='message'], input[name='name']").keyup(function (event) {
        var value = $(this).val();
        if (value !== '') {
            $(this).removeClass('error');
            $(this).next().css('visibility', 'hidden');
        } else {
            $(this).addClass('error');
            $(this).next().css('visibility', 'visible');
        }
    });

    $('#send').click(function(){
        $('.required').each(function() {
            var value = $(this).val();
            if (value !== '') {
                $(this).removeClass('error');
                $(this).next().css('visibility', 'hidden');
                $('form').attr('onsubmit','return true');
            } else {
                $(this).addClass('error');
                $(this).next().css('visibility', 'visible');
                $('form').attr('onsubmit','return false');
            }
        });
    });

    $('.add-image').click(function () {
        $('#input-file').trigger('click');
    });

    var deg = 0;
    var jcrop_api;
    var degrees = 0;
    function rotateBase64Image(dimesion) {
        var base64data = $('#target').attr('src');
        var canvas = document.getElementById("c");
        var ctx = canvas.getContext("2d");

        var image = new Image();
        image.src = base64data;
        image.onload = function() {
            canvas.width = image.width;
            canvas.height = image.height;
            ctx.translate(image.width/2, image.height/2);
            var rotate = parseInt($('#rotate').val());
            if(dimesion === 'right') {
                ctx.rotate(Math.PI / 2);
                rotate -= 90;
                if(rotate < -270) {
                    rotate = 0;
                }

            } else {
                ctx.rotate(- Math.PI / 2);
                rotate += 90;
                if(rotate > 270) {
                    rotate = 0;
                }
            }

            if(rotate < 0) {
                rotate = 360 + rotate;
            }
            $('#rotate').val(rotate);
            ctx.drawImage(image, -image.width/2, -image.height/2);
            $('#target').attr('src', canvas.toDataURL());
            reloadImg();
        };
        
    }

    function reloadImg() {
        jcrop_api.destroy();
        setTimeout(function() {
            $('#target').Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords,
                height: 400
            }, function(){
                jcrop_api = this;
            });
        }, 500);
    }

    $(".button.left").on("click", function() {
        rotateBase64Image('left');
    });

    
    $(".button.right").on("click", function() {
        rotateBase64Image('right');
    });

    $('#exit , .cancel').click(function(){
        $('#fixed-picture').hide();
        $('#input-file').val('');
        jcrop_api.destroy();
    });

    var files;
    $('.btn-upload').click(function(){
        $('#fixed-picture').hide();
        
        var formData = new FormData();

        $.each($('#input-file')[0].files, function(i, file) {
            formData.append('fileToUpload', file);
        });

        formData.append('x', $('#x').val());
        formData.append('y', $('#y').val());
        formData.append('w', $('#w').val());
        formData.append('h', $('#h').val());
        formData.append('rotate', $('#rotate').val());

        $.ajax({
            type: "POST",
            url: "<? echo base_url();?>index.php/guestbook/upload_file",
            success: function (data) {
                var result = JSON.parse(data);
                $('#img').val(result.file_name);
                $('#preview').html('<img src="<? echo base_url();?>public/uploads/' + result.file_name + '" id="imgx" style="max-width:321px"/>');
            },
            error: function (error) {
                // handle error
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });



    });

    function updateCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };

    $('#input-file').change(function() {
        $('#fixed-picture').show();
        if(this.files && this.files[0]) {
            files = this.files[0];
            $('#target').attr('src', '');
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#target').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            setTimeout(function() {
                $('#target').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    height: 400
                }, function(){
                    jcrop_api = this;
                });
            }, 500);
        }
    });


});
</script>
