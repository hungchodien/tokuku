<?php get_header(); ?>
<div class="line">
    <span>ホーム </span><span> 観光情報 </span><span> 福島県 </span><span> スパリゾートハワイアンズ </span>
</div>
<div class="container" id="detail-torist-page">
    <div class="row rs" >
        <div class="col-xs-12 ">
            <div class="title">
                <p>
                    <?php the_title(); ?>
                </p>
            </div>
            <div class="text-description">
                <?php
                $queried_object = get_queried_object();

                $vung = get_the_terms($queried_object->ID, 'tourirt-tokuku-area');
                $nganh = get_the_terms($queried_object->ID, 'tourirt-tokuku-category');
                ?>
                <div class="category">
                    <?php


                    ///hiện tịa load thumbnail của 1 vùng thôi
                    for ($key = 0 ; $key < count($vung) ; $key++){
                        ?>
                        <h6 class="vung" >
                            <a   href="<?php echo get_term_link($vung[$key]->term_id , 'tourirt-tokuku-area'); ?>">
                                <?php echo $vung[$key]->name; ?>
                            </a>
                        </h6>
                        <?php
                    }

                    for ($key = 0 ; $key < count($nganh) ; $key++){
                        $term_color = types_render_termmeta("color", array( "term_id" => $nganh[$key]->term_id  ));
                        ?>
                        <h6 class="nganh" style="color: #<?php echo $term_color; ?>; border-color: #<?php echo $term_color; ?>">
                            <a style="color: #<?php echo $term_color; ?>; ?>" href="<?php echo get_term_link($nganh[$key]->term_id , 'tourirt-tokuku-category'); ?>">
                                <?php echo $nganh[$key]->name; ?>
                            </a>
                        </h6>
                        <?php
                    }
                    ?>
                </div>


            </div>
            <div class="content-tourist-page">
                <div class="thumbnail-tourist">
                    <?php
                    $img_thumb = get_term_meta( $vung[0]->term_id , 'wpcf-img', true );
                    $width=980;
                    $height=572;
                    $image = aq_resize($img_thumb,$width,$height, true );
                    if(empty($image)):
                        $image = $img_thumb;
                    endif;
                    ?>
                    <img src="<?php echo get_term_meta( $vung[0]->term_id , 'wpcf-img', true ); ?>"  alt="">
                </div>
                <div class="except">
                    <?php echo get_the_excerpt(); ?>
                </div>
                <div class="list" >
                    <hr class="clear_margin_hr" style="border-top: #<?php echo $term_color; ?> solid 1px; ">
                    <div class="dia-diem-tourist-page ">
                        <p class="title" style="color: #<?php echo $term_color; ?>; ?>">
                            所在地
                        </p>
                        <p class="text">福島県いわき市常磐藤原町蕨平50</p>
                    </div>
                    <div class="so-dien-thoai-tourist-page">
                        <p class="title" style="color: #<?php echo $term_color; ?>; ?>">
                            お問い合わせ電話番
                        </p>
                        <p class="text">0570-550-550（ナビダイヤル）</p>
                    </div>
                    <div class="ung-dung-tourist-page">
                        <p class="title" style="color: #<?php echo $term_color; ?>; ?>">
                            応募団体
                        </p>
                        <p class="text">福島県いわき市（ふくしまけんいわきし）、いわき観光まちづくりビューロー（いわきかんこうまちづくりびゅーろー）</p>
                    </div>
                    <hr class="clear_margin_hr_foooter" style="border-top: #<?php echo $term_color; ?> solid 1px; ">
                </div>
                <div class="list" >





                    <div class="dia-diem-tourist-page padding85B">
                        <p class="title" style="color: #<?php echo $term_color; ?>; ?>">
                            生ハム切り落とし cách 1
                        </p>
                        <div class="swaper-img-page-tourist">
                            <?php
                            ///get thông tin multi của multi.
                            $getposst = get_post_meta($queried_object->ID , 'wpcf-thong-tin-tour');
                            foreach ($getposst as $value){
                                echo $value;
                            }
                            ?>
                            <div class="swaper-img-page-tourist" style="display: none!important">

                            </div>
                        </div>
                    </div>
                    <div class="dia-diem-tourist-page padding85B">
                        <p class="title" style="color: #<?php echo $term_color; ?>; ?>">
                            生ハム切り落とし cách 2
                        </p>
                        <div class="swaper-img-page-tourist">
                            <?php
                            ///get thông tin multi của multi.
                            $kitucat = '&#DTR228#&';
                            $getposst = get_post_meta($queried_object->ID , 'wpcf-html-hien-thi-noi-dung-1-multi');

                            foreach ($getposst as $value ){
                                $split = explode($kitucat, $value);
                                ?>
                                <div class="img-post-field-tourist-page clear">
                                    <div class="fl fix-width-left">
                                        <?php
                                        $img_thumb = $split[0];
                                        $width=74;
                                        $height=74;
                                        $image = aq_resize($img_thumb,$width,$height, true );
                                        if(empty($image)):
                                            $image = $img_thumb;
                                        endif;

                                        ?><img src="<?php echo $image; ?>" class="img-circle" alt="Cinque Terre" width="74" height="74">

                                    </div>
                                    <div class="fl fix-width-right">
                                        <div class="title-field-tour-page">
                                            <?php echo $split[1]; ?>
                                        </div>
                                        <div class="description-field-tour-page">
                                            <?php echo $split[2]; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

