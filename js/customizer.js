(function($) {
    wp.customize('primary_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--primary-color', to);
        });
    });
})(jQuery);