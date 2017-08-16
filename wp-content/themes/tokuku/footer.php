
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
        ////
        //console.log(1111111111111);
        $(".button-submit-final-input-red").click(function(){
            var url_ajax=$('#ajax_request').val();
            $.ajax({

                type : 'POST',
                dataType:'html',
                data : ({
                    'action': 'mysss_action_ajax1',
                    'var' : 'ten_thuong_hieu'
                }),
                url : url_ajax,
                success: function(data) {
                    $('.ajax-success').html(data);
                    //console.log(resp);
                }
            });
        });

    });
</script>
</body>
</html>
