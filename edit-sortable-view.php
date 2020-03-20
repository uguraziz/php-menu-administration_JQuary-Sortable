<div class="content">
    <div class="box- menu-container">
        <h2>Menü Düzenle(<?=$id?>)</h2>
        <form action="" method="post">
            <div style="margin: 2px; width: 400px">
                <input type="text" name = "baslik" value="<?=post("baslik") ? post("baslik") : $row["menu_title"]?>" placeholder="Başlık giriniz">
            </div>
            <ul class="menu">

                <?php foreach ($menuData as $key => $menu): ?>
                    <li>
                        <div class="handle"></div>
                        <div class="menu-item">
                            <a href="#" class="delete-menu">
                                <i class="fa fa-times"></i>
                            </a>
                            <input type="text" name="menu_title[]" value="<?=$menu["title"]?>" placeholder="Menü Adı">
                            <input type="text" name="menu_url[]" value="<?=$menu["url"]?>" placeholder="Menü Linki">
                        </div>
                        <div class="sub-menu">
                            <ul class="menuSub">
                                <?php if(isset($menu["submenu"])): ?>
                                    <?php foreach($menu["submenu"] as $submenu): ?>
                                        <li>
                                            <div class="handle"></div>
                                            <div class="menu-item">
                                                <a href="#" class="delete-menu">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <input type="text" name="sub_title_<?=$key?>[]" value="<?=$submenu["title"]?>" placeholder="Menü Adı">
                                                <input type="text" name="sub_url_<?=$key?>[]" value="<?=$submenu["url"]?>" placeholder="Menü Linki">
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif;?>
                            </ul>
                        </div>
                        <a href="#" class="add-submenu btn">Alt Menü Ekle</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="menu-btn">
                <a href="#" class="add-menu btn">Menü Ekle</a>
                <button type="submit" value="1" name="submit">Güncelle</button>
            </div>
        </form>
    </div>
</div>

<style>
    .menu-container .handle{
        width: 15px;
        height: 15px;
        background: #ccc;
        position: absolute;
        top: 15px;
        right: -15px;
        cursor: move;

    }
    .menu-container form>ul li{
        background: #f5f5f5;
        overflow: inherit;
    }
    .menu-container form>ul li.ui-sortable-helper{
        box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
    }

    .ui-sortable-placeholder{
        background: #f7ffd8 !important;
        visibility: visible !important;
    }
</style>

<script>
$(function(){

    $(document.body).on("click", ".delete-menu", function (e) {
        if($(".menu li").length == 1){
            alert("1 adet İçerik kalmak zorunda");
        }else {
            $(this).closest("li").remove();
            e.preventDefault();
        }
    });

    $(document.body).on("click", ".add-submenu", function (e) {
        let index = $(this).closest("li").index();
        $(this).prev(".sub-menu").find("ul").append('<li>\n' +
'                                <div class="handle"></div><div class="menu-item">\n' +
'                                    <a href="#" class="delete-menu">\n' +
'                                        <i class="fa fa-times"></i>\n' +
'                                    </a>\n' +
'                                    <input type="text" name="sub_title_'+index+'[]" placeholder="Menü Adı">\n' +
'                                    <input type="text" name="sub_url_'+index+'[]" placeholder="Menü Linki">\n' +
'                                </div>\n' +
'                            </li>');
        e.preventDefault();
    });

    $(".add-menu").on("click", function(e){
        $(".menu").append('<li>\n' +
'                    <div class="handle"></div><div class="menu-item">\n' +
'                        <a href="#" class="delete-menu">\n' +
'                            <i class="fa fa-times"></i>\n' +
'                        </a>\n' +
'                        <input type="text" name="menu_title[]" placeholder="Menü Adı">\n' +
'                        <input type="text" name="menu_url[]" placeholder="Menü Linki">\n' +
'                    </div>\n' +
'                    <div class="sub-menu">\n' +
'                        <ul class="menuSub">\n' +
'                            <!-- <li>\n' +
'                                <div class="menu-item">\n' +
'                                    <a href="#" class="delete-menu">\n' +
'                                        <i class="fa fa-times"></i>\n' +
'                                    </a>\n' +
'                                    <input type="text" placeholder="Menü Adı">\n' +
'                                    <input type="text" placeholder="Menü Linki">\n' +
'                                </div>\n' +
'                            </li> -->\n' +
'                        </ul>\n' +
'                    </div> \n' +
'                    <a href="#" class="add-submenu btn">Alt Menü Ekle</a>\n' +
'                </li>');
        e.preventDefault();
    });


});
</script>
 