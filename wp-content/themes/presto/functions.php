<?php
add_action('wp_enqueue_scripts', 'presto_removeScripts' , 20);
function presto_removeScripts() {
//De-Queuing paresnt color Styles sheet 
wp_dequeue_style( 'default',get_template_directory_uri() .'/css/default.css'); 

//EN-Queing new color Style sheet

 $parent_style = 'parent-style';
 wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
 wp_enqueue_style('purple', get_stylesheet_directory_uri() . '/purple.css');  
}?>
<?php function presto_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'presto_add_editor_styles' );

//child theme option//
add_action( 'customize_register' , 'presto_child_options' );
function presto_child_options( $wp_customize ) {

$wp_customize->add_section('extra_option', 
    array(
        'title'       => __( 'Extra Option', 'presto' ),
        'priority'    => 100,
        'panel'=>'enigma_theme_option',
		'capability'=>'edit_theme_options',
    ) 
);
$wp_customize->add_setting( 'layout',
    array(
		'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback'=>'enigma_sanitize_integer',
    )
);  
$wp_customize->add_control( 'layout', array(
        'label'    => __( 'You can change Theme layout from here', 'presto' ), 
        'section'  => 'extra_option',
        'settings' => 'layout',
        'type'    => 'select',
		'choices'=>array(
		'1'=>'Full Width',
		'2'=>'Boxed',
		),
        'priority' => 10,
    ) 
);
	
$wp_customize->add_setting(
	'scroll_up',
		array(
		'type'=>'theme_mod',
		'sanitize_callback'=>'enigma_sanitize_checkbox',
		'capability'=>'edit_theme_options'
		)
);
$wp_customize->add_control( 'scroll_up', array(
		'label'        => __( 'Check The Box To Enable SCroll Up Arrow', 'presto' ),
		'type'=>'checkbox',
		'section'    => 'extra_option',
		'settings'   => 'scroll_up'
	) );
}


// code for comment
if ( ! function_exists( 'weblizar_comment' ) ) :
function weblizar_comment( $comment, $args, $depth ) 
{
	$GLOBALS['comment'] = $comment;
	//get theme data
	global $comment_data;
	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : 
	__('Reply','presto'); ?>
    <div class="media enigma_comment_box">
			<a class="pull_left_comment">
            <?php echo get_avatar($comment,$size = '60'); ?>
            </a>
           <div class="media-body">
			    <div class="enigma_comment_detail">
				<h4 class="enigma_comment_detail_title"><?php comment_author();?></h4>
				
				<span class="enigma_comment_date">
				<?php if ( ('d M  y') == get_option( 'date_format' ) ) : ?>				
				<?php comment_date('F j, Y');?>
				<?php else : ?>
				<?php comment_date(); ?>
				<?php endif; ?>
				<?php _e('at','presto');?>&nbsp;<?php comment_time('g:i a'); ?></span>
				<?php comment_text() ; ?>				
				<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				
				<?php edit_comment_link(__('Quick Edit','presto')); ?>
				</div>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'presto' ); ?></em>
				<br/>
				<?php endif; ?>
				</div>
			</div>							
	</div>		
<?php
}
endif;
?>