<?php
/* 
 * Child theme functions file
 * 
 */
function zakra_child_enqueue_styles() {

	$parent_style = 'zakra-style'; //parent theme style handle 'zakra-style'

	//Enqueue parent and chid theme style.css
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' ); 
	wp_enqueue_style( 'zakra_child_style',
	    get_stylesheet_directory_uri() . '/style.css',
	    array( $parent_style ),
	    wp_get_theme()->get('Version')
	);
	wp_enqueue_script( 'custom',  get_stylesheet_directory_uri() . '/script.js',true,'1.0');
}
add_action( 'wp_enqueue_scripts', 'zakra_child_enqueue_styles' );

//######################################  Custom _code start #####################################################################
//
//Adding the shortcode [animated_services] for animated text on home page
add_shortcode('animated_services',function(){
	return '
	<div class="word-container dynamic-text">
        <span class="word">Employers</span>
        <span class="word">Brokers</span>
        <span class="word">General Agents</span>
      </div>
	';
});

add_action('wp_footer',function(){
	if( is_front_page() || $_SERVER['REQUEST_URI']=="/coming-soon/"){
	echo "<script>
	const words = document.querySelectorAll('.word');
let index = 0;

function fadeWords() {
  const previousIndex = (index === 0) ? words.length - 1 : index - 1;

    words[previousIndex].style.opacity = '0';
  words[previousIndex].style.display = 'none';
  words[index].style.opacity = '1';
  words[index].style.display = 'block';
  
  index++;
  if (index === words.length) {
    index = 0;
  }
}
fadeWords();
setInterval(fadeWords, 2000);
	</script>";
	}
});

//Set Cookie to get page info  --start
add_action('wp_footer',function (){
	global $post;
	$page_slug = $post->post_name;
	if($page_slug=='brokers' || $page_slug=='employers' || $page_slug=='individuals' || $page_slug=='general-agents') {
echo '<script>
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
setCookie(`_page_name`,`'.$page_slug.'`,7);
</script>';
	}
});
//Set Cookie to get page info  --end
//


//Disble Gutenburg Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

//Show featured image in Posts - Admin page 
function custom_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'featured_image' => 'Featured Image',
        'title' => 'Title',
        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
        'date' => 'Date'
     );
    return $columns;
}
add_filter('manage_posts_columns' , 'custom_columns');

function custom_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'featured_image':
        the_post_thumbnail( [50] );
        break;
    }
}
add_action( 'manage_posts_custom_column' , 'custom_columns_data', 10, 2 ); 


// Timeline Showcase
add_shortcode('time_line',function(){
	  ob_start();
$the_query = new WP_Query(array( 'post_type' =>'timeline', 'post_status'=> 'publish','posts_per_page' => -1));
 ?>
<section class="timeline-section">
  <div class="medium-container">
    <div class="timeline">
		<?php 	if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
	 $imgurl = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
      <div class="timeline__item">
        <div class="timeline__line"></div>
        <div class="timeline__wrap">
          <img src="<?php echo $imgurl; ?>">
			<div class="timeline__content">
          <p><?php the_content(); ?></p>
          <h2><?php the_title() ?></h2>
			<a href="<?php echo get_post_meta(get_the_id(), 'timeline_learn_more', true); ?>" target="_blank" class="learn_more">Learn more</a>
			</div>
        </div>
      </div>
		<?php endwhile; ?>
	   <div class="timeline__track"></div>
    </div>
  </div>
</section> <?php 
	wp_reset_postdata();
	else: 
	 _e( '<p>Sorry, no timeline found.</p>' );
	endif;  
   $timeline = ob_get_clean();
	return $timeline;
});

//Email recipients
add_shortcode('email_recipients',function(){
	$emails = 'mrdeepak.6897@gmail.com';
	if(get_site_url()==(is_ssl()?'https':'http').'://cobra.sterlingadministration.com'){
		$emails = 'shavee.kapoor@sterlingadministration.com,
		Duarte.Batista@sterlingadministration.com,
		marketing@heigh10.com,
		cobrasales@sterlingadministration.com';
	}
	return $emails;
});

//UTM param to database---------------------------------------------------------------------------------------------------------------------

// A send custom WebHook
add_action( 'elementor_pro/forms/new_record', function( $record, $handler ) {
 $data =[];
 $data['Source'] = empty(sanitize_text_field($_POST['USOURCE'])) ? 'direct' : sanitize_text_field($_POST['USOURCE']);
 $data['Campaign'] = sanitize_text_field($_POST['UCAMPAIGN']);
 $data['Ad_Group'] = sanitize_text_field($_POST['UMEDIUM']);
global $wpdb, $table_prefix;
	$last_id = $wpdb->get_results('SELECT submission_id from '.$table_prefix.'e_submissions_actions_log ORDER BY id DESC LIMIT 1');
	$last_id = $last_id[0]-> submission_id;
	foreach($data as $key=>$value){
		$arr = ['submission_id'=>$last_id,'key'=>$key,'value'=>$value];
	$wpdb->insert($table_prefix.'e_submissions_values',$arr);
	}
}, 10, 2 );

//----------------------------------------------------------------------------------------------

//Elementor form custom UTM data in mail
add_action('elementor_pro/forms/wp_mail_message',function($email_text){
	$source = empty(sanitize_text_field($_POST['USOURCE'])) ? 'direct' : sanitize_text_field($_POST['USOURCE']);
		$email_text .= "<b>Source</b>: ".$source."<br>";
		$email_text .= "<b>Campaign</b>: ".sanitize_text_field($_POST['UCAMPAIGN'])."<br>";
		$email_text .= "<b>Ad Group</b>: ".sanitize_text_field($_POST['UMEDIUM'])."<br>";
	return $email_text;
});

// Prevent Duplicate Emails  --start
 add_action( 'elementor_pro/forms/process/email', function( $field, $record, $ajax_handler ) {
	global $wpdb, $table_prefix;
	$yourEmail = $field['value'];
	$elementor_values = $table_prefix.'e_submissions_values';
	$result = $wpdb->get_results(sprintf("SELECT `submission_id` FROM `%s` WHERE `key` LIKE '%s' AND `value` LIKE '%s'",$elementor_values,'email',$yourEmail));
	if(!empty($result)){
		$ajax_handler->add_error( $field['id'], esc_html__( 'A request with this email is already submitted.'));
		$ajax_handler->add_error(esc_html__( 'A request with this email is already submitted.'));
	}
	 return;
 },10,3);
// --end

// Only Allow Business Email --start
//elementor form email validation
add_action( 'elementor_pro/forms/validation/email', function( $field, $record, $ajax_handler ) {
	 $form_name = $record->get_form_settings( 'form_name' );
	
    if ($field['value']==''){
        $ajax_handler->add_error( $field['id'], 'Please enter a valid company email address.' );
    }
     
 	if (preg_match("/(hotmail|gmail|yahoo|outlook|wordpress|aol|bozzcello|bozztirex|vivaldigital|icloud|comcast|company|microsoft|gml|jontmail|mail|test|gmil)/i", $field['value'])){
        $ajax_handler->add_error( $field['id'], 'Please enter a valid company email address.');
    }

}, 10, 3 );
//Only Allow Business Email - end