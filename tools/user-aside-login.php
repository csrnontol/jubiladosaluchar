<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 10/02/2017
 * Time: 0:07
 */

if (!isset($_SESSION['user-id'])) {
    ?>
    <div class="session-container">
        <div class="header">
            <h3 class="title">Sesión del usuario</h3>
            <p class="title-text">Inicie sesión y acceda a la zona de usuarios para participar en los temas de
                interés.</p>
        </div>
        <div class="content">
            <form id="form-user-login" class="sesion-fields" method="post"
                  action="/jubiladosaluchar/userlogin/login.php?redirect=<?= $_SERVER['PHP_SELF']; ?>">
                <div class="username-field">
                    <input type="text" id="in-user-username" title="Ingresar nombre de usuario o e-mail"
                           placeholder="nombre de usuario o e-mail">
                    <input type="hidden" id="hdn-valid-username" value="undef">
                    <span class="sesion-icons"><i class="fa fa-user fa-fw i-user"></i></span>
                    <span class="error-username input-fields-value-error"></span>
                </div>
                <div class="password-field">
                    <input type="password" id="in-user-password" title="Ingresar contraseña" placeholder="contraseña">
                    <span class="sesion-icons"><i class="fa fa-key fa-fw i-key"></i></span>
                    <span class="error-password input-fields-value-error"></span>
                </div>
                <div class="button-field">
                    <button id="btn-user-login" class="_btnUserLogin" value="undef">
                        <i class="fa fa-sign-in"></i>
                        <span>Iniciar sesión</span>
                    </button>
                    <br>
                    <a href="/jubiladosaluchar/userlogin/forgotpass.php"
                       class="forgotpass _hyperlink">¿Olvidó su contraseña?</a>
                </div>
            </form>
            <div class="register-fields">
                <h4>¿No tiene una cuenta de usuario?</h4>
                <a href="/jubiladosaluchar/userlogin/nuevo-usuario.php" class="_hyperlink">
                    <i class="fa fa-user-plus"></i><br>
                    <span>Registro sencillo y rápido</span>
                </a>
            </div>
        </div>
    </div>
    <?php

} else {
    $user_fullname = $_SESSION['user-name'] . ' ' . $_SESSION['user-surname'];
    $user_username = $_SESSION['user-username'];
    $user_picture = $_SESSION['user-picture'];
    $file_name = basename($_SERVER['PHP_SELF']);
    if ($file_name != 'temas-de-interes.php')
        $temas_txt = '<a href="/jubiladosaluchar/temas-de-interes.php">temas de interés</a>';
    else $temas_txt = 'temas de interés';
    ?>
    <div class="session-container">
        <div class="header">
            <h3 class="title">Sesión del usuario</h3>
        </div>
        <div class="logged-in">
            <div class="picture-names">
                <div class="picture">
                    <div>
                        <img src="/jubiladosaluchar/img/user/<?= $user_picture;?>" alt="Imagen de perfil de <?= $user_username;?>">
                    </div>
                </div>
                <div class="names">
                    <span>Es bueno tenerte aquí,</span>
                    <div>
                        <span><?= $user_fullname;?></span>
                        <span>[<?= $user_username;?>]</span>
                    </div>
                </div>
            </div>
            <div class="toggle-options">
                <div class="trigger" title="Mostrar opciones">
                    <i class="fa fa-chevron-down user-toggle-icon"></i>
                </div>
            </div>
            <div id="div-user-controls">
                <div>
                    <a class="edit-perfil-link _hyperlink" href="javascript:" title="Configurar perfil">
                        <i class="fa fa-cog"></i>&nbsp;<span>Editar perfil</span>
                    </a>
                </div>
                <div>
                    <a class="logout-link _hyperlink" href="/jubiladosaluchar/userlogin/logout.php" title="Salir">
                        <i class="fa fa-sign-out"></i>&nbsp;<span>Cerrar sesión</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="user-suggestions">
            <div class="go-articles">
                <p>No olvide de participar en los <?= $temas_txt;?> dejando sus comentarios.</p>
            </div>
        </div>
    </div>
<?php }