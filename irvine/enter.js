(function($) {
  $.fn.enterAsTab = function(options) {
    var settings = $.extend({
      'allowSubmit': false
    }, options);
    $(this).find('input, select, textarea, button').live("keydown", {
      localSettings: settings
    }, function(event) {
      if (settings.allowSubmit) {
        var type = $(this).attr("type");
        if (type == "submit") {
          return true;
        }
      }
      if (event.keyCode == 13) {
        var inputs = $(this).parents("form").eq(0).find(":input:visible:not(:disabled):not([readonly])");
        var idx = inputs.index(this);
        if (idx == inputs.length - 1) {
          idx = -1;
        } else {
          inputs[idx + 1].focus(); // handles submit buttons
        }
        try {
          inputs[idx + 1].select();
        } catch (err) {

        }
        return false;
      }
    });
    return this;
  };
})(jQuery);

$("#form").enterAsTab({
  'allowSubmit': true
});
