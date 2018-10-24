(function ($) {
    Drupal.behaviors.libraryExBehavior = {
        attach: function (context, settings) {
            $('.field__items').slick({
                dots: true,
                infinite: true,
                variableWidth: true});
        }
    };
})(jQuery);
