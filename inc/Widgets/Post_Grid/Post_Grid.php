<?php

/**
 * Class Post_Grid
 */

namespace Inc\Widgets\Post_Grid;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

class Post_Grid extends \Elementor\Widget_Base
{
    use \Inc\Traits\Elementor\Controls;

    public function get_name(): string
    {
        return 'appto_post_grid';
    }

    public function get_title()
    {
        return __('AppTo Posts', 'appto-extension');
    }

    public function get_icon(): string
    {
        return 'eicon-posts-grid';
    }

    public function get_categories(): array
    {
        return ['appto-widgets'];
    }

    public function get_keywords()
    {
        return [
            'post',
            'posts',
            'grid',
            'appto post grid',
            'appto posts grid',
            'blog post',
            'article',
            'custom posts',
            'blog',
            'appto',
        ];
    }


    protected function _register_controls()
    {
        $this->require_control_files(__DIR__);
    }

    public function get_script_depends()
    {
        return [];
    }

    protected function render()
    {
        $posts = get_posts(array(
            'numberposts' => 3
        ));

        echo '<div class="post appto-posts">';

        foreach ($posts as $key => $post) {
            $dateTime = new \DateTime($post->post_date);
            $formattedDate = $dateTime->format('M d, Y');

            $content = $post->post_excerpt;

            if(empty($post->post_excerpt)){  
                $words = explode(' ', $post->post_content);

                $content = implode(' ', array_slice($words, 0, 10));
            }
?>
            <div class="col-md-6 res-margin">
                <div class="post-col">
                    <a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_post_thumbnail($post->ID, 'full'); ?></a>
                    <div class="post-content">
                        <div class="spce md"></div>
                        <ul class="post-meta clearfix">
                            <li><?php echo $formattedDate; ?></li>
                            <li>
                                <a href=""><i class="eicon-commenting-o" aria-hidden="true"></i><?php echo $post->comment_count; ?></a>
                            </li>
                        </ul>
                        <div class="post-text">
                            <a href="blog-single-1.html">
                                <h5><?php echo $post->post_title; ?></h5>
                                <div class="spce"></div>
                                <div><?php echo $content; ?></div>
                            </a>
                        </div>
                    </div>
                </div> <!-- ./post-col -->
            </div> <!-- ./col-md-6 -->
<?php
        }

        echo '<div class="spce"></div>';

        echo  '</div>'; // ./posts
    }
}
