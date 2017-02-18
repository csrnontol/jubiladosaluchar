<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 25/01/2017
 * Time: 12:49 PM
 */
session_start();
?>
<!doctype html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jubilados a Luchar | Página de inicio</title>
    <script type="text/javascript" src="tools/slimbox/ac-run-active-content.js"></script>
    <script type="text/javascript" src="tools/slimbox/jquery-min-slimbox.js"></script>
    <script type="text/javascript" src="tools/slimbox/slimbox.js"></script>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="tools/slimbox/slimbox.css">
</head>
<body class="_bgi">
<?php
include_once 'tools/main-header.php';
echoMainHeader();
?>
<main class="_main-container index-main-section">
    <section class="content-mainsection organizacion-sesion">
        <div class="organizacion">
            <div id="div-organizacion" class="org_secciones">
                <div class="info">
                    <h3>LA ORGANIZACIÓN</h3>
                    <p>
                        Organización sin fines de lucro, conformado por todo jubilado, que desee una pensión digna o sea
                        buscar soluciones a la problemática de los jubilados del Perú.
                    </p>
                </div>
                <img src="img/organizacion.png" >
            </div>
            <div id="div-mision" class="org_secciones">
                <div class="info">
                    <h3>NUESTRA MISIÓN</h3>
                    <p>
                        Es luchar por lograr que los jubilados pongamos nuestros esfuerzos en lograr una pensión Digna,
                        y que través del tiempo aumente conforme aumenta el costo de vida. Lo cual hace que los jubilados
                        estemos organizados.  Y esta es la parte importante de la Misión, la organización de los jubilados
                        del Perú. Ya que la pensión en el Perú, es antihumana, vergonzante.
                    </p>
                </div>
                <img src="img/mision.png" >
            </div>
            <div id="div-vision" class="org_secciones">
                <div class="info">
                    <h3>NUESTRA VISIÓN</h3>
                    <p>
                        Lograr que los jubilados estén siempre organizados, para mantener siempre una pensión digna en el Perú.
                    </p>
                </div>
                <img src="img/vision.png" >
            </div>
        </div>
        <aside class="sesion-usuario">
            <?php
            include_once 'tools/user-aside-login.php';
            ?>
        </aside>
    </section>
    <section class="galeria">
        <div id="galeria-contenedor" >
            <h1>Galería de Fotos</h1>
            <div id="linea"></div>
            <div class="grupo-fotos">
                <div>
                    <a href="img/galeria/01.png" rel="lightbox">
                        <img src="img/galeria/01.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/02.png" rel="lightbox">
                        <img src="img/galeria/02.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/03.png" rel="lightbox">
                        <img src="img/galeria/03.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
            </div>
            <div class="grupo-fotos">
                <div>
                    <a href="img/galeria/04.png" rel="lightbox">
                        <img src="img/galeria/04.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/05.png" rel="lightbox">
                        <img src="img/galeria/05.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/06.png" rel="lightbox">
                        <img src="img/galeria/06.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
            </div>
            <div class="grupo-fotos">
                <div>
                    <a href="img/galeria/07.png" rel="lightbox">
                        <img src="img/galeria/07.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/08.png" rel="lightbox">
                        <img src="img/galeria/08.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/09.png" rel="lightbox">
                        <img src="img/galeria/09.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
            </div>
            <div class="grupo-fotos">
                <div>
                    <a href="img/galeria/10.png" rel="lightbox">
                        <img src="img/galeria/10.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/11.png" rel="lightbox">
                        <img src="img/galeria/11.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/12.png" rel="lightbox">
                        <img src="img/galeria/12.png" />
                    </a>
                    <span>Descripción 1 : Todos reunidos.</span>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include_once 'tools/main-footer.php';
?>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/global-functions.js"></script>
</body>
</html>
