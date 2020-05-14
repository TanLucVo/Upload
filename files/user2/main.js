$(document).ready(function () {

    var num = $(".descrip").offset().top;
    $(window).bind('scroll', function () {
        var width = window.matchMedia("(max-width: 650px)").matches;
        if(!width){
            if ($(window).scrollTop() > num) {
                $('.descrip').addClass('sticky');
            }
            else {
                $('.descrip').removeClass('sticky');
            }
        }else{
            $('.descrip').removeClass('sticky');
        }

    });
    var indexPage = 1;
    var maxPage = 2;
    $.get("https://sinhvien.phongdaotao.com/getcourses.php",
        function (data) {
            $(".button").append("<button class='pre'>Pre</button>");
            maxPage = Math.ceil(data.data.length/4);
            $(".num-entries").text("Showing 1 to 4 of "+data.data.length+" entries");
            let count = 1;
            data.data.forEach(data => {
                if (count === 1){
                    $(".button").append("<button class ='page active'>1</button>");
                }
                else if(count%4 == 1){
                    $(".button").append("<button class ='page'>" + Math.ceil(count/4)+"</button>");
                }
                var tr2 = $("<tr class='info'></tr>")
                var td3;
                var tr = $("<tr class='collapsible' '></tr>");
                var td1 = "<td>"+data.id+"</td>"
                var td2 = "<td>" + data.name + "</td>"
                tr.append(td1);
                tr.append(td2);
                td3 = $("<td class='content-collapse' colspan='2'></td>")

                $("table").append(tr) ;
                var url = "https://sinhvien.phongdaotao.com/course.php?id=" + data.id
                $.get(url, data,
                    function (data) {
                        var p1 = "Description: " + data.description;
                        var p2 = "Textbook : " + data.textbook;
                        var br = $("<br><br>");
                        td3.append(p1,br,p2);
                    }
                );
                tr2.append(td3);
                $("table").append(tr2);
                count++;
            });
            $(".button").append("<button class='next'>Next</button>");
            $(".pre").prop("disabled",true);

            $(".collapsible").hide();
            for(let i=1;i<=4;i++){
                $(".collapsible:nth-child(" + 2 * i + ")").show();
            }
            $(".collapsible").click(function () {

                $(this).next().children().toggle(200);
            });

            $("button").click(function () {

                $(".content-collapse").hide();
                var name = $(this).text();
                if (parseInt(name)) {
                    indexPage = parseInt(name);
                    $(".page").removeClass("active");
                    $(this).addClass("active");
                }
                if (name == "Next") {
                    if (indexPage < maxPage) {
                        indexPage += 1;
                        $page = $(".active").next();
                        $(".page").removeClass("active");
                        $page.addClass("active");
                    }

                }
                else if (name == "Pre") {
                    if (indexPage > 1) {
                        indexPage -= 1;
                        $page = $(".active").prev();
                        $(".page").removeClass("active");
                        $page.addClass("active");
                    }

                }
                $(".collapsible").hide();
                for (let i = 4 * indexPage - 3; i <= 4 * indexPage; i++) {

                    $(".collapsible:nth-child(" + 2 * i + ")").show();
                }
                $(".num-entries").text("Showing " + ((indexPage-1) * 4+1) + " to " + ((indexPage-1) * 4+4) +" of " + data.data.length+" entries");
                if(indexPage===1){
                    $(".pre").prop("disabled", true);
                }else{
                    $(".pre").prop("disabled", false);
                }
                if(indexPage === maxPage){
                    $(".next").prop("disabled", true);
                }else{
                    $(".next").prop("disabled", false);
                }
            }) 
        }
    );
    
});