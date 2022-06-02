<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

function crb_load() {
    require_once 'vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();

    // Banner blocks Start
    Block::make(__('Banner'))
            ->add_fields([
                Field::make('complex', 'crb_slides', 'Slides')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('image', 'image', 'Image'),
                    Field::make('text', 'title', 'Title'),
                    Field::make('text', 'subtitle', 'Sub Title'),
                    Field::make('text', 'botomtext', 'Bottom Text'),
                    Field::make('text', 'btn_text', 'Button txt'),
                    Field::make('text', 'btn_url', 'Button URL'),
                    Field::make('select', 'banner_style', __('Choose Style'))
                    ->set_options(array(
                        '1' => __('Scroll Down ON'),
                        '2' => __('Scroll Down OFF'),
                    ))
                ]),
            ])
            ->set_icon('align-full-width')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                foreach ($fields as $slide) {
                    foreach ($slide as $item) {
                        $bannerImage = wp_get_attachment_url($item['image']);
                        ?>
                        <div class="container">
                            <div class="banner-details">
                                <div class="row align-items-center">
                                    <div class="col-xl-5">
                                        <div class="banner-content mb-100 pt-100">
                                            <h1 class="banner-title fw-normal mb-4 pb-2 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="300ms">
                                                <?php echo $item['title']; ?>
                                            </h1>
                                            <div class="banner-intro fs-18 fw-normal mb-5 wow fadeInUp" data-wow-duration="2.5s" data-wow-delay="350ms">
                                                <?php echo $item['subtitle']; ?>
                                            </div>
                                            <?php if (!empty($item['btn_url'])) { ?>
                                                <div class="dnd-btn  d-flex wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                                    <a class="btn fs-13 fw-medium bg-clr-blue text-white rounded-2 border-0 px-5 py-3 d-flex rdmbtn" href=" <?php echo $item['btn_url']; ?>">
                                                        <?php echo $item['btn_text']; ?> <span>></span>
                                                       
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div class="col-xl-7 wow fadeInUp" data-wow-duration="2.5s" data-wow-delay="380ms">
                                        <div class="banner-img">
                                            <img src="<?php echo wp_get_attachment_url($item['image']); ?>" alt="images" class="img-fluid w-auto" />
                                        </div>
                                    </div>
                                </div>
                                <div class="page-shape">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/treekon.svg" alt="shape" class="shape-icon img-fluid w-auto" />
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>


                <?php
            }); //  Banner blocks END    
//  Carosol blocks Start
    Block::make(__('Carosol'))
            ->add_fields(array(
                Field::make('text', 'caro_heading', __('Carosol Heading')),
                Field::make('complex', 'crb_carosol', __('Carosol'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('image', 'photo', __('Carosol Photo')),
                ))
            ))
            ->set_icon('format-gallery')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <div class="our-client pb-5 pt-100 container"> 
					<div class="row ">
						<div class="intro col-12 text-blue-dark fw-medium fs-6 text-center pb-4 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                        <?php echo $fields['caro_heading']; ?>
                    </div>
						</div>
                    <div class="our-client row justify-content-center" data-wow-duration="1.5s" data-wow-delay="300ms" id="brand">
                        <?php
                        foreach ($fields['crb_carosol'] as $items) {
                            ?>
                            <div class="col-4 col-lg-3 mb-5 align-items-center justify-content-center">
                                <img src="<?php echo wp_get_attachment_url($items['photo']); ?>" alt="logo" class="img-fluid w-auto cs-img" />
                            </div>   
                        <?php }
                        ?>
                    </div>
					</div>
                    
                </div>
                <?php
            }); //  Carosol blocks End
// Testmonial blocks Start
    Block::make(__('Testmonial'))
            ->add_fields([
                Field::make('text', 'tmheading', __('Section Heading')),
                Field::make('text', 'tmdescription', __('Section Description')),
                Field::make('complex', 'crb_tm', 'Testmonial')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('image', 'pro_image', 'Profile Image'),
                    Field::make('text', 'name', 'Name'),
                    Field::make('text', 'designation', 'Designation'),
                    Field::make('image', 'org_image', 'Organization  Image'),
                    Field::make('rich_text', 'testmonial', 'Testmonial'),
                ]),
            ])
            ->set_icon('admin-comments')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>

                <!-- customers-feedback -->
                <section class="customers-feedback is-bg-images section-padding" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/customer-feedback-bg.svg);">
                    <div class="container">
                        <div class="section-header text-center pb-120">
                            <p class="section-tag text-sky fs-5 fw-medium text-clr-sky wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <?php echo $fields['tmheading']; ?>
                            </p>
                            <h2 class="section-tag fw-bold text-white fs-36 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <?php echo $fields['tmdescription']; ?>
                            </h2>
                        </div>
                        <div class="testimonials-slider owl-carousel owl-theme">
                            <?php
                            foreach ($fields['crb_tm'] as $item) {
                                ?>

                                <div class="row single-slider align-content-center wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                                    <div class="col-lg-4">
                                        <div class="customer-info d-flex justify-content-center">
                                            <div class="info text-center">
                                                <div class="images d-flex justify-content-center">
                                                    <img src="<?php echo wp_get_attachment_url($item['pro_image']); ?>" alt="image" class="customer-img rounded-circle img-fluid w-auto mb-4" />
                                                </div>
                                                <div class="customer-name fs-5 fw-medium text-white mb-3">
                                                    <?php echo $item['name']; ?>
                                                </div>
                                                <div class="designation fw-medium fs-14 text-clr-gray-light mb-5">
                                                    <?php echo $item['designation']; ?>
                                                </div>
                                                <div class="c-logo d-flex justify-content-center">
                                                    <img src="<?php echo wp_get_attachment_url($item['org_image']); ?>" alt="icon" class="img-fluid w-auto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="customer-says">
                                            <div class="customer-say mb-0 fw-normal text-clr-gray-light">
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/quote-icon.svg" alt="icon" class="quote-icon img-fluid w-auto" />
                                                <?php echo $item['testmonial']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                        <div class="page-shape">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/treekon2.svg" alt="shape" class="shape-icon img-fluid w-auto" />
                        </div>
                    </div>
                </section>
                <!--/ customers-feedback End -->
                <?php
            });
//  Testmonial blocks END 
//  Accrodian Content Start
    Block::make(__('Accrodian Content')) 
            ->add_fields([
                Field::make('text', 'acsec_title', __('Section Title')),
                Field::make('rich_text', 'acsec_desc', __('Section Description')),
                Field::make('image', 'abt_image', __('Image')),
                Field::make('select', 'acsec_img_align', __('Image Alignment'))
                ->add_options(array(
                    'left' => __('Left'),
                    'right' => __('Right'),
                )),
                Field::make('text', 'acsec_item_title', __('Item Title')),
                Field::make('rich_text', 'acsec_item_desc', __('Item Description')),
                Field::make('complex', 'acsec_acrodian', 'Items')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'item_heading', 'Heading'),
                    Field::make('image', 'item_img', 'Image'),
                    Field::make('rich_text', 'acsec_item_content', 'Description'),
                ]),
            ])
            ->set_icon('coffee')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <div class="container">
                    <?php if (!empty($fields['acsec_title'])) { ?>
                        <div class="section-header text-center pb-120">
                            <h2 class="section-tag fw-normal text-clr-black fs-48 mb-4 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <?php echo $fields['acsec_title']; ?>                   
                            </h2>
                            <p class="section-intro text-clr-gray fs-18 fw-normal text-clr-sky mb-0 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <?php echo $fields['acsec_desc']; ?>                   
                            </p>
                        </div>

                        <?php
                    };
                    $select_value = $fields['acsec_img_align'];
                    if ($select_value === 'left') {
                        ?>  
                        <div class="row pb-100">
                            <div class="col-lg-6">
                                <div class="img-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="300ms">
                                    <div class="dendi-spl-img">
                                        <img src="<?php echo wp_get_attachment_url($fields['abt_image']); ?>" alt="images" class="img-fluid w-auto" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="faq-wrapper padding-left wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                    <div class="faq-header mb-4 pb-2 pt-2">
                                        <h3 class="title fs-36 fw-medium text-clr-black mb-4">
                                            <?php echo $fields['acsec_item_title']; ?>  
                                        </h3>
                                        <div class="faq-intro text-blue-dark fs-18 fw-normal mb-0">
                                            <?php echo $fields['acsec_item_desc']; ?>  
                                        </div>
                                    </div>
                                    <div class="faq">
                                        <ul class="accordion-list list-unstyled">
                                            <?php
                                            $i = 0;
                                            foreach ($fields['acsec_acrodian'] as $item) {
                                                $open = '';
                                                if ($i == 0) {
                                                    $open = 'open';
                                                };
                                                ?> 
                                                <li class="accordion-list-item px-3 py-3 mb-2 <?php echo $open ?> position-relative mb-4">
                                                    <h5 class="accordion-title d-flex justify-content-between fs-6 fw-medium text-clr-black mb-0 align-items-center">
                                                        <div class="title">
                                                            <img src="<?php echo wp_get_attachment_url($item['item_img']); ?> " alt="icon" class="img-fluid icon-img" />
                                                            <span class="mb-0 ps-3 title-text">
                                                                <?php echo $item['item_heading']; ?>
                                                            </span>
                                                        </div>
                                                        <?php if ($i == 0) { ?>
                                                            <span class="fas fa-angle-up arrow-icon"> </span>
                                                        <?php } else { ?>
                                                            <span class="fas fa-angle-down arrow-icon"> </span>
                                                        <?php } ?>
                                                    </h5>
                                                    <div class="accordion-desc" <?php if ($i !== 0) {echo 'style="display:none;"';}?>>
                                                        <div class="pt-3 fs-6 text-clr-gray fw-normal mb-0">
                                                            <?php echo $item['acsec_item_content']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } elseif ($select_value === 'right') {
                        ?>
                        <div class="row pb-100">

                            <div class="col-lg-6">
                                <div class="faq-wrapper padding-left wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                    <div class="faq-header mb-4 pb-2 pt-2">
                                        <h3 class="title fs-36 fw-medium text-clr-black mb-4">
                                            <?php echo $fields['acsec_item_title']; ?>  
                                        </h3>
                                        <div class="faq-intro text-blue-dark fs-18 fw-normal mb-0">
                                            <?php echo $fields['acsec_item_desc']; ?>  
                                        </div>
                                    </div>
                                    <div class="faq">
                                        <ul class="accordion-list list-unstyled">
                                            <?php
                                            $i = 0;
                                            foreach ($fields['acsec_acrodian'] as $item) {
                                                $open = '';
                                                if ($i == 0) {
                                                    $open = 'open';
                                                };
                                                ?> 
                                                <li class="accordion-list-item px-3 py-3 mb-2 <?php echo $open ?> position-relative mb-4">
                                                    <h5 class="accordion-title d-flex justify-content-between fs-6 fw-medium text-clr-black mb-0 align-items-center">
                                                        <div class="title">
                                                            <img src="<?php echo wp_get_attachment_url($item['item_img']); ?> " alt="icon" class="img-fluid icon-img" />
                                                            <span class="mb-0 ps-3 title-text">
                                                                <?php echo $item['item_heading']; ?>
                                                            </span>
                                                        </div>
                                                        <?php if ($i == 0) { ?>
                                                            <span class="fas fa-angle-up arrow-icon"> </span>
                                                        <?php } else { ?>
                                                            <span class="fas fa-angle-down arrow-icon"> </span>
                                                        <?php } ?>

                                                    </h5>
                                                    <div class="accordion-desc" <?php
                                                    if ($i !== 0) {
                                                        echo 'style="display:none;"';
                                                    }
                                                    ?>>
                                                        <div class="pt-3 fs-6 text-clr-gray fw-normal mb-0">
                                                            <?php echo $item['acsec_item_content']; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="img-wrapper shape-left wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="300ms">
                                    <div class="dendi-spl-img">
                                        <img src="<?php echo wp_get_attachment_url($fields['abt_image']); ?>" alt="images" class="img-fluid w-auto" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php
            }); // Who we are
//  Vedio Lightbx Start
    Block::make(__('Vedio Lightbx'))
            ->add_fields([
                Field::make('text', 'vl_title', __('VL Title')),
                Field::make('rich_text', 'vl_desc', __('VL Description')),
                Field::make('text', 'vl_url', __('Vedio Link')),
                Field::make('text', 'btl_txt', __('BTN Title')),
                Field::make('text', 'btl_link', __('BTN Link'))
            ])
            ->set_icon('video-alt2')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>

                <!-- our-next-platform -->
                <section class="our-next-platform section-padding-custome">
                    <div class="container">
                        <div class="row align-items-center">
                            <div id="vediocontsec" class="col-xl-6">
                                <div class="section-header mb-5 mb-xl-0">
                                    <p  class="section-tag text-white fs-6 fw-medium text-clr-sky wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                                        <?php echo $fields['vl_title']; ?>
                                    </p>
                                    <h2 class="section-tag fw-normal text-white fs-48 mb-5 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                    <span id="vediotext"> <?php echo $fields['vl_desc']; ?></span>   
                                    </h2>
                                   
                                </div>
                            </div>
                            <div class="col-xl-6 vedio_item wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <div class="video-wrapper">
                                    <div class="dnd-btn video-img position-relative">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/gbxgr.png" alt="img" class="img-fluid w-100 h-100" />
										 <a class="btn fs-13 fw-medium bg-clr-red text-white rounded-0 border-0 px-5 py-3 d-inline-flex align-items-center position-absolute top-50 start-50" href=" <?php echo $fields['btl_link']; ?>">
                                            <?php echo $fields['btl_txt']; ?> 
                                            <svg class="ms-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.4248 16.5999L12.8581 11.1666C13.4998 10.5249 13.4998 9.4749 12.8581 8.83324L7.4248 3.3999" stroke="white"
                                                      stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-shape">
                        <svg class="shape-icon" width="113" height="110" viewBox="0 0 113 110" fill="none" xmlns="https://www.w3.org/2000/svg">
                            <path opacity="0.05" d="M30.5361 104.819L3.82146 4.20728L107.752 43.0461L30.5361 104.819Z" stroke="#fff" stroke-width="5" />
                        </svg>
                    </div>
                </section>
                <!--/ our-next-platform -->

                <?php
            }); // Vedio Lightbx End
// Image with text
    Block::make(__('Image With Text Block'))
            ->add_fields(array(
                Field::make('text', 'iwtb_title_top', __('Top Title')),
                Field::make('text', 'iwtb_title', __('Heading')),
                Field::make('rich_text', 'iwtb_text', __('Text')),
                Field::make('text', 'iwtb_test', __('Link Text')),
                Field::make('text', 'iwtb_url', __('Link')),
                Field::make('image', 'iwtb_image', __('image')),
                Field::make('radio', 'iwtb_image_position', __('Image Position'))
                ->add_options(array(
                    'left' => __('Left'),
                    'right' => __('Right'),
                ))
            ))
            ->set_icon('id-alt')
            ->set_category('theme-category', __('Theme Block'), 'forms')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>  

                <div class="row  align-items-center">
                    <?php
                    $img_pos = $fields['iwtb_image_position'];
                    if ($img_pos == 'left') {
                        ?>

                        <div class="col-xl-6">
                            <div class="story-img mb-3 mb-xl-0">
                                <img src="<?php echo wp_get_attachment_url($fields['iwtb_image']); ?>" alt="img" class="img-fluid" />
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="story-intro">
                                <div class="section-header">
                                    <h2 class="title fw-bold mb-2 mb-lg-4">
                                        <?php echo $fields['iwtb_title_top'] ?>
                                    </h2>
                                    <div class="cam-btn wow fadeInRight section-intro fw-normal fs-18 text-clr-gray-deep mb-5 ff-roboto" data-wow-duration="1.5s" data-wow-delay="300ms">
                                        <?php echo $fields['iwtb_text'] ?>
                                        <?php
                                        $link = $fields['iwtb_url'];
                                        if (!empty($link)) {
                                            echo '<a class="btn btn-ht text-decoration-none ff-roboto fw-medium fs-13 is-radius-6 bg-clr-red text-white px-5 py-2 Click-here" data-id="popup_8" data-animation="flipRight" href="' . $fields["iwtb_url"] . '">' . $fields["iwtb_test"] . '</a>';
                                        }
                                        ?>
                                    </div>                           
                                </div>
                            </div>
                        </div>

                    <?php } else {
                        ?>                        

                        <div class="d-none d-lg-block">
                            <div class="row align-items-center">

                                <div class="col-xl-6">
                                    <div class="story-intro">
                                        <div class="section-header">
                                            <h2 class="title  fs-36 fw-bold mb-2 mb-lg-4">
                                                <?php echo $fields['iwtb_title_top'] ?>
                                            </h2>
                                            <div class="cam-btn wow fadeInRight section-intro fw-normal fs-18 text-clr-gray-deep mb-5 ff-roboto" data-wow-duration="1.5s" data-wow-delay="300ms">
                                                <?php echo $fields['iwtb_text'] ?>
                                                <?php
                                                $link = $fields['iwtb_url'];
                                                if (!empty($link)) {
                                                    echo '<a class="btn btn-ht text-decoration-none ff-roboto fw-medium fs-13 is-radius-6 bg-clr-red text-white px-5 py-2 Click-here" data-id="popup_8" data-animation="flipRight" href="' . $fields["iwtb_url"] . '">' . $fields["iwtb_test"] . '</a>';
                                                }
                                                ?>
                                            </div>                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="story-img mb-3 mb-xl-0">
                                        <img src="<?php echo wp_get_attachment_url($fields['iwtb_image']); ?>" alt="img" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-block d-lg-none">
                            <div class="row align-items-center">
                                <div class="col-xl-6">
                                    <div class="story-img mb-3 mb-xl-0">
                                        <img src="<?php echo wp_get_attachment_url($fields['iwtb_image']); ?>" alt="img" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="story-intro">
                                        <div class="section-header">
                                            <h2 class="title  fs-36 fw-bold mb-2 mb-lg-4">
                                                <?php echo $fields['iwtb_title_top'] ?>
                                            </h2>
                                            <div class="cam-btn wow fadeInRight section-intro fw-normal fs-18 text-clr-gray-deep mb-5 ff-roboto" data-wow-duration="1.5s" data-wow-delay="300ms">
                                                <?php echo $fields['iwtb_text'] ?>
                                                <?php
                                                $link = $fields['iwtb_url'];
                                                if (!empty($link)) {
                                                    echo '<a class="btn btn-ht text-decoration-none ff-roboto fw-medium fs-13 is-radius-6 bg-clr-red text-white px-5 py-2Click-here" data-id="popup_8" data-animation="flipRight" href="' . $fields["iwtb_url"] . '">' . $fields["iwtb_test"] . '</a>';
                                                }
                                                ?>
                                            </div>                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


                <?php
            });

// Image with text end  
// 
// Related Resources Start

    Block::make(__('Related Resources Carousel'))
            ->add_fields(array(
                Field::make('text', 'rrsectitle', __('Section Heading')),
                Field::make('complex', 'rr_slider', __('Related Resources Item'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'rrtitle', __('Heading')),
                    Field::make('rich_text', 'rr_text', __('Content')),
                    Field::make('text', 'rr_ltest', __('Link Text')),
                    Field::make('text', 'rr_url', __('Link')),
                    Field::make('image', 'rr_image', __('image')),
                ))
            ))
            ->set_icon('image-rotate')
            ->set_category('theme-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>  
                <!-- related-resources -->
                <section class="related-resources section-padding">
                    <div class="container">           

                        <div class="section-header text-center">
                            <h2 class="section-title fw-normal text-clr-black fs-36 mb-100">
                                <?php echo $fields['rrsectitle'] ?>
                            </h2>
                        </div>
                        <div class="resources-wrapper row align-items-center">
                            <?php foreach ($fields['rr_slider'] as $item) { ?>
                                <div class="col-md-12 col-lg-4 single-resources">
									<div class="innewwrwpper bg-white">									
                                    <div class="resources-img text-center mb-5">
                                        <img src="<?php echo wp_get_attachment_url($item['rr_image']); ?>" alt="image" class="img-fluid w-auto" />
                                    </div>
                                    <div class="resource-body">
                                        <h3 class="resource-title fs-5 fw-medium text-clr-black mb-4">
                                            <?php echo $item['rrtitle'] ?>
                                        </h3>
                                        <div class="resource-intro fs-6 fw-normal text-clr-gray mb-4 pb-2">
                                            <?php echo $item['rr_text'] ?>
                                        </div>
                                        <a class="fs-14 fw-medium text-clr-blue text-decoration-none d-inline-flex align-items-center rdmbtn" href="<?php echo $item['rr_url'] ?>">
                                          <?php echo $item['rr_ltest'] ?> <span> > </span>
                                            
                                        </a>
                                    </div>
                                </div>   
									</div>
                            <?php }; ?>            
                        </div>
                    </div>
                    <div class="page-shape">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/treekon3.svg" alt="shape" class="shape-icon img-fluid w-auto" />
                    </div>
                </section>
                <?php
            });
// Related Resources End
//Get In Touch Section Strat
    Block::make(__('Get In Touch'))
            ->add_fields([
                Field::make('text', 'get_heading', __('Heading')),
                Field::make('rich_text', 'get_content', __('Content')),
                Field::make('complex', 'get_slider', __('Get In Touch Item'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('text', 'gettitle', __('Heading')),
                    Field::make('text', 'get_text', __('Email')),
                    Field::make('text', 'get_ltest', __('Link Text')),
                    Field::make('text', 'get_url', __('Link')),
                    Field::make('textarea', 'get_svg', __('SVG Code')),
                    Field::make('image', 'get_image', __('image')),
                ))
            ])
            ->set_icon('networking')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>

                <section class="get-in-touch">
                    <div class="container">
                        <div class="section-header text-center mb-100">
                            <h2 class="section-tag fw-normal text-clr-black fs-36 mb-4 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <?php echo $fields['get_heading'] ?>
                            </h2>
                            <div class="section-intro fs-18 text-clr-gray lh-lg fw-normal wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                <?php echo $fields['get_content'] ?>
                            </div>
                        </div>
                        <div class="support-wrapper">
                            <div class="row justify-content-center">
                                <?php foreach ($fields['get_slider'] as $item) { ?>
                                    <div class="col-xl-4 col-lg-6 wow fadeInUp single_item" data-wow-duration="1.5s" data-wow-delay="300ms">
                                        <div class="support text-center bg-white position-relative mb-5 mb-xl-0">
                                            <div class="support-icon mb-4 position-absolute">
                                                <?php
                                                $svg = $item['get_svg'];
                                                if (!empty($svg)) {
                                                    echo $svg;
                                                } else {
                                                    ?>
                                                    <img src="<?php echo wp_get_attachment_url($fields['get_image']); ?>" alt="img" class="img-fluid" />
                                                <?php }; ?>
                                            </div>
                                            <h4 class="support-title fs-18 text-clr-black fw-medium mb-3">
                                                <?php echo $item['gettitle'] ?>
                                            </h4>
                                            <div class="support-email mb-3">
                                                <a class="text-blue-dark text-decoration-none fs-6 fw-normal" href="mailto:<?php echo $item['get_text'] ?>">
                                                    <?php echo $item['get_text'] ?>
                                                </a>
                                            </div>
                                            <a class="fs-14 fw-medium text-clr-blue text-decoration-none d-inline-flex align-items-center rdmbtn " href="<?php echo $item['get_url'] ?>">
                                                <?php echo $item['get_ltest'] ?> <span>></span>
                                                
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ get-in-touch -->


                <?php
            });

//Get In Touch Section End
// Services blocks Start
    Block::make(__('Services'))
            ->add_fields([
                Field::make('text', 'srv_heading', __('Services Heading')),
                Field::make('image', 'srv_icon', __('Services Icon')),
                Field::make('textarea', 'svgcntent', __('SVG')),
                Field::make('rich_text', 'srv_content', __('Services Content')),
                Field::make('select', 'srv_content_align', __('Style Selection'))
                ->add_options(array(
                    '1' => __('Style 1'),
                    '2' => __('Style 2'),
                ))
            ])
            ->set_icon('networking')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <?php if ($fields['srv_content_align'] == '1') { ?>
                    <div class="mb-4 wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                        <div class="card-info bg-white h-100">
                            <div class="title d-flex gap-3 align-items-center mb-3">
                    <?php if (!empty($fields['srv_icon'])) { ?>
                                    <img src="<?php echo wp_get_attachment_url($fields['srv_icon']); ?>" alt="icon" class="img-fluid" />
                                    <?php
                                } else {
                                    echo $fields['svgcntent'];
                                }
                                ?>
                                <h4 class="title-text fw-medium fs-5 text-clr-black mb-0">
                                <?php echo $fields['srv_heading']; ?>
                                </h4>
                            </div>
                            <div class="intro mb-0 fw-normal fs-18">
                    <?php echo $fields['srv_content']; ?>
                            </div>
                        </div>
                    </div>
                <?php } elseif ($fields['srv_content_align'] == '2') { ?>

                    <div class="mb-4">
                        <div class="card-info h-100 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                            <div class="title">
                    <?php if (!empty($fields['srv_icon'])) { ?>
                                    <img src="<?php echo wp_get_attachment_url($fields['srv_icon']); ?>" alt="icon" class="icon img-fluid w-auto" />
                                    <?php
                                } else {
                                    echo $fields['svgcntent'];
                                }
                                ?>
                                <h4 class="title-text fw-medium fs-6 text-clr-black mb-3">
                                <?php echo $fields['srv_heading']; ?>
                                </h4>
                            </div>
                            <div class="intro mb-0 fw-normal fs-18">
                    <?php echo $fields['srv_content']; ?>
                            </div>
                        </div>
                    </div>   
                    <?php
                }
            });
    // Services blocks END
// Resource Library Block Starat
    Block::make(__('Resource Library'))
            ->add_fields(array(
                Field::make('complex', 'rl_tab', __('Resource Library Item'))
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('image', 'rl_image', __('Icon')),
                    Field::make('text', 'rl_title', __('Type/Category')),
                    Field::make('text', 'rl_desc', __('Title')),
                    Field::make('text', 'rl_url', __('Link')),
                ))
            ))
            ->set_icon('id-alt')
            ->set_category('theme-category', __('Yeasfi Theme Blocks'), '')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>      
                <section class="get-file-details section-padding bg-white">
                    <div class="container">                       
                                <div class="row justify-content-center">
                <?php foreach ($fields['rl_tab'] as $item) {
; ?>
                                        <div class="col-lg-4 wow fadeInUp mb-4 single_item" data-wow-duration="1.5s" data-wow-delay="300ms">
                                            <div class="card-info bg-white h-100 is-shadow">
                                                <div class="title">
                                                    <img src="<?php echo wp_get_attachment_url($item['rl_image']); ?>" alt="icon" class="icon img-fluid mb-4" />
                                                    <p class="file-type fs-6 fw-medium lh-base mb-2 text-clr-gray">
                    <?php echo $item['rl_title']; ?>
                                                    </p>
                                                    <h4 class="title-text fw-medium fs-5 text-clr-black mb-4">
                                                        <?php echo $item['rl_desc']; ?>
                                                    </h4>
                                                </div>
                                                <a class="fs-14 fw-medium text-clr-blue text-decoration-none d-inline-flex align-items-center rdmbtn" href=" <?php echo $item['rl_url']; ?>">
                                                    Learn More <span>></span>
                                                    
                                                </a>
                                            </div>
                                        </div>
                <?php } ?>
                                </div>
                           
                        <div class="page-shape">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/treekon5.svg" alt="shape" class="shape-icon img-fluid w-auto" />
                        </div>
                    </div>
                </section>

                <?php
            });

    // Resource Library Block end
    //Footer Top Section End
    //Footer Top Section End
    Block::make(__('Team Member'))
            ->add_fields([
                Field::make('text', 'sec_title', __('Section Heading')),
                Field::make('association', 'crb_association', __('Select People'))
                ->set_types(array(
                    array(
                        'type' => 'post',
                        'post_type' => 'ourteam',
                    )
                ))
            ])
            ->set_icon('groups')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                $id = $fields['crb_association'];
                $postId = $id[0]['id'];
                $postdata = get_post($id[0]['id']);
                $featured_img_url = get_the_post_thumbnail_url($id[0]['id'], 'full');
                $f = carbon_get_the_post_meta($postId, 'designation');
                // var_dump($f);
                // global $post;
                $a = get_post_meta($postId, ( carbon_get_the_post_meta('')), true);
                ?>

                <div class="team-member-widget mb-4">
                    <img src="<?php echo $featured_img_url; ?>" alt="img" class="img-fluid" />
                    <div class="member-widget-content bg-white rounded">
                        <h5 class="member-name mb-1 text-dark lh-base"><?php echo $postdata->post_title; ?></h5>
                        <p class="member-designation text-dark mb-2 lh-base">
                            <small><?php echo $a['_designation'][0]; ?></small>
                        </p>
                        <ul class="social-network mb-0 list-unstyled d-inline-flex align-items-center">
                <?php if (!empty($a['_fb'][0])) { ?>
                                <li class="mx-1">
                                    <a href="<?php echo $a['_fb'][0]; ?>">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                </li>
                    <?php
                };
                if (!empty($a['_link'][0])) {
                    ?>
                                <li class="mx-1">
                                    <a href="<?php echo $a['_link'][0]; ?>">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                </li>
                                <?php
                            };
                            if (!empty($a['_twitter'][0])) {
                                ?>
                                <li class="mx-1">
                                    <a href="<?php echo $a['_twitter'][0]; ?>">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                </li>
                                <?php
                            };
                            if (!empty($a['_youtube'][0])) {
                                ?>
                                <li class="mx-1">
                                    <a href="<?php echo $a['_youtube'][0]; ?>">
                                        <i class="bi bi-youtube"></i>                                   
                                    </a>
                                </li>
                                <?php
                            };
                            if (!empty($a['_instagram'][0])) {
                                ?>
                                <li class="mx-1">
                                    <a href="<?php echo $a['_instagram'][0]; ?>">
                                        <i class="bi bi-youtube"></i>                                   
                                    </a>
                                </li>
                            <?php }; ?>
                        </ul>


                    </div>
                </div>

                            <?php
                        }); //  About Us END
// Our Statistics blocks Start
                Block::make(__('Our Statistics'))
                        ->add_fields([
                            Field::make('text', 'clientsatisfy', __('Client Satisfy')),
                            Field::make('text', 'projectcomplete', __('Project Complete')),
                            Field::make('text', 'services', __('Services')),
                            Field::make('text', 'experience', __('Years Experience')),
                        ])
                        ->set_icon('chart-line')
                        ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
                        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                            ?>
                <section class="our-statistics bg-azure">
                    <div class="container">
                        <div class="statistics-box bg-white py-4 px-5 is-radius is-shadow">
                            <div class="section-header text-center py-4 statistics-title">
                                <h2 class="mb-2 fw-semi-bold fs-5 mt-1"> 
                                    Our <span class="text-tail">Statistics</span>
                                </h2>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-3 col-md-6">
                                    <div class="role d-flex align-items-center gap-3 mb-4 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="300ms">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="30" cy="30" r="30" fill="#D7FCFF"></circle>
                                            <path d="M34.0195 28.9143C35.8405 28.9143 37.3165 27.4383 37.3165 25.6173C37.3165 23.7973 35.8405 22.3203 34.0195 22.3203" stroke="#00939C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M35.5361 32.4961C36.0801 32.5331 36.6201 32.6111 37.1531 32.7291C37.8921 32.8761 38.7821 33.1791 39.0981 33.8421C39.3001 34.2671 39.3001 34.7621 39.0981 35.1871C38.7831 35.8501 37.8921 36.1531 37.1531 36.3051" stroke="#00939C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.591 33.207C31.281 33.207 34.433 33.766 34.433 35.999C34.433 38.233 31.301 38.811 27.591 38.811C23.901 38.811 20.75 38.253 20.75 36.019C20.75 33.785 23.881 33.207 27.591 33.207Z" stroke="#00939C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.591 30.019C25.157 30.019 23.207 28.068 23.207 25.634C23.207 23.201 25.157 21.25 27.591 21.25C30.025 21.25 31.976 23.201 31.976 25.634C31.976 28.068 30.025 30.019 27.591 30.019Z" stroke="#00939C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="role-content flex-grow-1">
                                            <h4 class="fs-4 fw-bold"> <span class="counter"><?php echo $fields['clientsatisfy']; ?></span> +</h4>
                                            <p class="text-sm-size fw-light mb-0"><small>Client Satisfy</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="role d-flex align-items-center gap-3 mb-4 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="500ms">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="30" cy="30" r="30" fill="#FFEDF3"></circle>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M34.334 20.75H25.665C22.644 20.75 20.75 22.889 20.75 25.916V34.084C20.75 37.111 22.635 39.25 25.665 39.25H34.333C37.364 39.25 39.25 37.111 39.25 34.084V25.916C39.25 22.889 37.364 20.75 34.334 20.75Z" stroke="#FF99BE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M26.4395 30.0019L28.8135 32.3749L33.5595 27.6289" stroke="#FF99BE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="role-content flex-grow-1">
                                            <h4 class="fs-4 fw-bold"> <span class="counter"><?php echo $fields['projectcomplete']; ?></span> +</h4>
                                            <p class="text-sm-size fw-light mb-0"><small>Project Complete</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="role d-flex align-items-center gap-3 mb-4 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="700ms">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="30" cy="30" r="30" fill="#D7F6ED"></circle>
                                            <path d="M35.2676 27.0625L31.0022 30.4968C30.1949 31.1296 29.0634 31.1296 28.2562 30.4968L23.9541 27.0625" stroke="#68DBBA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.8879 21.5H34.3158C35.6752 21.5152 36.969 22.0899 37.896 23.0902C38.823 24.0905 39.3022 25.429 39.222 26.7941V33.322C39.3022 34.6871 38.823 36.0256 37.896 37.0259C36.969 38.0262 35.6752 38.6009 34.3158 38.6161H24.8879C21.968 38.6161 20 36.2407 20 33.322V26.7941C20 23.8754 21.968 21.5 24.8879 21.5Z" stroke="#68DBBA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="role-content flex-grow-1">
                                            <h4 class="fs-4 fw-bold"> <span class="counter"><?php echo $fields['services']; ?></span></h4>
                                            <p class="text-sm-size fw-light mb-0"><small>Services</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="role d-flex align-items-center gap-3 mb-4 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="900ms">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="30" cy="30" r="30" fill="#FFF3E2"></circle>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M39.25 30C39.25 35.109 35.109 39.25 30 39.25C24.891 39.25 20.75 35.109 20.75 30C20.75 24.891 24.891 20.75 30 20.75C35.109 20.75 39.25 24.891 39.25 30Z" stroke="#FFC56D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M33.4311 32.9437L29.6611 30.6947V25.8477" stroke="#FFC56D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>

                                        <div class="role-content flex-grow-1">
                                            <h4 class="fs-4 fw-bold"> <span class="counter"><?php echo $fields['experience']; ?></span> +</h4>
                                            <p class="text-sm-size fw-light mb-0"><small>Years Experience</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }); // Our Statistics blocks END
    //
    //
    //
    //
    //
// Title blocks Start
    Block::make(__('Title Block'))
            ->add_fields([
                Field::make('text', 'small_title', __('Small Heading')),
                Field::make('text', 'big_title', __('Big Heading')),
            ])
            ->set_icon('heading')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <div class="row mb-5">
                    <div class="col-xl-10 mx-auto">
                        <div class="section-header text-center">
                            <h2 class="title fw-bold mb-2 mb-lg-4"><?php echo $fields['small_title']; ?></h2>

                            <p class="mb-0 sub-title">     <?php echo $fields['big_title']; ?></p>

                        </div>
                    </div>
                </div>
                <?php
            }); // Title blocks END
// Trusted by Carousel blocks Start
    Block::make(__('Trusted by Carousel'))
            ->add_fields([
                Field::make('complex', 'tb_carousel', 'Partners')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'tb_sec_title', __('Title')),
                    Field::make('image', 'tb_logo', 'Logo'),
                ]),
            ])
            ->set_icon('ellipsis')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <section class="partners section-padding">
                    <div class="container">
                        <div class="row text-center">
                <?php
                foreach ($fields as $tbslide) {
                    if (is_array($tbslide) || is_object($tbslide)) {
                        foreach ($tbslide as $item) {
                            // var_dump($item);
                            ?>
                                        <div class="col-xl-4 col-sm-6 mb-4">
                                            <div class="partner-widget bg-white border p-4 is-rounded  h-100">
                                                <img src="<?php echo wp_get_attachment_url($item['tb_logo']); ?>" alt="img" class="img-fluid mb-3"  />
                                                <p class="mb-0 text-dark">
                                                    <small><?php echo $item['tb_sec_title']; ?></small>
                                                </p>
                                            </div>
                                        </div>


                            <?php
                        }
                    }
                }
                ?>
                        </div>
                    </div>
                </section>  
                            <?php
                        }); // Trusted by Carousel blocks END
                // Tab blocks Start
                Block::make(__('Project Tab'))
                        ->add_fields([
                            Field::make('complex', 'p_tab_nave', 'Project Tab Nave')
                            ->set_layout('tabbed-horizontal')
                            ->add_fields([
                                Field::make('text', 'p_title_name', __('Tab Name')),
                            ]),
                            Field::make('complex', 'p_tab', 'Project Tab')
                            ->set_layout('tabbed-horizontal')
                            ->add_fields([
                                Field::make('text', 'p_title', __('Project Name')),
                                Field::make('image', 'pro_img', 'Project Image'),
                                Field::make('text', 'p_link', __('Project Link')),
                                Field::make('text', 'nave_name', __('Tab Name')),
                            ]),
                        ])
                        ->set_icon('schedule')
                        ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
                        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                            ?>
                <section class="works">
                    <div class="container">
                        <div id="filterNav"
                             class="filter-buttons d-flex align-items-center justify-content-center gap-2 mb-5 wow fadeInDown"
                             data-wow-duration="1.5s" data-wow-delay="200ms">
                            <button data-filter="*" type="button"
                                    class="btn btn-iss-fill text-white px-2 px-xl-4 py-1 py-xl-2 rounded-pill"> All Project </button>
                <?php
                $i = 0;
                foreach ($fields['p_tab_nave'] as $naves) {
                    ?>
                                <button data-filter=".<?php echo $naves['p_title_name']; ?>" type="button" class="btn px-2 px-xl-4 py-1 py-xl-2 rounded-pill"> <?php echo $naves['p_title_name']; ?>
                                </button>
                    <?php
                    $i++;
                }
                ?>

                        </div>

                        <div class="works-grid filterGridRow wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="300ms">
                <?php
                $i = 0;
                foreach ($fields['p_tab'] as $ptab) {
                    // var_dump($ptab);
                    // if (is_array($ptab) || is_object($ptab)) {
                    // foreach ($fields['p_tab_nave'] as $naves) {
                    ?>
                                <div class="grid-item filterGridItem  <?php echo $ptab['nave_name']; ?>">
                                    <img src="<?php echo wp_get_attachment_url($ptab['pro_img']); ?>" alt="img" class="img-fluid" />
                                    <div class="grid-item-overlay">
                                        <p class="mb-1 text-yellow"><small><?php echo $ptab['nave_name'] ?></small></p>
                                        <p class="mb-0 text-white"><?php echo $ptab['p_title'] ?></p>
                                        <a href="<?php echo $ptab['p_link'] ?>"> </a>
                                    </div>
                                </div>
                                <?php
                                $i++;
                                // }
                                //}
                            }
                            ?>
                        </div>
                    </div>
                </section>
                            <?php
                        }); // Tab blocks END
// Work Process blocks Start
                Block::make(__('Work Process'))
                        ->add_fields([
                            Field::make('image', 'work_image', 'Item Image'),
                            Field::make('text', 'work_title', 'Title'),
                            Field::make('rich_text', 'work_content', 'Content'),
                            Field::make('text', 'work_url', 'Url'),
                        ])
                        ->set_icon('embed-photo')
                        ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
                        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                            ?>
                <div id="work-process-grid" class="row align-items-start work-process-grid element <?php echo $fields['work_title'] ?>">                
                    <div class="work-process-grid wow fadeInDown" data-wow-duration="1.5s"
                         data-wow-delay="200ms">
                        <div class="work-processItem p-0 p-xl-4 mb-5 d-flex gap-3 align-items-center d-xl-block">

                            <div class="processItem-icon flex-shrink-0 d-flex align-items-center justify-content-center mb-xl-4 m-0 m-xl-auto">
                                <img src="<?php echo wp_get_attachment_url($fields['work_image']); ?>" alt="img" class="img-fluid" />
                            </div>
                            <div class="work-process-item-content text-start text-xl-center">
                                <h6 class="mb-xl-3 mb-2 text-white title"><?php echo $fields['work_title'] ?></h6>
                                <p class="text-white fw-normal description mb-0 mb-xl-2"><?php echo $fields['work_content'] ?>
                                </p>
                            </div>

                        </div>
                    </div>                       
                </div>
                <?php
            }); //  Work Process blocks END


    Block::make(__('Gallery'))
            ->add_fields([
                Field::make('media_gallery', 'crb_media_gallery', __('Media Gallery'))
                ->set_duplicates_allowed(false)
            ])
            ->set_icon('photo')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <div class="works-grid filterGridRow wow fadeInDown" data-wow-duration="1.5s" data-wow-delay="400ms">

                <?php
                foreach ($fields as $items):
                    foreach ($items as $item):
                        ?>
                            <div class="grid-item filterGridItem">  
                                <img src="<?php echo wp_get_attachment_image_url($item); ?>"class="img-fluid" alt="Image" />
                                <div class="grid-item-overlay"></div>
                            </div>
                        <?php
                    endforeach;
                endforeach;
                ?>

                </div>
                <?php
            }); //  Gallery END
    // Contact blocks start 

    Block::make(__('Contact us (Inquiries)'))
            ->add_fields([
                Field::make('text', 'cont_email', __('General Inquiries')),
                Field::make('text', 'bd_cont_email', __('Business Development')),
                Field::make('text', 'pr_cont_email', __('Public Relations')),
            ])
            ->set_icon('email')
            ->set_category('custom-category', __('Yeasfi Theme Blocks'), 'Yeasfi Block')
            ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
                ?>
                <!-- our-statistics -->
                <section class="business-mail mt-4">
                    <div class="container">
                        <div class="mailing-address p-5 rounded">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mailAddressWidget d-flex align-items-center mb-4 gap-4">
                                        <svg class="flex-shrink-0" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.2" cx="30" cy="30" r="29" stroke="#3F6C9B" stroke-width="2" />
                                            <path opacity="0.4"
                                                  d="M40 33.94C40 36.73 37.76 38.99 34.97 39H34.96H25.05C22.27 39 20 36.75 20 33.96V33.95C20 33.95 20.006 29.524 20.014 27.298C20.015 26.88 20.495 26.646 20.822 26.906C23.198 28.791 27.447 32.228 27.5 32.273C28.21 32.842 29.11 33.163 30.03 33.163C30.95 33.163 31.85 32.842 32.56 32.262C32.613 32.227 36.767 28.893 39.179 26.977C39.507 26.716 39.989 26.95 39.99 27.367C40 29.576 40 33.94 40 33.94Z"
                                                  fill="#3F6C9B" />
                                            <path
                                                d="M39.4759 23.674C38.6099 22.042 36.9059 21 35.0299 21H25.0499C23.1739 21 21.4699 22.042 20.6039 23.674C20.4099 24.039 20.5019 24.494 20.8249 24.752L28.2499 30.691C28.7699 31.111 29.3999 31.32 30.0299 31.32C30.0339 31.32 30.0369 31.32 30.0399 31.32C30.0429 31.32 30.0469 31.32 30.0499 31.32C30.6799 31.32 31.3099 31.111 31.8299 30.691L39.2549 24.752C39.5779 24.494 39.6699 24.039 39.4759 23.674Z"
                                                fill="#3F6C9B" />
                                        </svg>
                                        <div class="mailAddressWidget-content flex-grow-1">
                                            <p class="mb-1 fw-bold text-dark">General Inquiries</p>
                                            <p class="mb-0 text-muted"><a href="mailto:<?php echo $fields['cont_email']; ?>"><?php echo $fields['cont_email']; ?></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mailAddressWidget d-flex align-items-center mb-4 gap-4">
                                        <svg class="flex-shrink-0" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.2" cx="30" cy="30" r="29" stroke="#68DBBA" stroke-width="2" />
                                            <path opacity="0.4"
                                                  d="M40 33.94C40 36.73 37.76 38.99 34.97 39H34.96H25.05C22.27 39 20 36.75 20 33.96V33.95C20 33.95 20.006 29.524 20.014 27.298C20.015 26.88 20.495 26.646 20.822 26.906C23.198 28.791 27.447 32.228 27.5 32.273C28.21 32.842 29.11 33.163 30.03 33.163C30.95 33.163 31.85 32.842 32.56 32.262C32.613 32.227 36.767 28.893 39.179 26.977C39.507 26.716 39.989 26.95 39.99 27.367C40 29.576 40 33.94 40 33.94Z"
                                                  fill="#68DBBA" />
                                            <path
                                                d="M39.4759 23.674C38.6099 22.042 36.9059 21 35.0299 21H25.0499C23.1739 21 21.4699 22.042 20.6039 23.674C20.4099 24.039 20.5019 24.494 20.8249 24.752L28.2499 30.691C28.7699 31.111 29.3999 31.32 30.0299 31.32C30.0339 31.32 30.0369 31.32 30.0399 31.32C30.0429 31.32 30.0469 31.32 30.0499 31.32C30.6799 31.32 31.3099 31.111 31.8299 30.691L39.2549 24.752C39.5779 24.494 39.6699 24.039 39.4759 23.674Z"
                                                fill="#68DBBA" />
                                        </svg>
                                        <div class="mailAddressWidget-content flex-grow-1">
                                            <p class="mb-1 fw-bold text-dark">Business Development</p>
                                            <p class="mb-0 text-muted"><a href="mailto:<?php echo $fields['bd_cont_email']; ?>"><?php echo $fields['bd_cont_email']; ?></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mailAddressWidget d-flex align-items-center mb-4 gap-4">
                                        <svg class="flex-shrink-0" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle opacity="0.2" cx="30" cy="30" r="29" stroke="#FF99BE" stroke-width="2" />
                                            <path opacity="0.4"
                                                  d="M40 33.94C40 36.73 37.76 38.99 34.97 39H34.96H25.05C22.27 39 20 36.75 20 33.96V33.95C20 33.95 20.006 29.524 20.014 27.298C20.015 26.88 20.495 26.646 20.822 26.906C23.198 28.791 27.447 32.228 27.5 32.273C28.21 32.842 29.11 33.163 30.03 33.163C30.95 33.163 31.85 32.842 32.56 32.262C32.613 32.227 36.767 28.893 39.179 26.977C39.507 26.716 39.989 26.95 39.99 27.367C40 29.576 40 33.94 40 33.94Z"
                                                  fill="#FF99BE" />
                                            <path
                                                d="M39.4759 23.674C38.6099 22.042 36.9059 21 35.0299 21H25.0499C23.1739 21 21.4699 22.042 20.6039 23.674C20.4099 24.039 20.5019 24.494 20.8249 24.752L28.2499 30.691C28.7699 31.111 29.3999 31.32 30.0299 31.32C30.0339 31.32 30.0369 31.32 30.0399 31.32C30.0429 31.32 30.0469 31.32 30.0499 31.32C30.6799 31.32 31.3099 31.111 31.8299 30.691L39.2549 24.752C39.5779 24.494 39.6699 24.039 39.4759 23.674Z"
                                                fill="#FF99BE" />
                                        </svg>
                                        <div class="mailAddressWidget-content flex-grow-1">
                                            <p class="mb-1 fw-bold text-dark">Public Relations</p>
                                            <p class="mb-0 text-muted"><a href="mailto:<?php echo $fields['pr_cont_email']; ?>"><?php echo $fields['pr_cont_email']; ?></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
            }); //  Contact END       
//  Function END
}

add_action('after_setup_theme', 'crb_load');

