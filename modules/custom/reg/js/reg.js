(function($, Drupal)
{
    Drupal.behaviors.reg = {
        attach:function()
        {
            $('.register').each(function(i){
                $(this).click(function(){
                  $('.form-registration').addClass('activate');
                  console.log('add class');
                });
            });
            $('.login').each(function(i){
                $(this).click(function(){
                  $('.form-registration').removeClass('activate');
                  console.log('remove class');
                });
            });
        }
    }

}(jQuery, Drupal));
