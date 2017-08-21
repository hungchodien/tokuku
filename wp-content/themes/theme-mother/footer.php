
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


















        var field_custom_height = $("#field-custom-page-search");
        field_custom_height.height(
            function(){
                if($(this).width()/$(this).parent().width() <0.5){
                    ///ddaay laf lg-4
                    var field_custom_height_class = $(".field-custom");
                    var height_max = 0;
                    field_custom_height_class.each(function(){
                        var indexx = $(this).index() + 1;
                        if(height_max < $(this).height())
                            height_max = $(this).height();
                        if(indexx %3 === 0 ){
                            for(var i = indexx - 3 ; i < indexx ; i++){
                                field_custom_height_class.eq(i).find('.swap-img-description-search').height(height_max);
                            }
                            height_max = 0;
                        }
                        if(indexx === field_custom_height_class.length){
                            if(indexx % 3 === 2){
                                //alert(height_max);
                                //height_max = ( field_custom_height_class.eq(indexx -1).height() < field_custom_height_class.eq(indexx-2).height()?  field_custom_height_class.eq(indexx -1).height() :  field_custom_height_class.eq(indexx).height() );
                                //alert(height_max);
                                field_custom_height_class.eq(indexx-1).find('.swap-img-description-search').height(height_max);
                                field_custom_height_class.eq(indexx - 2 ).find('.swap-img-description-search').height(height_max);
                            }else{
                                return false;
                            }

                        }
                    });
                }else{
                    ///day laf width 100%

                }
            }
        );
        $( window ).resize(function() {
            var field_custom_height = $("#field-custom-page-search");
            field_custom_height.height(
                function(){
                    if($(this).width()/$(this).parent().width() <0.5){
                        ///ddaay laf lg-4
                        var field_custom_height_class = $(".field-custom");
                        var height_max = 0;
                        field_custom_height_class.each(function(){
                            var indexx = $(this).index() + 1;
                            if(height_max < $(this).height())
                                height_max = $(this).height();
                            if(indexx %3 === 0 ){
                                for(var i = indexx - 3 ; i < indexx ; i++){
                                    field_custom_height_class.eq(i).find('.swap-img-description-search').height(height_max);
                                }
                                height_max = 0;
                            }
                            if(indexx === field_custom_height_class.length){
                                if(indexx % 3 === 2){
                                    //alert(height_max);
                                    //height_max = ( field_custom_height_class.eq(indexx -1).height() < field_custom_height_class.eq(indexx-2).height()?  field_custom_height_class.eq(indexx -1).height() :  field_custom_height_class.eq(indexx).height() );
                                    //alert(height_max);
                                    field_custom_height_class.eq(indexx-1).find('.swap-img-description-search').height(height_max);
                                    field_custom_height_class.eq(indexx - 2 ).find('.swap-img-description-search').height(height_max);
                                }else{
                                    return false;
                                }

                            }
                        });
                    }else{
                        ///day laf width 100%

                    }
                }
            );
        });

    });
</script>
</body>
</html>
