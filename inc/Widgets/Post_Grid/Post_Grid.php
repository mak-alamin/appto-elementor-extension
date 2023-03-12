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
        return 'eicon-tabs';
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
        $tabs = $this->get_settings_for_display()['Post_Grids'];

        // echo '<pre>';
        // print_r($tabs);
        // echo '</pre>';
        // die();
?>
        <div class="post">
            <div class="col-md-6 res-margin">
                <div class="post-col">
                    <a href="blog-single-1.html"><img alt="" src="image/blog-img-1.jpg"></a>
                    <div class="post-content">
                        <div class="spce md"></div>
                        <ul class="post-meta clearfix">
                            <li>Jan 20, 2018</li>
                            <li>
                                <a href="blog-single-1.html"><i class="fa fa-heart-o" aria-hidden="true"></i>112</a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i>22</a>
                            </li>
                        </ul>
                        <div class="post-text">
                            <a href="blog-single-1.html">
                                <h5>Ultimate goal of future technology in near future.</h5>
                                <div class="spce"></div>
                                <p>Lorem ipsum dolor sit amet, ridens eligendi an nec, his nostro dolorum splendide te. Docendi intellegebat eu pro, ius in facilis reprimique. Primis aliquando vis ne. At per diceret numquam. Ne vim aliquid accusamus
                                    Lorem ipsum dolor sit amet ridens eligendi an nec, his nostro dolorum splendide te. Docendi intellegebat eu pro, ius in facilis reprimique. Primis aliquando vis ne. At per diceret numquam</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="post-col">
                    <a href="blog-single-1.html"><img alt="" src="image/blog-img-2.jpg"></a>
                    <div class="post-content">
                        <div class="spce"></div>
                        <ul class="post-meta clearfix">
                            <li>Jan 19, 2018</li>
                            <li>
                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>112</a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i>22</a>
                            </li>
                        </ul>
                        <div class="post-text">
                            <a href="blog-single-1.html">
                                <h5>How to add custom design in mobile app.</h5>
                                <p>Lorem ipsum dolor sit amet, ridens eligendi an nec, his nostro dolorum splendide te. Docendi intellegebat eu pro. his nostro dolorum eu pro.</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="spce"></div>
                <div class="post-col">
                    <a href="blog-single-1.html"><img alt="" src="image/blog-img-3.jpg"></a>
                    <div class="post-content">
                        <div class="spce"></div>
                        <ul class="post-meta clearfix">
                            <li>Jan 18, 2018</li>
                            <li>
                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>112</a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i>22</a>
                            </li>
                        </ul>
                        <div class="post-text">
                            <a href="blog-single-1.html">
                                <h5>Top 10 revoulationary app for your every day life.</h5>
                                <p>Lorem ipsum dolor sit amet, ridens eligendi an nec his nostro dolorum splendide te intellegebat eu pro.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
