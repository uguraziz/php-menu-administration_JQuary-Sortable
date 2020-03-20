<?php

$id = get("id");
if(!$id){
    header("Location:".admin_url("menu"));
    exit;
}

$query = $db->prepare("SELECT * FROM menu WHERE menu_id = :menuid ");
$query->execute([
    "menuid" => $id
]);
$row = $query->fetch(PDO::FETCH_ASSOC);

if(!$row){
    header("Location:".admin_url("menu"));
    exit;
}

if(post("submit")){
    $ititle = post("baslik");
    $menu_title = post("menu_title");
    $menu_url = post("menu_url");
    if(!$ititle){
        $error = "Başlık giriniz";
    }elseif(!$menu_title){
        $error = "İçerik giriniz";
    }else {
        $menu = [];
        foreach ($menu_title as $key => $title) {
            $arr = [
                "title" => $title,
                "url" => $menu_url[$key]
            ];

            if (post("sub_title_" . $key)) {
                $sub_array = [];
                $sub_urls = post("sub_url_" . $key);
                foreach (post("sub_title_" . $key) as $sub_url => $sub_title) {
                    $sub_array[] = [
                        "title" => $sub_title,
                        "url" => $sub_urls[$sub_url]
                    ];
                }
                $arr["submenu"] = $sub_array;
            }
            $menu[] = $arr;
        }

        $query = $db->prepare("UPDATE menu SET
            menu_title = :title,
            menu_content = :content
            WHERE menu_id = :id");
        $row = $query->execute([
            "title" => $ititle,
            "content" => json_encode($menu,JSON_UNESCAPED_UNICODE),
            "id" => $id
        ]);
        if($row){
            header("Location:".admin_url("menu"));
        }else{
            $error = "Bir hata oluştu";
        }
    }
}

$menuData = json_decode($row["menu_content"], true);
require //edit-sortable-view;