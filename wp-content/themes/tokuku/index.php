<?php get_header(); ?>
<!--close slider -->
<div class="container" > <!--1180-->
    <div class="row">
        <div class="col-xs-12">
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
                    <input class="button-submit-final-input button-submit-final-input-red" id="search-ajjax-company" type="submit" value="すべての企業リストを見る">
                </div>
            </div>
            <div class="search-ajax" >
                <p class="title">地域、業種などで条件を絞り、検索することができます。</p>
                <div class="row">
                    <div class="swap-3-selectbox">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 swap-select-box-ajax-search">
                            <select class="form-control select-box-ajax-data " id="area">
                                <?php
                                ///load all area
                                $terms = get_terms( array(
                                    'taxonomy' => 'tourirt-tokuku-area',
                                    'hide_empty' => false,  ) );
                                foreach($terms as $key => $term){
                                    ?>
                                    <option data-id-area="<?php echo $term->term_id ;?>" value="<?php echo $term->term_id ;?>"><?php echo $term->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 swap-select-box-ajax-search">
                            <select class="form-control select-box-ajax-data " id="area">

                                <?php
                                ///load all area
                                $terms = get_terms( array(
                                    'taxonomy' => 'tourirt-tokuku-category',
                                    'hide_empty' => false,  ) );
                                foreach($terms as $key => $term){
                                    ?>
                                    <option data-id-area="<?php echo $term->term_id ;?>" value="<?php echo $term->term_id ;?>">
                                        <?php echo $term->name; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12  swap-select-box-ajax-search right">
                            <select class="form-control select-box-ajax-data " id="area">
                                <?php
                                $args = array(
                                    'post_type' => 'cong-ty',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'tourirt-tokuku-category',
                                            'operator' => 'EXISTS'
                                        ),
                                    ),
                                );
                                $query = new WP_Query( $args );
                                foreach ($query->posts as $key => $value){
                                    ?>
                                    <option data-id-area="" value=""><?php echo $value->post_title ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="ajax-success"></div>
                <div class="button-submit-final" >
                    <input class="button-submit-final-input button-submit-final-input-red" id="Search-company" type="submit" value="上記の条件で検索">
                </div>
            </div>
        </div>
    </div>
</div><!--end container-->
<hr>
<div class="container">
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
        <div class="row content">
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
                $classPc = $key %3 ;
                switch ($classPc) {
                    case 0:
                        $classPc = "leftPC";
                        break;
                    case 1:
                        $classPc = "centerPC";
                        break;
                    case 2:
                        $classPc = "rightPC";
                        break;
                    default:
                        $classPc = "";
                }
                $classMb = $key %2 ;
                switch ($classMb) {
                    case 0:
                        $classMb = "leftMb";
                        break;
                    case 1:
                        $classMb = "rightMb";
                        break;
                    default:
                        $classMb = "";
                }
                ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 <?php echo $classPc." ".$classMb; ?> box-content-img">
                    <img src="<?php echo $image; ?>" alt="<?php echo $term->name ?>">
                    <p class="title_area <?php echo "title_area".$classPc." title_area".$classMb; ?>">
                        <a class="box" href="<?php echo get_term_link($term->slug, 'tourirt-tokuku-area'); ?>">
                            <?php echo $term->name; ?>
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
    </div>
</div>
<div class="hotel-introduce">
    <div class="container">
        <h2 class="infor-hotel-content">
            さらにお得なクーポン情報！
        </h2>
        <div class="row">
            <div class="img-3div col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <?php $img_hotel = json_decode(do_shortcode(' [tdrSlider slug="hotel_img_introduce" option="1" width="980" height="320" order="DESC" orderby="date"]')) ;?>
                <?php
                $keyh = 0;
                ?>
                <div class="clear">
                    <?php
                    foreach ($img_hotel as $key => $img_hotels){
                        if(!empty($img_hotels)){
                            if($keyh == 0){
                                $width= 265;
                                $height=264;
                            }else {
                                $width=191;
                                $height=132;
                            }
                            $img_term_src = $img_hotels->url_path_resize;
                            $image = aq_resize($img_term_src ,$width,$height, true );
                            if(empty($image)):
                                $image = $img_term_src;
                            endif;
                            $keyh++;
                            ?>
                            <div class="   <?php echo ($key == 1 ?"largest fl":($key == 2 ? "medium fl":"small fl"));?>" >
                                <img src="<?php echo $image;?>" alt="">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="S-img-3div  col-lg-6 col-sm-6  col-md-6 col-xs-12">
                <div class="description-hotel">
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

<?php get_footer(); ?>

