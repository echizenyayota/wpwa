<?php
/*
  Plugin Name: WP Questions
  Plugin URI: -
  Description: Question and Answer interface for developers
  Version: 1.0
  Author: Rakhitha Nimesh
  Author URI: http://www.innovativephp.com/
  License: GPLv2 or later
*/

add_action('init', 'register_wp_questions');

/*
* Register new custom post type for questions
*
* @return void
*/
function register_wp_questions() {

    $labels = array(
            'name'                  => __( 'Questions', 'wp_question' ),
            'singular_name'         => __( 'Question', 'wp_question' ),
            'add_new'               => __( 'Add New', 'wp_question' ),
            'add_new_item'          => __( 'Add New Question', 'wp_question' ),
            'edit_item'             => __( 'Edit Questions', 'wp_question' ),
            'new_item'              => __( 'New Question', 'wp_question' ),
            'view_item'             => __( 'View Question', 'wp_question' ),
            'search_items'          => __( 'Search Questions', 'wp_question' ),
            'not_found'             => __( 'No Questions found', 'wp_question' ),
            'not_found_in_trash'    => __( 'No Questions found in Trash', 'wp_question' ),
            'parent_item_colon'     => __( 'Parent Question:', 'wp_question' ),
            'menu_name'             => __( 'Questions', 'wp_question' ),
    );

    $args = array(
            'labels'                => $labels,
            'hierarchical'          => true,
            'description'           => __( 'Questions and Answers', 'wp_question' ),
            'supports'              => array( 'title', 'editor', 'comments' ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'has_archive'           => true,
            'query_var'             => true,
            'can_export'            => true,
            'rewrite'               => true,
            'capability_type'       => 'post'
    );

    register_post_type( 'wp_question', $args );
}

function wpwa_comment_list( $comment, $args, $depth ) {
    global $post;

    $GLOBALS['comment'] = $comment;

    // Get current logged in user and author of question
    $current_user           = wp_get_current_user();
    $author_id              = $post->post_author;
    $show_answer_status     = false;

    // Set the button status for authors of the question
    if ( is_user_logged_in() && $current_user->ID == $author_id ) {
        $show_answer_status = true;
    }

    // Get the correct/incorrect status of the answer
    $comment_id = get_comment_ID();
    $answer_status = get_comment_meta( $comment_id, "_wpwa_answer_status", true );
}

?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<article id="comment-<?php comment_ID(); ?>">
<header class="comment-meta comment-author vcard">
<?php
  // Display image of a tick for correct answers
  if ( $answer_status ) {
    echo "<div class='tick'><img src='".plugins_url( 'img/tick.png', __FILE__ )."' alt='Answer Status' /></div>";
  }
?>
<div>
        <?php
        // Display the button for authors to make the answer as correct or incorrect
        if ( $show_answer_status ) {

            $question_status = '';
            $question_status_text = '';
            if ( $answer_status ) {
                $question_status = 'invalid';
                $question_status_text = 'Mark as Incorrect';
            } else {
                $question_status = 'valid';
                $question_status_text = 'Mark as Correct';
            }

            ?>
    <input type="button" value="<?php echo $question_status_text; ?>"  class="answer-status answer_status-<?php echo $comment_id; ?>"
           data-ques-status="<?php echo $question_status; ?>" />
    <input type="hidden" value="<?php echo $comment_id; ?>" class="hcomment" />

        <?php
            }
        ?>
</div>
