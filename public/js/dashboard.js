$(document).ready(function () {
   $("#menuDock").click(function (e) {
       e.preventDefault();
       $("#wrapper").toggleClass('leftMenuMinimize');
       $("#menuDock span.glyphicon").toggleClass("glyphicon-menu-left glyphicon-menu-right");
   });
});