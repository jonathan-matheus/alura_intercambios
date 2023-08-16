<?php

/**
 * Registra um menu de navegação.
 *
 * @return void
 */
function alura_intercambios_registrando_menu(){
    register_nav_menu(
        'menu-navegacao',
        'Menu navegação'
    );
}

/**
 * Adiciona suporte a: 
 * logo customizada
 * thumbnails em posts
 * 
 * @return void
 */
function alura_intercambios_adicionando_recursos_ao_tema(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

/**
 * Registra um tipo de post personalizado para "destinos".
 *
 * @return void
 */
function alura_intercambios_registrando_post_customizado(){
    register_post_type('destinos', array(
        'labels' => array('name' => 'Destinos'),
        'public' => true,
        'menu_position' => 2,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-site'
    ));
}

add_action('init', 'alura_intercambios_registrando_menu');
add_action('init', 'alura_intercambios_registrando_post_customizado');
add_action('after_setup_theme', 'alura_intercambios_adicionando_recursos_ao_tema');