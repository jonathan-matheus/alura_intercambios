<?php
$estiloPagina = 'sobre_nos.css';
require_once('header.php'); //carega o cabeçalho do site

// exibe o conteudo da página
if(have_posts()){
    echo '<main class="main-sobre-nos">';
    while(have_posts()){
        the_post();
        the_post_thumbnail('post-thumbnail', array('class' => 'imagem-sobre-nos'));
        echo '<div class="conteudo container-alura">';
        the_title('<h2>','</h2>');
        the_content();
        echo '</div>';
        echo '</main>';
    }
}

require_once('footer.php'); //carega o rodapé do site
?>