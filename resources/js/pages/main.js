$(document).ready(function() {
    var burger = $('.small-menu');

    burger.each(function(index){
    var $this = $(this);

    $this.on('click', function(e){
        e.preventDefault();
        $(this).toggleClass('active-' + (index+1));
    })
    });
});
