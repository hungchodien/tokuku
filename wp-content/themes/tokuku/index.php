<?php get_header(); ?>
<!--close slider -->
<div class="container pd0i mg0i" > <!--1180-->
    <div class="row pd0i mg0i">
        <span class="Co_use_cupcard_title">
            銀聯カードを使える企業リスト
        </span>
        <div class=" Co_use_cupcard_content">
            <?php $logo = json_decode(do_shortcode('[tdrSlider slug="logo-company-cup-card" option="1" width="980" height="320" order="DESC" orderby="date"]')) ;?>
            <div class="tbale_co_company">
                <?php $keyh = 0; for($i = 0 ; $i < count($logo); $i++){
                    if(isset($logo[$i]->url_path_resize)) {
                        ?>
                        <span class="<?php echo ($keyh >= 3 ? "pci": "") ?>" >
                                    <img src="<?php echo $logo[$i]->url_path_resize ?>" alt="fv"/>
                                </span>
                        <?php $keyh++;
                    }

                } ?>
            </div>
            <div class="button-submit-final mobile" >
                <input class="button-submit-final-input" type="submit" value="すべての企業リストを見る">
            </div>
        </div>

        <div class="search-ajax" id="search-ajjax-company">
            <span class="title">地域、業種などで条件を絞り、検索することができます。</span>
            <div class="select-search-ajax">
                <div class="dropdown dropdown-ajax">
                    <button class="area"
                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        地域を選択
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action 1</a>
                        <a class="dropdown-item" href="#">Another action 1</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <div class="dropdown dropdown-ajax">
                    <button class="category"
                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        業種カテゴリーを選択
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action2</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <div class="dropdown dropdown-ajax">
                    <button class=" company"
                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        企業を選択
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action3</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>

            </div>
            <div class="button-submit-final" >
                <input class="button-submit-final-input button-submit-final-input-red" type="submit" value="上記の条件で検索">
            </div>
        </div>
    </div>
</div><!--end container-->
<hr>
<div class="container pd0i mg0i">
    <div class="row pd0i mg0i">
        <div class="tour_infor">
            <span class="title">
                <?php echo $buildType = get_post_meta($post->ID, 'build_type_id', true); ?>
                東北6県 観光情報
            </span>
            <span class="description">
                東北地方には、祭り、景勝地、郷土食など、国内外の旅行者に知ってほしい、そして、体験してほしい魅力ある観光資源が数多くあります。
国内外の多くの皆様にとって東北の魅力を知り、実際に訪れるきっかけとなることを願っています。
ぜひ、皆様も東北を訪れ、その魅力を台家してください。
            </span>
            <div class="content clear">
                <?php $terms = get_terms( array(
                    'taxonomy' => 'tourirt-tokuku-area',
                    'hide_empty' => false,  ) );
                foreach($terms as $key => $term){
                    //////////////////////////////resize ảnh ;;;;;
                    $img_terms = get_term_meta( $term->term_id , 'wpcf-img' );
                    $img_term_src= $img_terms[0];
                    $width=365;
                    $height=243;
                    $image = aq_resize($img_term_src,$width,$height, true );
                    if(empty($image)):
                        $image = $img[0];
                    endif;
                    //////////////////////////////resize ảnh ;;;;;
                    //$mobile = ($key%2 == 0? "le" : "chan");
                    ?>
                    <div class="<?php echo ($key%3 == 0 ? "content_img_box $mobile clear": ($key % 3 == 1? "content_img_box $mobile clear" : "content_img_box $mobile clear"));?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $term->name ?>">
                        <p class="title_area clear">
                            <a class="box" href="<?php echo get_term_link($term->slug, 'tourirt-tokuku-area'); ?>">
                                <?php echo $term->name; ?>
                            </a>
                            <a href="<?php echo get_term_link($term->slug, 'tourirt-tokuku-area'); ?>">
                                <span class="character"> ❯  </span>
                            </a>
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="submit-button-img" >
                <input class="button-submit-final-input button-submit-final-input-blue" type="submit" value="上記の条件で検索">
            </div>
            <div class="hotel-introduce" style="display: none!important;">
                <h2 class="infor-hotel-content">
                    さらにお得なクーポン情報！
                </h2>
                <div class="clear">
                    <div class="img-3div fl">
                        <?php $img_hotel = json_decode(do_shortcode(' [tdrSlider slug="hotel_img_introduce" option="1" width="980" height="320" order="DESC" orderby="date"]')) ;?>
                        <?php
                        foreach ($img_hotel as $key => $img_hotels){
                            if(!empty($img_hotels)){
                                ?>
                                <div class="<?php echo ($key == 1 ?"largest":($key == 2 ? "medium":"small"));?>"
                                     style="background-image: url('<?php echo $img_hotels->url_path_resize;?>')"></div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="description-hotel fr">
                        <div class="description-hotel-text clear">
                            東北地方の対象ホテルにて宿泊のお客様において、
                            税込10,000円以上の銀聯カードをご利用の際に
                            1会計辺り1,000円OFF！
                        </div>
                        <div class="submit-button-img-hotel clear" >
                            <input class="button-submit-final-input button-submit-final-input-green" type="submit" value="もっと詳しく見る">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

