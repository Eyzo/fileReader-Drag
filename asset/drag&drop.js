$(document).ready(function () {

    $(".draggable").draggable({
        containment:".container",
        revert: 'invalid',
        cursor: "move"
    });

    $(".article-container").droppable({
        accept: ".draggable",
        drop: function (event,ui) {
            var current = ui.draggable;
            var articleContainer = $('.article-container');

            current.fadeOut();
            articleContainer.append('<div class="article draggable">'+ current.html() +'</div>');

            $(".draggable").draggable({
                containment:".container",
                revert: 'invalid',
                cursor: "move"
            });
        }
    });

    $(".cart-container").droppable({
        accept: '.draggable',
        drop: function (event,ui) {
            var current = ui.draggable;
            var cartContainer = $(".cart-container");

            current.fadeOut();
            cartContainer.append('<div class="cart-content draggable">'+ current.html() +'</div>');

            $('.draggable').draggable({
                containment: ".container",
                revert: 'invalid',
                cursor: "move"
            });
        }
    });

    $(".cart-content").selectable();

});