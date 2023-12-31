<!-- Cabeçalho padrão -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/normalize.css'; ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/bootstrap.css'; ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/header.css'; ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/footer.css'; ?>">
    <!-- Folha de estilo específica com base na página visitada -->
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/' . $estiloPagina; ?>">
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container-alura">
        <?php
        // Exibe a logo personalisada
        the_custom_logo(); 
        ?>
        <nav>
            <?php 
            // Exibe o menu de navegação
            wp_nav_menu(array(
                'menu' => 'menu-navegacao',
                'menu_id' => 'menu-principal'
            ));
            ?>
        </nav>
    </div>
</header>
