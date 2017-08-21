
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
    <span>ホーム </span><span> 観光情報 </span><span> 青森県 </span>
</div>
<div class="container">
    <div class="row option-width-row taxonomy-page">
        <div id="page-search" class="rs">

            <div class="title">
                <p>
                    東北6県 観光情報
                </p>
            </div>
            <div class="except">
                <div class="text-left">
                    <?php
                    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                    echo $term->name;
                    ?>
                </div>

            </div>

            <div class="row row-custom">
                <?php
                $args = array(
                    'post_type' => 'tourist',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tourirt-tokuku-area',
                            'field' => 'id',
                            'terms' => $term->term_id,
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
                        ///nếu ngành tồn tại khi post thì cần kiểm tra, nếu post thuộc ngành này thì hiện không thì dẹp
                        ///load thumbnail
                        $img_thumb = get_the_post_thumbnail_url($loop_area->post->ID);
                        $width=315;
                        $height=194;
                        $image = aq_resize($img_thumb,$width,$height, true );
                        if(empty($image)):
                            $image = $img_thumb;
                        endif;
                        ?>
                        <div class="col-md-4 field-custom" id="field-custom-page-search">
                            <div class="swap-img-description-search">
                                <img src="<?php echo $image; ?>" alt="">
                                <div class="text-description">
                                    <div class="category">
                                        <?php
                                        if(isset($_POST['vung-form']) && $_POST['vung-form'] != -1) {
                                            $term = get_term($_POST['vung-form']);
                                            ?>
                                            <h6 class="vung">
                                                <?php echo $term->name; ?>
                                            </h6>
                                            <?php
                                        }else{
                                            $term = get_the_terms($loop_area->post->ID, 'tourirt-tokuku-area');
                                            for($i = 0 ; $i < count($term) ; $i ++){
                                                ?>
                                                <h6 class="vung">
                                                    <?php echo $term[$i]->name; ?>
                                                </h6>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <?php
                                        if(isset($_POST['nganh-form']) && $_POST['nganh-form'] != -1) {
                                            $term = get_term($_POST['nganh-form']);
                                            ?>
                                            <h6 class="nganh">
                                                <?php echo $term->name; ?>
                                            </h6>
                                            <?php
                                        }else{
                                            $term_arr_cat = get_the_terms($loop_area->post->ID, 'tourirt-tokuku-category');
                                            for($i = 0 ; $i < count($term_arr_cat) ; $i ++){
                                                $term_color = types_render_termmeta("color", array( "term_id" => $term_arr_cat[$i]->term_id  ));
                                                ?>
                                                <h6 class="nganh" style="color: #<?php echo $term_color; ?>; border-color: #<?php echo $term_color; ?>">
                                                    <?php echo $term_arr_cat[$i]->name; ?>
                                                </h6>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div class="company-name">
                                        <?php echo $loop_area->post->post_title; ?>
                                    </div>
                                    <div class="event-description">
                                        <?php echo $loop_area->post->post_excerpt; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $key++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
