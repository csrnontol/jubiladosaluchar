/**
 * Created by CYNR on 15/02/2017.
 */
$(document).ready(function () {
    /*
     * load default article comments
     */
    var curArticleKey = document.getElementsByClassName("article-container")[0].getAttribute('data-key');
    var commentsMainContainer = document.getElementById("div-comments-list");
    $(commentsMainContainer).load('tools/comments/loadArticleComments.php', {key : curArticleKey}, function () {
        var onsessionFlag = $(".comment-and-replies .rate-reply");
        if (onsessionFlag.data('onsession') == false) {
            var curUrl = 'window.location.href=\'userlogin/login.php?redirect=';
            curUrl +=  window.location.pathname; // window.location.hostname + window.location.pathname
            curUrl +=  '&post='+curArticleKey+'\';return false;';
            var replyCommentLinks = $(".reply-comment-links");
            var rateCommentLinks = onsessionFlag.find("[class*='fa-thumbs']");
            replyCommentLinks.attr('onclick', curUrl);
            $(rateCommentLinks).attr('onclick', curUrl);
        }
    });


    /*
     * write new article comment
     */
    var btnSubmitComment = document.getElementById("btn-submit-comment");
    var txtCommentContent = document.getElementById("txt-new-comment");
    $(txtCommentContent).on('input', function () {
        if (this.value.trim().length > 0) {
            $(btnSubmitComment).removeClass("_btnDisabled");
        } else {
            $(btnSubmitComment).addClass("_btnDisabled");
        }
    });
    $(btnSubmitComment).on('click', function () {
        if ($(this).hasClass("_btnDisabled")) {
            return false;
        }
        $(this).addClass("_btnDisabled");
        var articleKey = $(this).closest(".article-container").data('key');
        var commentContent = txtCommentContent.value;
        $.ajax({
            url: 'tools/comments/writeArticleComment.php',
            type: 'POST',
            data: JSON.stringify({
                step: 'record',
                articleKey: articleKey,
                commentContent: commentContent
            }),
            contentType: 'application/json',
            success: function(data) {
                commentsMainContainer = document.getElementById("div-comments-list");
                var createdDiv = document.createElement("div");
                createdDiv.innerHTML = data;
                commentsMainContainer.insertBefore(createdDiv, commentsMainContainer.firstChild);
                txtCommentContent.value = '';
            }
        });
    });


    /*
     * reply to article comment
     */
    $(commentsMainContainer).on('click', '.reply-comment-links', function () {
        var commentFormContainer = $(this).closest(".comment-first").find(".comment-form").get(0);
        if (commentFormContainer.innerHTML != '') {
            return false;
        }
        $.ajax({
            url: 'tools/comments/writeArticleComment.php',
            type: 'POST',
            data: JSON.stringify({
                step: 'load-form'
            }),
            contentType: 'application/json',
            success: function(data) {
                var commentFormContainers = $(".comment-and-replies").find(".comment-form");
                commentFormContainers.html('');
                commentFormContainer.innerHTML = data;
                commentFormContainers.find("#txt-new-comment").focus();
            }
        });
    })
    .on('click', '.btn-cancel-reply', function () {
        var commentFormContainer = $(this).closest(".comment-first").find(".comment-form");
        commentFormContainer.html('');
    })
    .on('input', '#txt-new-comment', function () {
        var btnSubmitCommentReply = $(this).closest(".text-and-button").find("#btn-submit-comment");
        if (this.value.trim().length > 0) {
            $(btnSubmitCommentReply).removeClass("_btnDisabled");
        } else {
            $(btnSubmitCommentReply).addClass("_btnDisabled");
        }
    })
    .on('click', '#btn-submit-comment', function () {
        if ($(this).hasClass("_btnDisabled")) {
            return false;
        }
        $(this).addClass("_btnDisabled");
        var replyHasReference = 'false';
        var parentCommentKey = $(this).closest(".main-comment-div").data('key');
        var commentRepliesContainer = $(this).closest(".div-comment-replies");
        var referenceCommentKey = $(this).closest(".comment-first").data('key');
        if (commentRepliesContainer.length > 0 && referenceCommentKey != null) {
            replyHasReference = 'true';
        }
        var commentReplyContent = $(this).closest(".text-and-button").find("#txt-new-comment").val();
        var $that = $(this);
        $.ajax({
            url: 'tools/comments/writeArticleComment.php',
            type: 'POST',
            data: JSON.stringify({
                step: 'record',
                articleKey: curArticleKey,
                commentContent: commentReplyContent,
                referenceFlag: replyHasReference,
                parentComment: parentCommentKey,
                referenceComment: referenceCommentKey
            }),
            contentType: 'application/json',
            success: function(data) {
                var commentRepliesContainer = $that.closest(".comment-and-replies").find(".div-comment-replies");
                commentRepliesContainer.append(data);
                var commentFormContainer = $that.closest(".comment-and-replies").find(".comment-form");
                commentFormContainer.html('');
            }
        });
    });
});



/**
 * @url: http://stackoverflow.com/questions/3387427/remove-element-by-id
 */
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
};
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for (var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
};