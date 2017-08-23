
<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div class="line">
    <span> <a href="<?php echo get_option('home'); ?>">ホーム </a> </span>
    <span><?php
        $query = new WP_Query( array( 'page_id' => 126 ) );
        ?>
        <?php echo $query->post->post_name; ?>
    </span>
</div>
    <div class="container">
        <div class="row option-width-row taxonomy-page">
            <div id="page-search" class="">
                <div class="promotion-title">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="name_website">UnionPay
                                <?php echo get_bloginfo(); ?>
                            </div>
                            <div class="promotion-header">
                                東北 北海道 キャンペーン クーポン券
                            </div>
                            <div class="promotion-date">
                                2017. 9/1 fri 〜 11/30 thu
                            </div>
                            <div class="promotion-box">対象ホテルにてお会計より1,000円引き。 </div>
                        </div>

                        <div class="col-md-3 col-sm-3 ">
                            <div style="position: relative; min-height: 150px">
                                <img src="<?php echo get_stylesheet_directory_uri() ?>/img/promotion.png" ">
                            </div>
                            <div class="promotion-description">仙台・宮城観光PRキャラクター
                                むすび丸</div>
                        </div>
                    </div>
                </div>
                <div class="promotion-content">
                    <div class="promotion-content-title">特別クーポン 対象店舗</div>

                    <?php
                    $args = array(
                        'post_type' => 'dich-vu-khuyen-mai'
                    );
                    $query = new WP_Query( $args );
                    while ($query->have_posts()): $query->the_post();
                        $img_term_src1 = get_post_meta($query->post->ID, 'wpcf-hinh-khuyen-mai-2');
                        $width1=296;
                        $height1=161;
                        $image1 = aq_resize($img_term_src1[0],$width1,$height1, true );
                        if(empty($image1)):
                            $image1 = $img_term_src1[0];
                        endif;
                        $img_term_src = get_post_meta($query->post->ID, 'wpcf-hinh-khuyen-mai');
                        $width=296;
                        $height=40;
                        $image = aq_resize($img_term_src[0],$width,$height, true );
                        if(empty($image)):
                            $image = $img_term_src[0];
                        endif;
                        ?>
                        <div class="promotion-content-description clear">
                            <div class="fl width40">
                                <img src="<?php echo $image; ?>" width="100%" alt="">
                                <img src="<?php echo $image1; ?>" width="100%" alt="" >
                            </div>
                            <div class="fl width60 ">
                                <div class="promotion-content-absolute">
                                    <div class="promotion-content-decription-title">
                                        <?php $title = get_post_meta($query->post->ID, 'wpcf-tieu-de-khuyen-mai'); echo $title[0]; ?>
                                    </div>
                                    <div class="promotion-content-dscription-content">
                                        <p>住所</p><p>
                                            <?php $dia_chi_nha_o = get_post_meta($query->post->ID, 'wpcf-dia-chi-nha-o'); echo $dia_chi_nha_o[0]; ?>
                                        </p>
                                    </div>
                                    <div class="promotion-content-dscription-content">
                                        <p>TEL</p><p>
                                            <?php $so_lien_lac_khuyen_ma = get_post_meta($query->post->ID, 'wpcf-so-lien-lac-khuyen-mai'); echo $so_lien_lac_khuyen_ma[0]; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>

                </div>
                <div class="promotion-footer">
                    <div class="promotion-footer-title">
                        クーポンの使い方
                    </div>
                    <div class="promotion-footer-description clear">
                        <span  class="promotion-footer-description-icon">
                            ※
                        </span>
                        <span class="promotion-footer-description-text">このクーポンは、UnionPay 東北 北海道キャンペーンに参加している対象ホテルでのみ有効です。クーポンはチェックアウト時に銀聯カードご利用の際に1万円以上のお会計で一枚のみ使うことができます。</span>
                    </div>
                    <div class="promotion-footer-description clear">
                        <span class="promotion-footer-description-icon">
                            ※
                        </span>
                        <span class="promotion-footer-description-text">このクーポンの有効期間は2017/9/1~2017/11/30です。</span>
                    </div>
                    <div class="promotion-footer-description clear">
                        <span  class="promotion-footer-description-icon">
                            ※
                        </span>
                        <span class="promotion-footer-description-text">現金との交換はできません。クーポンのコピーは無効です。</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php get_footer(); ?>
