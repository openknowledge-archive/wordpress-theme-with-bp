<?php
/**
 * Theme Options page
 */

$themename = "okfnwp";
$shortname = "okfnwp";
$options = array(
	array(
		"name" => "Mailing List Bar",
		"type" => "title"
	),
	array(
		"name" => "Mailing List Heading",
		"desc" => "Appears next to the form",
		"id"   => $shortname . "_mailinglist_heading",
		"type" => "text"
	),
	array(
		"name" => "Action",
		"desc" => "URL from form action attribute. Mailman example: http://lists.okfn.org/mailman/subscribe/XYZ",
		"id"   => $shortname . "_mailinglist_action",
		"type" => "text"
	),
	array(
		"name" => "Mailman List ID",
		"desc" => "",
		"id"   => $shortname . "_mailinglist_id",
		"type" => "text"
	),
);

function okfnwp_add_admin() {

	global $themename,
			$shortname,
			$options;

	if($_GET['page'] == basename(__FILE__)) {
		if (array_key_exists('action', $_REQUEST) && 'save' == $_REQUEST['action']) {

			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}

			foreach ($options as $value) {
				if(isset($_REQUEST[ $value['id']])) {
					update_option(
						$value['id'],
						$_REQUEST[$value['id']]
					);
				} else {
					delete_option($value['id']);
				}
			}

			header("Location: themes.php?page=theme-options.php&saved=true");
			die;

		} elseif(array_key_exists('action', $_REQUEST) && 'reset' == $_REQUEST['action']) {

			foreach ($options as $value) {
				delete_option($value['id']);
			}

			header("Location: themes.php?page=theme-options.php&reset=true");
			die;

		}
	}

	add_theme_page(
		'Theme Options',
		'Theme Options',
		'switch_themes',
		basename(__FILE__),
		'okfnwp_admin'
	);

}


function okfnwp_admin() {

	global $themename, $shortname, $options;

	if(array_key_exists('saved', $_REQUEST) && $_REQUEST['saved']) {
		echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
	}
	if(array_key_exists('reset', $_REQUEST) && $_REQUEST['reset']) {
		echo '<div id="message" class="updated fade"><p><strong>Settings reset.</strong></p></div>';
	}

?>

	<div class="options wrap">
		<style scoped>
		  .options .group h3 {
				font-family: sans-serif;
				font-weight:bold;
				background-color:#DFDFDF;
			}
			.options .section {
				padding:10px 0;
				border-top:solid 1px #ECECEC;
			}
			.options h3 + .section {
				border:none;
			}
			.options .section .heading {
				float:left;
				width:25%;
			}
			.options .section .heading h4,
			.options .section .heading .explain {
				margin:0;
				padding:0 10px;
			}
			.options .section .heading + .option {
				margin-left:25%;
			}
			.options .section-radio label {
				margin-bottom:5px;
				display:block;
			}
			.options .section-radio.thumbs label {
				width:240px;
				display:inline-block;
				padding-top:122px;
				margin:0px 15px 15px 0px;
				border:solid 1px #DDDDDD;
				background-position:center top;
			}
			.options .section-radio.thumbs label span {
				display:block;
				padding:3px;
				background: rgb(255, 255, 255); /* fallback */
			background: rgba(255, 2554, 255, 0.9);
			}
			.options .submit {
				display:block;
				float:left;
				margin-left:10px;
			}
		</style>

		<h2>Theme Options</h2>
		<div class="icon32" id="icon-themes"><br></div>

		<?php settings_errors(); ?>

		<div class="metabox-holder">
			<form method="post">

			<?php foreach ($options as $value) {

			switch ( $value['type'] ) {

			case "open": ?>

				<div id="<?php echo $value['name']; ?>" class="group" <?php if( $active_tab !== $value['name'] ) : ?> style="display:none;"<? endif; ?> >

			  <?php
			  break;

			case "close": ?>

				</div>

			  <?php
			  break;

			case "title": ?>

				<h3><?php echo $value['name']; ?></h3>

				<?php
				break;

			case 'text': ?>

				<div class="section section-text" id="section_<?php echo $value['id']; ?>">
					<div class="heading">
						<h4><?php echo $value['name']; ?></h4>
						<p class="explain"><?php echo $value['desc']; ?></p>
					</div>
					<div class="option">
            <div class="controls">
							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } ?>" <?php if (  $value['placeholder']  != "") : ?>placeholder="<?php echo $value['placeholder']; ?>"<? endif ?>/>
							<br>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<?php
				break;

			case 'textarea': ?>

				<?php $input = get_option( $value['id'] ); $output = stripslashes ($input); ?>

				<div class="section section-textarea" id="section_<?php echo $value['id']; ?>">
					<div class="heading">
						<h4><?php echo $value['name']; ?></h4>
						<p class="explain"><?php echo $value['desc']; ?></p>
					</div>
					<div class="option">
						<div class="controls">
							<textarea name="<?php echo $value['id']; ?>" cols="70" rows="<?php if (  $value['rows']  != "") { echo $value['rows']; } else { echo '5'; } ?>" <?php if (  $value['placeholder']  != "") : ?>placeholder="<?php echo $value['placeholder']; ?>"<? endif ?>><?php if ( get_option( $value['id'] ) != "") { echo $output; } else { echo $value['std']; } ?></textarea>
							<br>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<?php
				break;

			case 'select': ?>

				<div class="section section-select" id="section_<?php echo $value['id']; ?>">
					<div class="heading">
						<h4><?php echo $value['name']; ?></h4>
						<p class="explain"><?php echo $value['desc']; ?></p>
					</div>
					<div class="option">
						<div class="controls">
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
							<br>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<?php
				break;

			case 'media':
				$upload_button_text = __( 'Upload', 'okfn' ); ?>

				<div class="section section-text" id="section_<?php echo $value['id']; ?>">
					<div class="heading">
						<h4><?php echo $value['name']; ?></h4>
						<p class="explain"><?php echo $value['desc']; ?></p>
					</div>
					<div class="option">
						<div class="controls">
							<input type="text" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" <?php if (  $value['placeholder']  != "") : ?>placeholder="<?php echo $value['placeholder']; ?>"<? endif ?> />
							<!--<input id="<?php echo $value['id']; ?>_upload_button" type="button" class="button" value="<?php echo $upload_button_text; ?>" /> -->
							<br>
						</div>
						<div class="clear"></div>
					</div>
				</div>


			  	<?php
				break;

			case "checkbox": ?>

				<div class="section section-checkbox" id="section_<?php echo $value['id']; ?>">
					<div class="heading">
						<h4><?php echo $value['name']; ?></h4>
					</div>
					<div class="option">
						<div class="controls">
							<? if( get_option($value['id'] ) ){ $checked = "checked=\"checked\""; } else { if ( $value['std'] === "true" ){ $checked = "checked=\"checked\""; } else { $checked = ""; } } ?>
							<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
							<label for="<?php echo $value['id']; ?>" class="explain"><?php echo $value['desc']; ?></label>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				  <?php
				  break;

			case "radio": ?>

				<div class="section section-radio <?php echo $value['class'] ?>" id="section_<?php echo $value['id']; ?>">
					<div class="heading">
						<h4><?php echo $value['name']; ?></h4>
						<p class="explain"><?php echo $value['desc']; ?></p>
					</div>
					<div class="option">
						<div class="controls">
							<? foreach ($value['options'] as $option_value => $option_text) {
								$checked = ' ';
								if (get_option($value['id']) == $option_value) {
									$checked = ' checked="checked" ';
								} else if (get_option($value['id']) === FALSE && $value['std'] == $option_value){
									$checked = ' checked="checked" ';
								} else {
									$checked = ' ';
								}

								if ($value['class'] == "thumbs") {
									$bgimage = "".get_bloginfo('stylesheet_directory')."/screenshot-".$option_value.".png";
								} else {
									$bgimage = '';
								}

								echo '<label style="background-image:url('.$bgimage.');"><span><input type="radio" style="margin-right:10px;" name="'.$value['id'].'" value="'.
								$option_value.'" '.$checked."/>".$option_text."</span></label>";
							} ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>

				<?php
				break;

			}
		}
		?>

			<span class="submit">
				<input name="save" type="submit" value="Save changes" class="button-primary" />
				<input type="hidden" name="action" value="save" />
			</span>
		</form>
		<form method="post">
			<span class="submit">
				<input name="reset" type="submit" value="Reset" class="button" />
				<input type="hidden" name="action" value="reset" />
			</span>
		</form>
	</div>

<?php
}

add_action('admin_menu', 'okfnwp_add_admin');
?>
