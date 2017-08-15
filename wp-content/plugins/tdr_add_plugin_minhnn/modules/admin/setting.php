<div class="wrap">
    	<div id="icon-options-general" class="icon32"><br></div>
        <h2><?php _e( 'TDR Theme Settings', 'tdr_theme' );?></h2>
        <?php if ( 'true' == @esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Theme Settings updated.</p></div>'; ?>
        <form action="<?php admin_url( 'themes.php?page=theme-settings' ); ?>" method="post">
            <?php settings_fields( 'general'); ?>
            <?php if(isset($_POST['save_settings'])): if($_POST['save_settings'] == 'Y'){ tdr_save_options(); } endif;?>
			<?php 
			$options					=	get_option( 'tdr_theme_options' );
			?>
           
           <div class="clear minhnn_group_theme_options"> 
           		<div class="group_item_theme clear">
                    	<h3 class="line"><?php _e( 'General Options', 'tdr_theme' );?></h3>
                </div>
             <div class="group_item_auto_theme clear">
                <?php
				 if(!empty( $options['mh'] ) ):
						$array_option_autos=unserialize($options['mh']);
					endif;
					//print_r($array_option_autos);
					if( !empty($array_option_autos)):
					$count=	count( $array_option_autos);
					for( $i = 0; $i < $count; $i++ ):
					//foreach($array_option_autos as $array_option_autos):
						$label_text	=($array_option_autos[$i]['group_tdr']['tdr_name'] != '' ) ? $array_option_autos[$i]['group_tdr']['tdr_name'] : '';
						$option_value=($array_option_autos[$i]['group_tdr']['tdr_value'] != '' ) ? $array_option_autos[$i]['group_tdr']['tdr_value'] : '';
						$option_value=stripslashes(stripslashes($option_value));
						$option_choise=($array_option_autos[$i]['group_tdr']['tdr_choise'] != '' ) ? $array_option_autos[$i]['group_tdr']['tdr_choise'] : '';
						switch($option_choise):
							case "line":
									echo '<div class="group_item_theme clear">
                       					<div class="left_item_theme"><input type="text" value="'.$label_text.'" placeholder="Please enter Name Field"  name="header_option_texts_line[]" /></div>
                      					<div class="right_item_theme"><input type="text" class="regular-text" placeholder="Please enter Value Field" name="header_option_values_line[]" value="'.$option_value.'" /><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl"></div>
                       				</div>';
							break;
							case "muti_line":
								echo '<div class="group_item_theme clear">
                       					<div class="left_item_theme"><input type="text" value="'.$label_text.'" placeholder="Please enter Name Field"  name="header_option_texts_muti_line[]" /></div>
                       					<div class="right_item_theme"><textarea class="regular-area" name="header_option_values_muti_line[]" cols="5" rows="5">'.$option_value.'</textarea><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl"></div>
                       				 </div>';
							break;
							case "img_line":
								echo '<div class="group_item_theme clear">
					                        <div class="left_item_theme"><input type="text" value="'.$label_text.'" placeholder="Please enter Name Field"  name="header_option_texts_img_line[]" /></div>
					                        <div class="right_item_theme">
						                       
						                       	 	<input type="text" class="regular-text img_option_line"  name="header_option_values_img_line[]" value="'.$option_value.'" /><input type="button" class="button button-secondary tbl_choise_img_set" id="choise_img" value="Select Images" name="choise_img"><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl">     
						                        	<div class="mutioption_tdr_img">
														<a href="'.$option_value.'" class="colorbox" onclick="jQuery.colorbox({href:'.$option_value.'}); return false;"><img class="slideshow_dropshadow" style="width:80px;" src="'.$option_value.'" /></a>
													</div>
						                       
					                        </div>
                  				     </div>';
							break;
							default:
						endswitch;
					endfor;
				?>
                
                <?php endif; ?>
                </div><!--group_item_auto_theme-->    
                <div class="clear note_use_add alert alert-success">
            <?php _e( '<strong class="note">Use option</strong>: ex: name=logo get value: <i>'.htmlspecialchars('<?php echo get_option_minhnn("logo");?>').' </i>&nbsp;&nbsp;&nbsp;', 'tdr_theme' );?>
                </div>  
                    <div class="group_item_theme tbl_create_theme_add clear">
                    	<div class="left_item_theme"><b><i>Choise Field Create</i></b></div>
                        <div class="right_item_theme">
                        <select name="option_choise_add" class="select_option_choise">
                            <option value="line">line</option>
                            <option value="muti_line">Mutiline</option>
                            <option value="img_line">Field Images</option>
                         </select>
                        <input type="button" class="button button-secondary create_option_class" id="create_option" value="Create Option" name="create_option">
                        </div>
                     </div>
                    
              <?php 
					if(!empty( $options['select_checkbox_gallery'] ) ):
						$array_checkbox_fill=unserialize($options['select_checkbox_gallery']);
					endif;
			  ?>
                   <div class="group_item_theme clear">
                        <div class="left_item_theme"><label class="fleld_name"><?php _e( 'Gallery Images Option', 'tdr_theme' );?></label></div>
                        <div class="right_item_theme">
                       	  <p>
                        	  <label>
                        	    <input type="checkbox" name="select_checkbox_gallery[]" <?php if(!empty($array_checkbox_fill)): if(in_array('page', $array_checkbox_fill)):  ?>checked<?php endif; endif; ?> value="page" id="select_checkbox_gallery_0">
                        	    <b>page</b></label>
                        	  <br>
                        	  <label>
                        	    <input type="checkbox" name="select_checkbox_gallery[]" <?php if(!empty($array_checkbox_fill)): if(in_array('post', $array_checkbox_fill)):  ?>checked<?php endif; endif; ?> value="post" id="select_checkbox_gallery_1">
                        	    <b>post</b></label>
                        	  <br>
                             <?php
									$args = array(
									   'public'   => true,
									   '_builtin' => false
									);
									
									$output = 'names'; // names or objects, note names is the default
									$operator = 'and'; // 'and' or 'or'
									$post_types = get_post_types( $args, $output, $operator ); 
									foreach ( $post_types  as $post_type ) {
									?>
                                <label>
                        	    <input type="checkbox" name="select_checkbox_gallery[]" <?php if(!empty($array_checkbox_fill)): if(in_array($post_type, $array_checkbox_fill)):  ?>checked<?php endif; endif; ?> value="<?php echo $post_type; ?>" id="select_checkbox_gallery_1">
                        	    <b><?php echo $post_type; ?></b> . <i>(Custom postype)</i></label>
                        	  		<br>
                                    <?php
									}
									?>
                              
                              
                   	    	</p>
                        	</div>
                    </div>
                    
                    <div class="group_item_theme clear">
                    	<h3 class="line line-top"><?php _e( 'Overview', 'tdr_theme' );?></h3>
                    </div>
                	<div class="group_item_theme clear">
                    	<?php _e( '<span class="description"><strong>Usage</strong>: For Eg: if your label name is "<strong>Linked In</strong>", please use these functions&nbsp;&nbsp;&nbsp;<strong>$options	=	get_option( \'tdr_theme_options\' );</strong>&nbsp;&nbsp;&nbsp;<strong>echo $options[\'header_option_values\'][\'linked_in\'];</strong></span>', 'tdr_theme' );?>
                    </div>
             </div>
            <p class="submit">
            	<input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit">
            	<input type="hidden" value="Y" name="save_settings" />
            </p>
        </form>
    </div>
