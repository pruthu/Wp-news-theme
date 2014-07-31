<?php
/*===================================================================
Get Review Data
=================================================================== */
if( !function_exists("arsene_get_review_data")){
    function arsene_get_review_data(){
        global $post;

        $review_meta =  get_post_meta($post->ID, 'arsene_review_metabox', true);
        $review_summary = $review_meta['review_summary'];
        $review_criteria = json_decode($review_meta['review_criteria']);    

    }
}

if( !function_exists("arsene_get_review_star_rating")){
    function arsene_get_review_star_rating($class = '', $tooltip = false, $echo = true){
        global $post;

        $review_meta =  get_post_meta($post->ID, 'arsene_review_metabox', true);  

        if(!empty($review_meta)){
            $review_criteria = json_decode($review_meta['review_criteria']);    
            if(!empty($review_criteria)){    
                $total = 0;
                $size  = count($review_criteria);
                foreach($review_criteria as $criteria){
                	$total += $criteria->arsene_criteria_score;
                }
                $avg_pure = ($total/$size)/2;
                $avg = floor((($total/$size)/2)*2)/2;
               	
               	$avg_str = str_replace(".","",(string)$avg);

                if($tooltip)
               	    $rating = '<div title="'.$review_meta['review_text'].'" class="'. $class .' rating-small rating-'. $avg_str .' tip"></div>';
                else
                    $rating = '<div class="'. $class .' rating-small rating-'. $avg_str .'"></div>';

                if($echo){
                    echo $rating;
                }else{
                    return $rating;
                }
            }
        }else{
            return "";
        }
    }
}

if(!function_exists("arsene_post_meta")){
    function arsene_post_meta($link = true){
        if($link){
            printf( __( '<div class="post-meta"><time class="post-date" datetime="%1$s">%2$s</time> by <a class="tip post-author" href="%3$s" title="%4$s" rel="author">%5$s</a></div>', 'arsene' ),           
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                esc_attr( sprintf( __( 'View all posts by %s', 'arsene' ), get_the_author() ) ),
                get_the_author()
            );
        }else{
            printf( __( '<div class="post-meta"><time class="post-date" datetime="%1$s">%2$s</time> by <span class="post-author">%3$s</span></div>', 'arsene' ),           
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                get_the_author()
            );
        }
    }
}

if(!function_exists("arsene_post_category")){
    function arsene_post_category(){
        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if($categories){
            $category_count = count($categories);
            $max = 5;
            $i = 1;
            foreach($categories as $category) {
                $output .= '<a class="post-category tip" href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'arsene'), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;                
                if($i == 5)
                    break;
                $i++;
            }
            echo trim($output, $separator);
        }
    }
}

if(!function_exists("arsene_comment_meta")){
    function arsene_comment_meta(){
        if ( comments_open() ) :
            $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

            if ( $num_comments == 0 ) {
                $comments = __('No Comments','arsene');
            } elseif ( $num_comments > 1 ) {
                $comments = $num_comments . __(' Comments','arsene');
            } else {
                $comments = __('1 Comment','arsene');
            }

            $pull = "pull-right";
            if(is_single()){
                $pull = "";
            }

            echo '<div class="post-comment-icon '.$pull.'">';
            echo '<a class="tip" title="'.$comments.'" href="'.get_comments_link().'">';
            echo $num_comments;
            echo '</a>';
            echo '</div>';
        endif;
    }
}

if(!function_exists("arsene_post_pagination")){
    function arsene_post_pagination(){
        global $wp_query;
        if($wp_query->max_num_pages > 1): ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="pagination-container">                                              
                    <div class="pagination">
                        <?php
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            'prev_next' => false,
                            'type' => 'list'
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; 
    }
}

if(!function_exists("arsene_comment_callback")){
    function arsene_comment_callback( $comment, $args, $depth ){       
        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e( 'Pingback:', 'arsene' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'arsene' ), ' ' ); ?></p>
        <?php
                break;
            default :
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-post">
                <?php echo get_avatar( $comment, 50 ); ?>

                <div class="comment-detail">                    
                    <?php printf( __( '%s', 'arsene' ), sprintf( '<div class="comment-author">%s</div>', get_comment_author_link() ) ); ?>                    

                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <div class="comment-status"><?php _e( 'Your comment is awaiting moderation.', 'arsene' ); ?></div>                        
                    <?php endif; ?>

                    <time class="comment-date" datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'arsene' ), get_comment_date(), get_comment_time() ); ?>
                    </time>

                    <div class="comment-message">
                        <?php comment_text(); ?>
                    </div>

                    <div class="comment-action">
                        <?php comment_reply_link( array_merge( array('reply_text'=>'<i class="icon-reply"></i> Reply'), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        <?php edit_comment_link( __( '<i class="icon-edit"></i> Edit', 'arsene' ), ' ' ); ?>
                    </div>

                </div>                    
            </div><!-- comment-post -->
        <?php
                break;
        endswitch;
    }
}


if(!function_exists("arsene_featured_image_slider")){
    function arsene_featured_image_slider(){
        global $post;

        $attachments = get_posts( array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $post->ID,
        ) );

        if ( count($attachments) > 1 && get_arsene_option("arsene_slider_image") ) {
            echo '<div class="flexslider featured-image-slider"><ul class="slides">';
            foreach ( $attachments as $attachment ) {
                $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                $thumbimg = wp_get_attachment_image( $attachment->ID, 'big-image', true );
                echo '<li class="' . $class . ' data-design-thumbnail">' . $thumbimg . '</li>';
            }
            echo '</ul></div>';
        }else{
            the_post_thumbnail('big-image');
        }
    }
}