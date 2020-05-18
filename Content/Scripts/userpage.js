$(document).ready(function(){
    $('.folder').click(function(){
        var link = $(this).find('a').attr("href");
        console.log(link)
        location.href = link;
    })
    $('.folder, .file-item').bind("contextmenu", function (event) {
        var path = $(this).find('input').val();
        var name = '';
        if ($(this).hasClass('folder')){
            name = '/'+$(this).find('a:first-child').text();
        }
        name = name.replace(/\s+/g, '');
        $('.custom-menu').data("link",path+''+name);
        $('.custom-menu').data("file", $(this));
        // Avoid the real one
        event.preventDefault();

        // Show contextmenu
        $(".custom-menu").finish().toggle(100).
        
        // In the right position (the mouse)
        css({
            top: event.pageY + "px",
            left: event.pageX + "px"
        });
        
    });


    // If the document is clicked somewhere
    $('.folder, .file-item').bind("mousedown", function (e) {
        // If the clicked element is not the menu
        if (!$(e.target).parents(".custom-menu").length > 0) {

            // Hide it
            $(".custom-menu").hide(100);
        }
    });


    // If the menu element is clicked
    $(".custom-menu li").click(function () {
        $(".custom-menu").hide(100);
    });
    $(document).click(function(){
        $(".custom-menu").hide(100);
    })
})
