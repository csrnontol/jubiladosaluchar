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
    <title>Jubilados a Luchar &bull; Página de inicio</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="tools/slimbox/slimbox.css">
    <script type="text/javascript" src="tools/slimbox/ac-run-active-content.js"></script>
    <script type="text/javascript" src="tools/slimbox/jquery-min-slimbox.js"></script>
    <script type="text/javascript" src="tools/slimbox/slimbox.js"></script>
</head>
<body class="_bgi">
<?php
include_once 'tools/main-header.php';
echoMainHeader();
include_once 'tools/menu-and-user-login.php';
?>
<main class="_main-container index-main-section">
    <section class="content-mainsection organizacion-sesion">
        <div class="organizacion clear-content-div">
            <div class="index-quote">
                <q>No hay mayor placer que el que nos da un trabajo bien hecho.
                    Es momento de relajarse, porque todo lo que pudiste hacer por los demás lo realizaste con creces.</q>
                &ndash; <em>Anónimo</em>
            </div>
            <div id="div-organizacion" class="org_secciones">
                <div class="info intro">
                    <p>
                        <strong>Jubilados a Luchar.</strong>
                        Organización sin fines de lucro, conformado por todo jubilado que desee una pensión digna y buscar
                        soluciones a la problemática de los jubilados del Perú.
                    </p>
                </div>
            </div>
            <div id="div-mision" class="org_secciones">
                <div class="info">
                    <h3>NUESTRA MISIÓN</h3>
                    <p>
                        Luchamos por lograr que los jubilados pongamos nuestros esfuerzos en lograr una pensión digna,
                        y que través del tiempo aumente conforme aumenta el costo de vida. Lo cual hace que los jubilados
                        estemos organizados. Y esta es la parte importante de la Misión, la organización de los jubilados
                        del Perú.
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
            include_once 'tools/aside-user-login.php';
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
                    <span>Foto del recuerdo. 06-94.</span>
                </div>
                <div>
                    <a href="img/galeria/02.png" rel="lightbox">
                        <img src="img/galeria/02.png" />
                    </a>
                    <span>Izamiento del Pabellón Nacional - C.D. Chicago.</span>
                </div>
                <div>
                    <a href="img/galeria/03.png" rel="lightbox">
                        <img src="img/galeria/03.png" />
                    </a>
                    <span>Ceremonia en el Complejo Deportivo Chicago.</span>
                </div>
                <div>
                    <a href="img/galeria/04.png" rel="lightbox">
                        <img src="img/galeria/04.png" />
                    </a>
                    <span>Reunión de colegas jubilados.</span>
                </div>
                <div>
                    <a href="img/galeria/05.png" rel="lightbox">
                        <img src="img/galeria/05.png" />
                    </a>
                    <span>Reunión de colegas jubilados.</span>
                </div>
                <div>
                    <a href="img/galeria/06.png" rel="lightbox">
                        <img src="img/galeria/06.png" />
                    </a>
                    <span>Foto del recuerdo. Jubilados reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/07.png" rel="lightbox">
                        <img src="img/galeria/07.png" />
                    </a>
                    <span>Reunión de colegas jubilados.</span>
                </div>
                <div>
                    <a href="img/galeria/08.png" rel="lightbox">
                        <img src="img/galeria/08.png" />
                    </a>
                    <span>Foto del recuerdo. Jubilados reunidos.</span>
                </div>
                <div>
                    <a href="img/galeria/09.png" rel="lightbox">
                        <img src="img/galeria/09.png" />
                    </a>
                    <span>Reunión del Adulto Mayor. P.S. San Martín.</span>
                </div>
                <div>
                    <a href="img/galeria/10.png" rel="lightbox">
                        <img src="img/galeria/10.png" />
                    </a>
                    <span>Reunión del Adulto Mayor. P.S. San Martín.</span>
                </div>
                <div>
                    <a href="img/galeria/11.png" rel="lightbox">
                        <img src="img/galeria/11.png" />
                    </a>
                    <span>Reunión del Adulto Mayor. P.S. San Martín.</span>
                </div>
                <div>
                    <a href="img/galeria/12.png" rel="lightbox">
                        <img src="img/galeria/12.png" />
                    </a>
                    <span>Reunión del Adulto Mayor. P.S. San Martín.</span>
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
<script>
    var wdwWidth = $(window).width();
    if (wdwWidth < 600) {
        var imgs = $(".grupo-fotos").find("a");
        imgs.attr({'rel': '', 'onclick': 'return false;'});
    }

    $(window).resize(function () {
        var wdwWidth = $(window).width();
        var imgs = $(".grupo-fotos").find("a");
        if (wdwWidth < 600) {
            imgs.attr({'rel': '', 'onclick': 'return false;'});
        } else {
            imgs.attr({'rel': 'lightbox', 'onclick': ''});
        }
    });
</script>
</body>
</html>
