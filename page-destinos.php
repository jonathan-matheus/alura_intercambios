<?php
$estiloPagina = 'destinos.css';
require_once('header.php');

echo '<form action="#" class="container-alura formulario-pesquisa-paises">';
echo '<h2>Conheça nosso destinos</h2>';
echo '<select name="paises" id="paises">';
echo '<option value="">--Selecione--</option>';
$paises = get_terms(array('taxonomy' => 'paises'));
foreach($paises as $pais){
    echo '<option value="' . $pais->slug . '">' . $pais->name . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Pesquisar">';
echo '</form>';

$args = array('post_type' => 'destinos');
$query = new WP_Query($args);
if($query->have_posts()){
    echo '<main class="page-destinos">';
    echo '<ul class="lista-destinos container-alura">';
    while($query->have_posts()){
        $query->the_post();
        echo '<li class="col-md-3 destinos">';
        the_post_thumbnail();
        the_title('<p class="titulo-destino">', '</p>');
        the_content();
        echo '</li>';
    }
    echo '</main>';
    echo '</ul>';
}

require_once('footer.php');
?>