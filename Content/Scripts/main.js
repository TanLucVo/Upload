$(document).ready(function(){
    $('.rename').click(function(){
        var link = $(this).parent().prev().prev().prev().prev().children();
        var oldName = link.text();
        $('#newname').val(oldName);
        var oldLink = link.attr("href");
        // link.attr("href", oldName);
        $('#save').click(function(){
            var newName =$('#newname').val();
            link.attr("href",oldLink.replace(oldName,newName) );
            link.attr("download", newName);
        })
    })
})