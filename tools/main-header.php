<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 28/01/2017
 * Time: 12:40
 */
function echoFormLogo() { ?>
    <div class="form--logo-slogan">
        <div>
            <a href="/jubiladosaluchar">
                <img src="../img/logo.png" alt="Logo de la Organización">
                <h2 class="slogan">jubiladosaluchar.com</h2>
            </a>
        </div>
    </div>
<?php }


/*
 * Function to show main header
 */
function echoMainHeader() {
    $index_active = $article_active = $contact_active = '';
    $file_name = basename($_SERVER['PHP_SELF']); // basename($_SERVER['REQUEST_URI']);
    if ($file_name == 'index.php') {
        $index_active = 'active';
    } elseif ($file_name == 'temas-de-interes.php') {
        $article_active = 'active';
    } elseif ($file_name == 'contacto.php') {
        $contact_active = 'active';
    }
    ?>
    <noscript class="no-script">
        Al parecer JavaScript está desactivado en el navegador.<br>
        La funcionalidad completa de esta página no estará disponible mientras JavaScript esté desactivado.<br>
        Se sugiere <a href="http://enable-javascript.com/es/" target="_blank">activar JavaScript</a> y volver a cargar esta página.
    </noscript>
    <header class="main-container main-header">
        <div class="main-logo">
            <div>
                <a href="/jubiladosaluchar">
                    <img src="/jubiladosaluchar/img/logo.png" alt="Logo de la Organización">
                    <h1 class="slogan">Jubilados a Luchar</h1>
                    <h3>... por una pensión digna ...</h3>
                </a>
            </div>
        </div>
        <nav class="main-menu">
            <div class="clearfix">
                <div>
                    <a href="/jubiladosaluchar" class="<?= $index_active;?>">
                        <h4>¿Quiénes somos?</h4>
                        <p>Situación de los jubilados</p>
                    </a>
                </div>
                <div>
                    <a href="/jubiladosaluchar/temas-de-interes.php" class="<?= $article_active;?>">
                        <h4>Temas de interés</h4>
                        <p>La jubilación en el país</p>
                    </a>
                </div>
                <div>
                    <a href="/jubiladosaluchar/contacto.php" class="<?= $contact_active;?>">
                        <h4>Contáctenos</h4>
                        <p>Ubicación y contacto</p>
                    </a>
                </div>
            </div>
        </nav>
    </header>
<?php }