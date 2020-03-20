$(".menu").sortable({
        handle: '.handle',
        update: function () {
        $(".menu > li").each(function () {
            let subMenu = $(this).find("li");
            if(subMenu.length){
                let index = $(this).index();
                subMenu.each(function () {
                    $("input:eq(0)", this).attr("name", "sub_title_"+index+"[]");
                    $("input:eq(1)", this).attr("name", "sub_url_"+index+"[]");
                })
            }
        })
       }
    });
    $(".menuSub").sortable({
        handle: '.handle',
        update: function () {
            $(".menu > li").each(function () {
                let subMenu = $(this).find("li");
                if(subMenu.length){
                    let index = $(this).index();
                    subMenu.each(function () {
                        $("input:eq(0)", this).attr("name", "sub_title_"+index+"[]");
                        $("input:eq(1)", this).attr("name", "sub_url_"+index+"[]");
                    })
                }
            })
        }
    });