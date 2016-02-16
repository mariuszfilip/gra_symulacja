$(document).ready(function() {
  var path = location.pathname;
  var home = "/";

  $("a[href='"+[path]+"']").each(function() {
    $(this).addClass("active");
  });
  

});