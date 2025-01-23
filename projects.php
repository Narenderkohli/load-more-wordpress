<?php /* Template Name: projects */ ?>
 <?php
 // get the Header
  get_header();
 ?>


 <div class="post-grid-container" id="post-container">
  <?php
       $paged = (get_query_var('paged'))?: 1;
       // Query for custom post type 'project' posts
       $args = array(
        'post_type'      => 'project',  
        'posts_per_page' => 3,        
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'ASC',
        'paged'          => $paged
    );
  $query = new WP_Query($args);
    if ($query->have_posts()) :
        
        while ($query->have_posts()) : $query->the_post();
        
            // Get the post ID and featured image
            $post_id = get_the_ID();
            $url = wp_get_attachment_url(get_post_thumbnail_id($post_id), 'thumbnail');
            ?>
            <div class="post-card">
              <?php if($url): // if post image has then it will run ?> 
                <div class="post-image">
                <a href="<?php echo get_permalink($post_id);?>">
                     <img src="<?php echo esc_url($url); ?>"
                      alt="<?php echo esc_attr(get_the_title($post_id)); ?>">
                      </a>
                </div>
                 <?php  endif; ?>
                <div class="post-content">
                    <h2 class="post-title"><?php echo get_the_title($post_id); ?></h2>
                    <p class="post-excerpt"><?php echo wp_trim_words(get_the_content($post_id), 20, '...'); ?></p>
                    <a href="<?php echo get_permalink($post_id); ?>" class="read-more">Read More</a>
                </div>
            </div>
            <?php
        endwhile;
    else :
        echo '<p>No posts found.</p>';
    endif;

    // Reset query
    wp_reset_postdata();
    ?>
 </div>
    <div class="load-more-custom">
     <button id="load-more">Load More</button>
   </div>

 <?php
 // get the footer
    get_footer();
 ?>


<style>
/* Grid Container */
.post-grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Individual Post Card */
.post-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

/* Post Image */
.post-image img {
    width: 100%;
    height: auto;
    display: block;
}

/* Post Content */
.post-content {
    padding: 15px;
    text-align: center;
}

.post-title {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #0073e6;
}

.post-excerpt {
    font-size: 1em;
    color: #555;
    margin-bottom: 15px;
}

.read-more {
    text-decoration: none;
    font-size: 1em;
    color: #fff;
    background: #0073e6;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.read-more:hover {
    background: #005bb5;
}

.pagination {
    text-align: center;
    margin: 20px 0;
}

.pagination a, .pagination span {
    display: inline-block;
    margin: 0 5px;
    padding: 8px 12px;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
}

.pagination a:hover {
    background-color: #f4f4f4;
    border-color: #999;
}

.pagination .current {
    background-color: #0073aa;
    color: white;
    border-color: #0073aa;
}
.pagination, .comments-pagination {
    border-top: 0px !important;
  }
  .hidden {
    display: none;
}
.load-more-custom {
    text-align: center;
}
/* Responsive Design */
@media (max-width: 768px) {
    .post-title {
        font-size: 1.2em;
    }

    .post-excerpt {
        font-size: 0.9em;
    }
}

</style>




