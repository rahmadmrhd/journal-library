import $ from "jquery";
(function () {
  var orig = $.fn.css;
  $.fn.css = function () {
    var result = orig.apply(this, arguments);
    $(this).trigger('stylechanged');
    return result;
  }
})();
$('input').on('stylechanged', function (e, visible) {
  console.log(e, visible);
});