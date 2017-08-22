
<footer>
    <div id="footer">
        <img class="left-footer" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo_phone_footer.png" alt = "logo_phone_footer" />
        <span class="left-footer" >A Global Payment Network</span>
        <img class="right-footer" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt = "<?php bloginfo( 'name' ); ?>">
        <p class="right-footer">
            ©2002-2017 Copyright UnionPay international
        </p>
    </div>
</footer><!-- .site-footer -->

<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("img.lazy-load").lazyload({
            effect : "fadeIn"
        });

        var options = {
            type: "delay",
            time: 1000,
            scripts: [
                "https://connect.facebook.net/en_EN/all.js#xfbml=1",
                "https://apis.google.com/js/plusone.js",
                "https://platform.twitter.com/widgets.js",
                "https://static.mixi.jp/js/share.js",
                "https://b.st-hatena.com/js/bookmark_button.js"
            ],
            success: function () {
                FB.init({ appId: '899176063532614', status: true, cookie: true, xfbml: true });
            }
        };
        $.lazyscript(options);

    });

</script>
<script>
    jQuery(document).ready(function($) {





        $(".slide").fadeImages({
            //arrows: true,
            complete: function() {
                $(this).parent().find('div').removeClass('psStatic').removeClass('first').addClass('psAbsolute');
                $(this).addClass('psStatic');
            }
        });

        $(".content_img_box").each(function(){
            var tile = 365/243;
            $(this).height( $(this).width() / tile);
        });
        $( window ).resize(function() {
            $(".content_img_box").each(function(){
                var tile = 365/243;
                $(this).height( $(this).width() / tile);
            });
        });
        $(".content-area").each(function(){
            $(this).height($(this).find('.content-area-item').height() + 10);
        });

        $(".content .collum").each(function(){
            var tile = 365/243;
            $(this).height( $(this).width() / tile);
        });
        $( window ).resize(function() {
            $(".content .collum").each(function(){
                var tile = 365/243;
                $(this).height( $(this).width() / tile);
            });
        });

        $('select#area').change(function() {
            var url_ajax=$('#ajax_request').val();
            var name_group = 'swap-3-selectbox';
            var id = $(this).val();
            var type_option = $(this).attr("id");
            var slug = $(this).attr('data-slug');
            ////gọi ajax tương ứng
            $.ajax({
                type : 'POST',
                "dataType": "json",
                data : ({
                    'action': 'getdata_ajax',
                    'name_group' : name_group,
                    'type_option' : type_option,
                    'id' : id,
                    'data-slug' : slug
                }),
                url : url_ajax,
                success: function(data) {
                    $('select#company').html(data['congty']);
                    //$('select#nganh').html(data['nganh']);
                    $("#vung-form").val($("select#area option:selected").val());
                    $("#nganh-form").val($("select#nganh option:selected").val());
                }
            });

        });
        $('select#nganh').change(function() {
            var url_ajax=$('#ajax_request').val();
            var name_group = 'swap-3-selectbox';
            var id = $(this).val();
            var type_option = $(this).attr("id");
            var slug = $(this).attr('data-slug');
            ////gọi ajax tương ứng
            $.ajax({
                type : 'POST',
                "dataType": "json",
                data : ({
                    'action': 'getdata_ajax',
                    'name_group' : name_group,
                    'type_option' : type_option,
                    'id_nganh' : id,
                    'id_area' : $('select#area').val(),
                    'data-slug' : slug
                }),
                url : url_ajax,
                success: function(data) {
                    $('select#company').html(data['congty']);
                    //console.log(data);
                    $("#vung-form").val($("select#area option:selected").val());
                    $("#nganh-form").val($("select#nganh option:selected").val());
                }
            });
        });
        $('select#company').on('change', function() {
            var selected = this.value;
            window.location.replace(selected);
        });


    });
</script>
</body>
</html>
