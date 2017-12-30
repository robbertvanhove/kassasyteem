<?php
    $method = $_GET["action"];



    switch ($method) {
        case 'add':
            addProduct();
            break;
        case 'delete':
            deleteProduct();
            break;
        
        default:
            echo error_log();
            break;
    }



    function addProduct(){
        //inhoud producten.sjon ophalen
        $file = file_get_contents('producten.json');
        $data = json_decode($file, true);
        
        //new product in array
        $product = $_GET["product"];
        $inhoud = $_GET["inhoud"];
        $prijs = (float)$_GET["prijs"];
        $soort = $_GET["soort"];
        //nieuw id bepalen
        $laatste = end($data)['id'];
        $id = $laatste + 1;

        $new =array('id' => $id, 'product' => $product, 'inhoud' => $inhoud, 'prijs' => $prijs, 'soort' => $soort);

        //producten.json updaten
        array_push($data, $new) ;
        $json = json_encode($data);
        
       file_put_contents('producten.json', $json) ;
    }


    function deleteProduct(){
        $id = $_GET["id"];

         //inhoud producten.sjon ophalen
         $file = file_get_contents('producten.json');
         $data = json_decode($file, true);

         //object deleten uit array
         foreach($data as $key => $product){
             if($product['id'] == $id){
                 
                 unset($data[$key]);
             }
         }

         //json updaten
         $json = json_encode($data);
         
        file_put_contents('producten.json', $json) ;
    }

   
?>