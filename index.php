<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 25/01/2017
 * Time: 12:49 PM
 */
?>
<!doctype html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/jssor-slider.css">
</head>
<body>
<header class="main-container main-header">
    <div class="main-logo">
        <div>
            <a href="">
                <img src="img/logo.png" alt="Logo de la Organización">
                <h1 class="slogan">Jubilados a Luchar</h1>
            </a>
        </div>
    </div>
    <nav class="main-menu">
        <div class="clearfix">
            <div>
                <a href="" class="active">
                    <h4>¿Quiénes somos?</h4>
                    <p>Situación de los jubilados</p>
                </a>
            </div>
            <div>
                <a href="">
                    <h4>Aportes y opiniones</h4>
                    <p>La jubilación en el país</p>
                </a>
            </div>
            <div>
                <a href="">
                    <h4>Contáctenos</h4>
                    <p>Ubicación y contacto</p>
                </a>
            </div>
        </div>
    </nav>
</header>
<main class="main-container index-main-section">
    <section class="organizacion-sesion">
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
        <div class="sesion-usuario">
                <form action="" method="post" name="form-iniciar-session" id="form-iniciar-session" onsubmit="return validaSesionCliente();">
                    <input type="text" name="sesion-usuario" id="sesion-usuario" placeholder="Usuario">
                    <br><br>
                    <input type="password" name="sesion-clave" id="sesion-clave" placeholder="Contraseña">
                    <br><br>
                    <input type="submit" name="submit-sesion" value="Ingresar">
                </form>
                <div class="registrarse"><a href="registrarse.php">Registrarse</a></div>
                <div id="resultados-de-sesion"></div>
         </div>
    </section>
    <section class="galeria">
        <!-- .:: imagenes deslizables ::. -->
        <div id="jssor_1" style="float: center; position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 500px; overflow: hidden; visibility: hidden;">
            <div id="aaa" data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 500px; overflow: hidden;">
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/01.png" />
                   <!-- <div data-u="caption" data-t="4" style="position: absolute; top: 30px; left: 30px; width: 350px; height: 30px; background-color: rgba(235,81,0,0.5); font-size: 20px; color: #ffffff; line-height: 30px; text-align: center;">Responsabilidad</div>-->
                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/02.png" />
                    <!--<div data-u="caption" data-t="6" style="position: absolute; top: 30px; left: 30px; width: 350px; height: 30px; background-color: rgba(235,81,0,0.5); font-size: 20px; color: #ffffff; line-height: 30px; text-align: center;">Compromiso</div>-->
                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/03.png" />
                    <!--<div data-u="caption" data-t="2" style="position: absolute; top: 30px; left: -380px; width: 350px; height: 30px; background-color: rgba(235,81,0,0.5); font-size: 20px; color: #ffffff; line-height: 30px; text-align: center;">Puntualidad</div>-->
                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/04.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/05.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/06.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/07.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/08.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/09.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/10.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/11.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/12.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/13.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/14.png" />

                </div>
                <div style="display: none;">
                    <img data-u="image" src="img/galeria/15.png" />

                </div>-->
            </div>

            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb01" style="bottom:16px;right:16px;">
                <div data-u="prototype" style="width:12px;height:12px;"></div>
            </div>
            <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
        </div>
        <!-- .:: fin: imagenes deslizables ::. -->

    </section>
</main>
<br>
<!--<footer class="main-footer">

    <div id="contenedor-pie-de-pagina" class="border-box">

        <div id="copyright">&copy; 2017  - Todos los derechos reservados</div>
    </div>
</footer>-->
<footer>
    <div class="centered clearfix">
        <div class="footer-logo">
            <img class="logo" src="img/logo.png">
            <div class="social">
                <a href="https://www.facebook.com/jubilados.aluchar" class="facebook">
                    <svg viewBox="0 0 33 33"><g><path d="M 17.996,32L 12,32 L 12,16 l-4,0 l0-5.514 l 4-0.002l-0.006-3.248C 11.993,2.737, 13.213,0, 18.512,0l 4.412,0 l0,5.515 l-2.757,0 c-2.063,0-2.163,0.77-2.163,2.209l-0.008,2.76l 4.959,0 l-0.585,5.514L 18,16L 17.996,32z"></path></g></svg>
                </a>
                <!--<a href="https://twitter.com/" class="twitter">
                    <svg viewBox="0 0 33 33"><g><path d="M 32,6.076c-1.177,0.522-2.443,0.875-3.771,1.034c 1.355-0.813, 2.396-2.099, 2.887-3.632 c-1.269,0.752-2.674,1.299-4.169,1.593c-1.198-1.276-2.904-2.073-4.792-2.073c-3.626,0-6.565,2.939-6.565,6.565 c0,0.515, 0.058,1.016, 0.17,1.496c-5.456-0.274-10.294-2.888-13.532-6.86c-0.565,0.97-0.889,2.097-0.889,3.301 c0,2.278, 1.159,4.287, 2.921,5.465c-1.076-0.034-2.088-0.329-2.974-0.821c-0.001,0.027-0.001,0.055-0.001,0.083 c0,3.181, 2.263,5.834, 5.266,6.438c-0.551,0.15-1.131,0.23-1.73,0.23c-0.423,0-0.834-0.041-1.235-0.118 c 0.836,2.608, 3.26,4.506, 6.133,4.559c-2.247,1.761-5.078,2.81-8.154,2.81c-0.53,0-1.052-0.031-1.566-0.092 c 2.905,1.863, 6.356,2.95, 10.064,2.95c 12.076,0, 18.679-10.004, 18.679-18.68c0-0.285-0.006-0.568-0.019-0.849 C 30.007,8.548, 31.12,7.392, 32,6.076z"></path></g></svg>
                </a>
                <a href="https://www.linkedin.com/" class="linkedin">
                    <svg viewBox="0 0 512 512"><g><path d="M186.4 142.4c0 19-15.3 34.5-34.2 34.5 -18.9 0-34.2-15.4-34.2-34.5 0-19 15.3-34.5 34.2-34.5C171.1 107.9 186.4 123.4 186.4 142.4zM181.4 201.3h-57.8V388.1h57.8V201.3zM273.8 201.3h-55.4V388.1h55.4c0 0 0-69.3 0-98 0-26.3 12.1-41.9 35.2-41.9 21.3 0 31.5 15 31.5 41.9 0 26.9 0 98 0 98h57.5c0 0 0-68.2 0-118.3 0-50-28.3-74.2-68-74.2 -39.6 0-56.3 30.9-56.3 30.9v-25.2H273.8z"></path></g></svg>
                </a>-->
            </div>
        </div>
        <div class="footer-contact">
            <h3><a href="">Contacto Oficial</a></h3>
            <p><a href="mailto:">E-mail: jubiladosaluchar@gmail.com</a></p>
            <p><a href="Tlf:">Tlf: 044-607456</a></p>
            <p><a href="Cel:">Cel: 948856963</a></p>
            <p><a href="">Direccion: José Gálvez 707 - Chicago - Trujillo - Perú</a></p>
        </div>
        <div class="footer-navigation">
            <div class="footer-links-holder">
                <h3><a href="">Contacto Adicional</a></h3>
                <ul class="footer-links">
                    <li><a href="">Francisco Domingo Córdova Armas</a></li>
                    <li><a href="">cormas@gmail.com</a></li>
                    <li><a href="">cormas@hotmail.com</a></li>

                </ul>
            </div>
            <!--<div class="footer-links-holder">
                <h3><a href="">Section 2</a></h3>
                <ul class="footer-links">
                    <li><a href="">Page Title 1</a></li>
                    <li><a href="">Page Title 2</a></li>
                    <li><a href="">Page Title 3</a></li>
                    <li><a href="">Page Title 4</a></li>
                </ul>
            </div>
            <div class="footer-links-holder">
                <h3><a href="">Section 3</a></h3>
                <ul class="footer-links">
                    <li><a href="">Page Title 1</a></li>
                    <li><a href="">Page Title 2</a></li>
                    <li><a href="">Page Title 3</a></li>
                    <li><a href="">Page Title 4</a></li>
                </ul>
            </div>-->
        </div>
    </div>
    <div class="bottom-bar">
        Todos los derechos reservados © 2017
    </div>
</footer>
</body>
<script type="text/javascript" src="functions/jquery-1.11.1.js"></script>
<script type="text/javascript" src="functions/jssor.slider.mini.js"></script>
<script type="text/javascript" src="functions/jssor-slider.js"></script>
</html>
