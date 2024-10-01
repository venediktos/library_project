<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $search_query = htmlspecialchars(trim($_GET["search"]));
    if(!empty($search_query)){
        echo "Search Query: ".$search_query;
    }
    else{
        echo "No search query";
    }
}