<?php
add_action('init', 'alura_intercambios_registrando_post_customizado_banner');
add_action('init', 'alura_intercambios_registrando_taxonomia');
add_action('init', 'alura_intercambios_registrando_menu');
add_action('init', 'alura_intercambios_registrando_post_customizado');
add_action('after_setup_theme', 'alura_intercambios_adicionando_recursos_ao_tema');
add_action('add_meta_boxes', 'alura_intercambios_registrando_metabox');
add_action('save_post', 'alura_intercambios_salvando_dados_metabox');
add_action('wp_enqueue_scripts', 'alura_intercambios_adicionando_scripts');

/**
 * Recupera os textos para o banner.
 *
 * Essa função faz uma consulta ao tipo de post "banners" para recuperar os 
 * textos para o banner. 
 * 
 * Ela retorna um array com os valores "texto_1" e "texto_2".
 *
 * @return array Um array com os valores "texto_1" e "texto_2".
 */
function pegandoTextosParaBanner(){
    $args = array(
        'post_type' => 'banners',
        'post_status' => 'publish',
        'posts_per_page' => 1
    );

    $query = new WP_Query($args);
    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
            $text1 = get_post_meta(get_the_ID(),'_texto_home_1',true);
            $text2 = get_post_meta(get_the_ID(),'_texto_home_2',true);
            return array(
                'texto_1' => $text1,
                'texto_2' => $text2
            );
        }
    }
}

/**
 * Adiciona script para animar texto no banner.
 * 
 * @return void
 */
function alura_intercambios_adicionando_scripts(){
    $textosBanner = pegandoTextosParaBanner();

    if(is_front_page()){
        wp_enqueue_script(
            'typed-js', 
            get_template_directory_uri() . '/js/typed.min.js',
            array(),
            false,
            true
        );

        wp_enqueue_script(
            'texto-banner-js',
            get_template_directory_uri() . '/js/texto-banner.js',
            array('typed-js'),
            false,
            true
        );

        wp_localize_script('texto-banner-js', 'data', $textosBanner);
    }
}

/**
 * Registra o metabox banners.
 *
 * @return void
 */
function alura_intercambios_registrando_metabox(){
    add_meta_box(
        'ai_registrando_metabox',
        'Texto para a home',
        'ai_funcao_callback',
        'banners'
    );
}

/**
 * Gera o html da metabox banners.
 *
 * @param mixed $post
 * @return void
 */
function ai_funcao_callback($post){
    $texto_home_1 = get_post_meta(
        $post->ID,
        '_texto_home_1',  
        true
    );

    $texto_home_2 = get_post_meta(
        $post->ID,
        '_texto_home_2',
        true
    );

    echo '<label for="texto_home_1">Texto 1</label>';
    echo '<input type="text" name="texto_home_1" style="width: 100%" value="' . $texto_home_1 . '"/>';
    echo '<br>';
    echo '<label for="texto_home_2">Texto 2</label>';
    echo '<input type="text" name="texto_home_2" style="width: 100%" value="' . $texto_home_2 . '"/>';
}

/**
 * Salva os dados da metabox para o banner.
 *
 * @param int $post_id O ID da postagem que está sendo salva.
 * @return void
 */
function alura_intercambios_salvando_dados_metabox($post_id){
    foreach($_POST as $key=>$value){
        if($key !== 'texto_home_1' && $key !== 'texto_home_2'){
            continue;
        }
        
        update_post_meta(
            $post_id, 
            '_' . $key, 
            $_POST[$key]
        );
    }
}

/**
 * Registra um post personalizado para banners.
 *  
 * @return void
 */
function alura_intercambios_registrando_post_customizado_banner(){
    register_post_type(
        'banners', array(
            'labels' => array('name' => 'Banner'),
            'public' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-format-image',
            'supports' => array('title', 'thumbnail')
        )
    );
}

/**
 * Registra a taxonomia países.
 *
 * @return void
 */
function alura_intercambios_registrando_taxonomia(){
    register_taxonomy(
        'paises',
        'destinos',
        array(
            'labels' => array('name' => 'Países'),
            'hierarchical' => true
        )
    );
}

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