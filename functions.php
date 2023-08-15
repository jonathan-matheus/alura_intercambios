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

add_action('init', 'alura_intercambios_registrando_menu');
add_action('after_setup_theme', 'alura_intercambios_adicionando_recursos_ao_tema');