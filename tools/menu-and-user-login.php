<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 24/02/2017
 * Time: 10:33 AM
 */
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
<div id="toggle-menu-and-login">
    <div class="link-txt">Menú de Opciones</div>
    <div class="link-icon">
        <i class="fa fa-navicon"></i>
    </div>
</div>
<div class="div-main-menu">
    <nav class="main-menu">
        <div class="clearfix">
            <div>
                <a href="/jubiladosaluchar" class="<?= $index_active;?>">
                    <h4>Página de inicio</h4>
                    <p>Nosotros los jubilados</p>
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
</div>
<?php
if (!isset($_SESSION['user-id'])) {
    ?>
    <div class="session-inside-menu">
        <div class="div-login-register">
            <ul class="list-login-register">
                <li>
                    <a href="userlogin/login.php?redirect=<?= $_SERVER['PHP_SELF'];?>">
                        <i class="fa fa-sign-in"></i> <span>Iniciar sesión</span>
                    </a>
                </li>
                <li>
                    <a href="userlogin/nuevo-usuario.php">
                        <i class="fa fa-user-plus"></i> <span>Registro rápido</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php

} else {
    $user_fullname = $_SESSION['user-name'] . ' ' . $_SESSION['user-surname'];
    $user_username = $_SESSION['user-username'];
    $user_picture = $_SESSION['user-picture'];
    ?>
    <div class="session-inside-menu">
        <div class="div-user-loggedin">
            <div class="picture-names">
                <img src="/jubiladosaluchar/img/user/<?= $user_picture;?>" alt="Imagen de perfil de <?= $user_username;?>">
                <span><?= $user_fullname;?></span>
            </div>
            <div class="user-controls">
                <div>
                    <a class="edit-perfil-link _hyperlink" href="javascript:">
                        <i class="fa fa-cog"></i>&nbsp;<span>Editar perfil</span>
                    </a>
                </div>
                <div>
                    <a class="logout-link _hyperlink" href="/jubiladosaluchar/userlogin/logout.php">
                        <i class="fa fa-sign-out"></i>&nbsp;<span>Cerrar sesión</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php }