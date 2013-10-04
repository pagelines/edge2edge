<?php
/*
	Section: Edge To Edge
	Author: WPJim
	Author URI: http://www.wpjim.com
	Description: Creates header top bar.
	Version: 1.0.0
	Class Name: EdgeToEdge 
	Workswith: templates, main, sidebar1, sidebar2, sidebar_wrap, header, footer, morefoot
	Cloning: true
	Filter: full-width
*/

class EdgeToEdge extends PageLinesSection {


	private $clone_id;

	function section_persistent(){
		wp_enqueue_style('/style.css');
	}

	function section_selectors($selectors, $group){

		
	}

	function section_opts(){
		$opts = array(
			array(
				'type'		=> 'multi',
				'key'		=> 'e2e_text', 
				'span'		=> 2,
				'opts'		=> array(
					array(
						'type' 			=> 'text',
						'key'			=> 'e2e_title',
						'label' 		=> 'Title (Optional)',
					),
					array(
						'type' 			=> 'textarea',
						'key'			=> 'e2e_content',
						'label' 		=> 'HTML',
					),
					
				)
			), 
			array(
				'type'		=> 'multi',
				'key'		=> 'e2e_config', 
				'label' 	=> 'Text Styles', 
				'opts'		=> array(
					array(
						'key'			=> 'e2e_pad',
						'type' 			=> 'text',
						'label' 	=> __( 'Padding <small>(CSS Shorthand)</small>', 'pagelines' ),
						'ref'		=> __( 'This option uses CSS padding shorthand. For example, use "15px 30px" for 15px padding top/bottom, and 30 left/right.', 'pagelines' ),
						
					),
					array(
						'key'			=> 'e2e_titlesize',
						'type'			=> 'count_select',
						'count_start'	=> 20,
						'count_number'	=> 100,
						'suffix'		=> 'px',
						'title'			=> __( 'Title Font Size', 'pagelines' ),
						'default'		=> 35, 
					),
					array(
						'key'			=> 'e2e_font_size',
						'type'			=> 'count_select',
						'count_start'	=> 10,
						'count_number'	=> 30,
						'suffix'		=> 'px',
						'title'			=> __( 'Section Font Size', 'pagelines' ),
						'default'		=> 14, 
					),
					array(
						'type' 			=> 'select',
						'key'			=> 'e2e_align',
						'label' 		=> 'Alignment',
						'opts'			=> array(
							'left'		=> array('name' => 'Align Left (Default)'),
							'right'		=> array('name' => 'Align Right'),
							'center'	=> array('name' => 'Center'),
							'justify'	=> array('name' => 'Justify'),
						)
					),

					array(
						'key'			=> 'e2e_text_color',
						'title' => 'Text Color',
						'type' => 'color',
						'label' 	=> __( 'Text Color', 'pagelines' )
					
					)
					
				)
			),

			array(
				'type'		=> 'multi',
				'key'		=> 'e2e_config',
				'label' 	=> 'Height/Width', 
				'opts'		=> array(

					array(
						'key'			=> 'e2e_background',
						'title' => 'Background Image',
						'type' => 'image_upload',
						'inputLabel' => 'Upload Image.',
						'shortexp' => 'This image appears in the background. (Optional)'
					
					),

					array(
						'type' 			=> 'select',
						'key'			=> 'e2e_background_repeat',
						'label' 		=> 'Background Image Options',
						'opts'			=> array(
							'no-repeat'		=> array('name' => 'No Repeat'),
							'repeat-x'		=> array('name' => 'Repeat Horizontal'),
							'repeat-y'		=> array('name' => 'Repeat Vertical'),
						)
					),

					array(
						'key'			=> 'e2e_background_color',
						'title' => 'Background Color',
						'type' => 'color',
						'shortexp' => 'Solid Background Color. (Optional)'
					
					)
				)
			),

			array(
				'type'		=> 'multi',
				'key'		=> 'e2e_config',
				'label' 	=> 'Height/Width', 
				'opts'		=> array(

					array(
						'key'			=> 'e2e_height',
						'title' => 'Section Height',
						'type' => 'text',
						'label' 	=> __( 'Enter a number for height. ex: 145px', 'pagelines' )
					
					),

					array(
						'key'			=> 'e2e_width',
						'title' => 'Section Width',
						'type' => 'text',
						'label' 	=> __( 'Enter a number or percentage for width.', 'pagelines' )
					
					)
				)
			)
			
			
			
		);

		return $opts;

	}
	
	
	
	
   	function section_template() {

	   	$text = $this->opt('e2e_content');

		$title = $this->opt('e2e_title');

		$ebg = $this->opt('e2e_background');

		$ebgc = $this->opt('e2e_background_color');

		$hgt = $this->opt('e2e_height');

		$width = $this->opt('e2e_width');

		$font_size = $this->opt('e2e_font_size');

		$alignment = $this->opt('e2e_align');

		$text_color = $this->opt('e2e_text_color');

		$pad = $this->opt('e2e_pad');

		$titlesize = $this->opt('e2e_titlesize');

	   
	   	//If no options are set, display this
	   	if ((($title || $text) == '')) {
	   	
	   		echo setup_section_notify($this, __('Please add a title or content in Edge to Edge settings.'));
	   	
	   	}
	   	else {
	   	?>

	   	<div class="e2e">

			<h1 class="edgetitle"><?php echo $title ?></h1>

			<?php echo $text; ?>

			<div class="e2eimg">
				<img src="<?php echo $efg; ?>" />
			</div>
			

				<style>
				#edge-to-edge<?php print_r($this->meta['clone']); ?> {
					background: #<?php echo $ebgc; ?> url(<?php echo $ebg; ?>) center;
					height: <?php echo $hgt; ?> !important;
					width: <?php echo $width; ?> !important;
					color: #<?php echo $text_color; ?> !important;
					font-size: <?php echo $font_size; ?>px !important;
					margin: 0px auto;
					padding: <?php echo $pad; ?>;
				}
				
				.edgetitle {
					font-size: <?php echo $titlesize; ?>px !important;
				}

				#edge-to-edge<?php print_r($this->meta['clone']); ?> .e2e {
					text-align: <?php echo $alignment; ?>;
				}

				</style>


		</div>

	<?php
}
	}

}


