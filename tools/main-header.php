<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 28/01/2017
 * Time: 12:40
 */
function echoFormLogo() { ?>
    <noscript class="no-script">
        Al parecer JavaScript está desactivado en el navegador.<br>
        La funcionalidad completa de esta página no estará disponible mientras JavaScript esté desactivado.<br>
        Se sugiere <a href="http://enable-javascript.com/es/" target="_blank">activar JavaScript</a> y volver a cargar esta página.
    </noscript>
    <div class="form--logo-slogan">
        <div>
            <a href="/jubiladosaluchar">
                <img src="/jubiladosaluchar/img/logo4.png" alt="Logo de la Organización">
                <h2 class="slogan">jubiladosaluchar.pe</h2>
            </a>
        </div>
    </div>
<?php }


/*
 * Function to show main header
 */
function echoMainHeader() {
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
                    <img src="/jubiladosaluchar/img/logo4.png" alt="Logo de la Organización">
                    <h1 class="slogan">Jubilados a Luchar</h1>
                    <h3>... por una pensión digna ...</h3>
                </a>
            </div>
        </div>
    </header>
<?php }