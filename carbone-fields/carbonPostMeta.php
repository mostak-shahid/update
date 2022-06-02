<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options() {
    Container::make('post_meta', 'Additional Service Item')
            ->where('post_type', '=', 'services')
            ->add_tab(__('Additional Information'), array(
                Field::make('image', 'crb_weekly_rent', 'Icon'),
    ));

    Container::make('post_meta', 'Customer Information')
            ->where('post_type', '=', 'customers')
            ->add_tab(__('Information'), array(
                Field::make('text', 'clients_platforms', 'Designation'),
                Field::make('rich_text', 'clients_tmcomtent', 'Content'),
                Field::make('image', 'clients_logo', 'Brand Logo'),
                Field::make('file', 'clients_pdf', 'Case study PDF')
                ->set_value_type('url'),
    ));

    Container::make('post_meta', 'Job Location')
            ->where('post_type', '=', 'careers')
            ->add_tab(__('Additional Information'), array(
                Field::make('text', 'crb_joblocation', 'Location'),
    ));
    Container::make('post_meta', 'Current Openings')
            ->where('post_type', '=', 'page')
            ->show_on_template("careers.php")
            ->add_fields(array(
                Field::make('text', 'crb_careerst', 'Section Title'),
                 Field::make('text', 'crb_careersd', 'Section Description'),
    ));
    Container::make('post_meta', ' Page Title Section')
            ->where('post_type', '=', 'page')
            ->show_on_template("innerpage.php")
            ->add_fields(array(
                Field::make('text', 'crb_subheading', 'Subheading'),
                 Field::make('text', 'crb_header', 'Header'),               
                 Field::make('text', 'crb_another_subheading', 'Another Subheading'),
				 Field::make('text', 'crb_button', 'Button URL'),
				Field::make('text', 'crb_button_title', 'Button Title'),
    ));

    Container::make('post_meta', ' Feedback Section Title')
            ->where('post_type', '=', 'page')
            ->show_on_template("innerpage.php")
            ->add_fields(array(
                Field::make('text', 'crb_fst', 'Section Title'),
                 Field::make('text', 'crb_fsd', 'Section Description'),
    ));
}
