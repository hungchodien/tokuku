<?php
/*
  Plugin Name: hùng tạo plugin custom form cruit
  Plugin URI: http://....
  Description: Updatetest form post
  Version: 1.0
  Author: Agbonghama Collins
  Author URI:
 */

function tao_form_cruit(  ) {
    echo '
    
    ';

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">

<table>
    <tr>
        <td class="w30pi"><label > <strong>お名前*</strong></label></td>
        <td><input type="text" name="name1"  class="w100p"></td>
    </tr>
    <tr>
        <td><label>Password <strong>かな*</strong></label></td>
        <td><input type="text" name="name2"  class="w100p"></td>
    </tr>
     <tr>
        <td><label>Email <strong>携帯電話*</strong></label></td>
        <td><input type="text" name="address" class="w100p"></td>
    </tr>
    <tr>
        <td><label>Email <strong>携帯電話*</strong></label></td>
        <td><input type="text" name="tel" class="w100p"></td>
    </tr>
    <tr>
        <td><label>e-Mailアドレス*</label></td>
        <td><input type="email" name="email" class="w100p"></td>
    </tr>
    <tr>
        <td><label>birth <strong>携帯電話*</strong></label></td>
        <td><input type="text" name="birth" class="w100p"></td>
    </tr>
    <tr>
        <td><label>school</label></td>
        <td><input type="text" name="school"  class="w100p"></td>
    </tr>
    <tr>
        <td><label>e-Mailアドレス*</label></td>
        <td><input type="text" name="license" class="w100p"></td>
    </tr>
    <tr>
        <td><label>お問合せ内容*</label></td>
        <td><textarea name="experience" rows="3" style="width: 100%"></textarea></td>
    </tr>
    <tr>
        <td><label>お問合せ内容*</label></td>
        <td><textarea name="mesage" rows="3" style="width: 100%"></textarea></td>
    </tr>
   
</table>
<input type="submit" name="submit" value="save" class="" style = "color: white; background-color: #c10c0c;"/>
    </form>
    ';
}
function kiemtraformat_cruit( )
{   global $name1, $name2 , $email;
    global $loi;
    $loi = new WP_Error;
    if ( empty( $name1 ) || empty( $name2 ) || empty( $email ) ) {
        $loi->add('field', 'lỗi nhập liệu');
    }
    if ( is_wp_error( $loi ) ) {
        return 0;
    }else{
        return 1;
    }
}
// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'tenplugin_cruit', 'actionForm_cruit' );

// The callback function that will replace [book]
function actionForm_cruit() {
    ob_start();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ( isset($_POST['submit'] ) ) {
        // sanitize user form input
        global $name1, $name2,$address, $tel, $email,$birth,$school,$license,$experience, $message,$loi;
        $name1   =   sanitize_text_field( $_POST['name1'] );
        $name2   =   sanitize_text_field( $_POST['name2'] );
        $address   =   sanitize_text_field( $_POST['address'] );
        $tel   =   sanitize_text_field( $_POST['tel'] );
        $email   =   sanitize_text_field( $_POST['email'] );
        $birth   =   sanitize_text_field( $_POST['birth'] );
        $school   =   sanitize_text_field( $_POST['school'] );
        $license   =   sanitize_text_field( $_POST['license'] );
        $experience      =   sanitize_email( $_POST['experience'] );
        $message        =   esc_textarea( $_POST['mesage'] );
        kiemtraformat_cruit();
        // call @function themdulieu to create the user
        // only when no WP_error is found
        if (  count( $loi->get_error_messages() ) == 0) {

            $id = wp_insert_post(array(
                'post_type' => 'voice',
                'post_title' => $name1." send ".$name2,
                'post_status' => 'publish',
                'post_content' => $name1."   -  ".
                    $name2."   -  ".
                    $tel."   -  ".
                    $email."   -  ". $message
            ));
            echo "xử lí gì đó ví dụ gửi mail: ".$id;
        }else {
            echo "lỗi form";
        }
    }
    tao_form_cruit();

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    return ob_get_clean();
}