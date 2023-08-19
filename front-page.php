<?php
// carega o cabeçalho
$estiloPagina = 'home.css';
require_once('header.php');

// busca o banner no banco 
$args = array(
    'post_type' => 'banners',
    'post_status' => 'publish',
    'posts_per_page' => 1
);
$query = new WP_Query($args);

// carrega o banner
if($query->have_posts()){
    while($query->have_posts()){
        $query->the_post();
        echo '<main>';
        echo '<div class="imagem-banner">';
        the_post_thumbnail();
        echo '</div>';
        echo '<div class="texto-banner-dinamico">';
        echo '<span id="texto-banner"></span>';
        echo '</div>';
        echo '</main>';
    }
}

// carega a rodape
require_once('footer.php');
?>