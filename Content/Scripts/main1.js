$(document).ready(function(){
    $('.folder').click(function(){
        var link = $(this).find('a').attr("href");
        console.log(link)
        location.href = link;
    })
    
})