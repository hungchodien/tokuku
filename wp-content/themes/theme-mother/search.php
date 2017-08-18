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
        <span>ホーム > 銀聯カードを使える企業リスト > 青森県 </span>
    </div>
<div class="container">
    <div class="row">
        <div id="page-search" class="rs">

            <div class="title">
                <p>
                    銀聯カードを使える企業リスト <?php echo $_POST['vung-form']; ?>
                </p>
            </div>
            <div class="except">
                <div class="text-left">
                    青森県の企業リスト
                </div>
                <div class="btn-right">
                    <input type="submit" value="上記の条件で検索" class="button-submit-final-input button-submit-final-input-red" id="Search" />
                </div>
            </div>

            <div class="row row-custom">
                <?php
                if(isset($_POST['vung-form']) ){
                    $args = array(
                        'post_type' => 'cong-ty',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'tourirt-tokuku-area',
                                'field' => 'id',
                                'terms' => $_POST['vung-form'],
                                'operator' => 'in'
                            ),
                        ),
                    );
                    $loop_area = new WP_Query($args);
                    $id_company_arr = array();
                    $strCompany_return = '';
                    if($loop_area->have_posts()){
                        $key = 0;
                        while ($loop_area->have_posts()){

                            $loop_area->the_post();
                            ///load thumbnail
                            $img_thumb = get_the_post_thumbnail_url($loop_area->post->ID);
                            $width=315;
                            $height=194;
                            $image = aq_resize($img_thumb,$width,$height, true );
                            if(empty($image)):
                                $image = $img_thumb;
                            endif;
                            ?>
                            <div class="col-lg-4 field-custom">
                                <img src="<?php echo $image; ?>" alt="">
                                <div class="text-description">
                                    <div class="category">
                                        <h6 class="vung">
                                            青森県
                                        </h6>
                                        <h6 class="nganh">
                                            業種
                                        </h6>
                                    </div>
                                    <div class="company-name">
                                        企業名が入ります。
                                    </div>
                                    <div class="event-description">
                                        お得情報を簡単に説明するテキストが入りま
                                        す。例：最大20% OFF!!
                                    </div>
                                </div>
                            </div>
                            <?php
                            $key++;
                        }
                    }
                }
                ?>

                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>