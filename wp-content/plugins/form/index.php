<?php
/*
  Plugin Name: hùng tạo plugin custom form
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */

function tao_form(  ) {
    echo '
    <style>
    div {
      margin-bottom:2px;
    }
     
    input{
        margin-bottom:4px;
    }
    </style>
    ';

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">

<table>
    <tr>
        <td class="w30pi"><label for="name1"> <strong>お名前*</strong></label></td>
        <td><input type="text" name="name1"  class="w100p"></td>
    </tr>
    <tr>
        <td><label for="name2">Password <strong>かな*</strong></label></td>
        <td><input type="text" name="name2"  class="w100p"></td>
    </tr>
    <tr>
        <td><label for="tel">Email <strong>携帯電話*</strong></label></td>
        <td><input type="text" name="tel" class="w100p"></td>
    </tr>
    <tr>
        <td><label for="sns">SNS ID</label></td>
        <td><input type="text" name="sns"  class="w100p"></td>
    </tr>
    <tr>
        <td><label for="email">e-Mailアドレス*</label></td>
        <td><input type="email" name="email" class="w100p"></td>
    </tr>
    <tr>
        <td><label for="mesage">お問合せ内容*</label></td>
        <td><textarea name="mesage" rows="3" style="width: 100%"></textarea></td>
    </tr>
   
</table>
<input type="submit" name="submit" value="save" class="
" style = "color: white; background-color: #c10c0c;"/>
    </form>
    ';
}
function kiemtraformat( )
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
add_shortcode( 'tenplugin', 'actionForm' );

// The callback function that will replace [book]
function actionForm() {
    ob_start();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ( isset($_POST['submit'] ) ) {
        // sanitize user form input
        global $name1, $name2, $tel, $sns, $email, $message,$loi;
        $name1   =   sanitize_text_field( $_POST['name1'] );
        $name2   =   sanitize_text_field( $_POST['name2'] );
        $tel      =   sanitize_email( $_POST['tel'] );
        $sns    =   sanitize_text_field( $_POST['sns'] );
        $email =   sanitize_text_field( $_POST['email'] );
        $message        =   esc_textarea( $_POST['mesage'] );
        kiemtraformat();
        // call @function themdulieu to create the user
        // only when no WP_error is found
        if (  count( $loi->get_error_messages() ) == 0) {
            $data_voice = array(
                'name1'    =>   $name1,
                'name2'    =>   $name2,
                'tel'     =>   $tel,
                'sns'      =>   $sns,
                'email'    =>   $email,
                'message'     =>   $message
            );
            ///$user = wp_insert_user( $userdata );
            //var_dump($data_voice);

            $id = wp_insert_post(array(
                'post_type' => 'voice',
                'post_title' => $name1." send ".$name2,
                'post_status' => 'publish',
                'post_content' => $name1."   -  ".
                    $name2."   -  ".
                    $tel."   -  ".
                    $sns."   -  ".
                    $email."   -  ". $message
            ));
            echo "banj ddax insert vaof voice mowsi cos id : ".$id;
        }else {
            echo "lỗi form";
        }
    }
    tao_form();

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    return ob_get_clean();
}