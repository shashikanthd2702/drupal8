//alert();

(function ($, Drupal, drupalSettings) {

Drupal.behaviors.LotusBehavior = {
  attach: function (context, settings) {
    // can access setting from 'drupalSettings';
    var lotusHeight = drupalSettings.lotus.lotusJS.lotus_height;
	console.log(lotusHeight);
     $('lotusElement').css('height', lotusHeight);
  }
};
})(jQuery, Drupal, drupalSettings);