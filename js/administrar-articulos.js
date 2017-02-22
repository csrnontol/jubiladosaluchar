/**
 * Created by CYNR on 28/01/2017.
 */
var mastercnDialogContainer = document.querySelector(".mastercn-change-item-status--container");
var mastercnDialogOverlay = document.querySelector(".mastercn-dialog-overlay");
$(document).ready(function () {
    var alumnoForm = document.getElementById("articulo-form");
    $(alumnoForm).on('submit', function () {
        return validateNuevoArticulo();
    });


    /*
     * change article status (active/inactive)
     */
    $(document).on('click', '.article-status-links', function () {
        var parentKey = $(this).closest(".article-row").data('key');
        $(mastercnDialogContainer).load('articulos/changeArticleStatus.php', {step: 'load', key: parentKey}, function () {
            $(mastercnDialogContainer).show();
            $(mastercnDialogOverlay).fadeIn('fast');
        });
    });
    $(mastercnDialogContainer).on('click', '.change-article-status', function () {
        var parentKey = $(this).closest(".mastercn-change-item-status--dialog").data('key');
        var domElement = $(".article-row[data-key='"+parentKey+"']").find(".article-status-links");
        $(domElement).load('articulos/changeArticleStatus.php', {step: 'record', key: parentKey}, function () {
            $(mastercnDialogContainer).hide();
            $(mastercnDialogOverlay).fadeOut('fast');
        });
    })
    .on('click', '.close-dialog', function () {
        $(mastercnDialogContainer).fadeOut('fast');
        $(mastercnDialogOverlay).fadeOut('fast');
    });
});


/* function to validate nuevo-articulo */
function validateNuevoArticulo() {
    /*elements for focus*/
    var inTitulo = document.getElementById("article-title");
    var txtContenido = document.getElementById("article-content");
    var txtFuente = document.getElementById("article-source");

    /*elements for test*/
    var tituloValue = inTitulo.value.trim();
    var contenidoValue = txtContenido.value.trim();
    var fuenteValue = txtFuente.value.trim();

    /*elements for errors*/
    var errorTitulo = document.getElementById("title-error");
    var errorContenido = document.getElementById("content-error");
    var errorFuente = document.getElementById("source-error");
    var generalError = document.getElementsByClassName("general-errors")[0];

    errorTitulo.innerHTML = '';
    errorContenido.innerHTML = '';
    errorFuente.innerHTML = '';
    generalError.innerHTML = '';

    var cont = 0, errors = [];
    errors[0] = '<span>El campo no debe quedar vacío.</span>';
    errors[1] = '<span>Ingresar un valor más específico.</span>';
    errors[2] = '<span>El contenido debe tener más texto.</span>';

    /*validate titulo*/
    if (tituloValue === '') {
        cont++;
        errorTitulo.innerHTML = errors[0];
        if (cont == 1) inTitulo.focus();
    } else if (tituloValue.length < 15) {
        cont++;
        errorTitulo.innerHTML = errors[1];
        if (cont == 1) inTitulo.focus();
    }

    /*validate contenido*/
    if (contenidoValue === '') {
        cont++;
        errorContenido.innerHTML = errors[0];
        if (cont == 1) txtContenido.focus();
    } else if (contenidoValue.length < 700) {
        cont++;
        errorContenido.innerHTML = errors[2];
        if (cont == 1) txtContenido.focus();
    }

    /*validate titulo*/
    if (fuenteValue === '') {
        cont++;
        errorFuente.innerHTML = errors[0];
        if (cont == 1) txtFuente.focus();
    } else if (fuenteValue.length < 15) {
        cont++;
        errorFuente.innerHTML = errors[1];
        if (cont == 1) txtFuente.focus();
    }

    /*results*/
    if (cont > 0) {
        generalError.innerHTML = '<span>Hay '+cont+' campo(s) por completar.</span>';
        return false;
    }
}