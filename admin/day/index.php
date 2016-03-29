<?php
require('../../util/main.php');
require('model/database.php');
require('model/order_db.php');
require('model/size_db.php');
require('model/initialize.php');
require('restclient/curl_helper.php');
//require('restclient/index.php');
require('model/inventory.php');

$path=  explode(DIRECTORY_SEPARATOR, $app_path);
array_pop($path);
$path1=implode("/", $path);
$base_url = $_SERVER['SERVER_NAME'].$path1. '/proj2_server/' . 'rest';


error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '0'); // would mess up response
ini_set('log_errors', 1);
// the following file needs to exist, be accessible to apache
// and writable (chmod 777 php-errors.log)
// Use an absolute file path to create just one log for the web app
ini_set('error_log', $project_root . 'php-server-errors.log');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_orders';
    }
}
 if ($action == 'initial_db') {
        $message= 'Database Initialized'; 
        initialize_db();
        header("Location: ..");
        }
        
if ($action == 'list_orders') {
    $current_day= current_day();
    $todays_orders =  get_todays_orders($current_day);
    include('order_list.php');
} else if ($action == 'change_to_nextday') {
    
     try{
            $current_day=current_day();
            $next_day= $current_day+1;
            change_to_finished($current_day);
            update_next_day($next_day);
            

            //post the new day number to the server:
            $curl = curl_init($base_url.'/day');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $next_day);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $page = curl_exec($curl);
            curl_close($curl);
            

           

            //check undelivered orders:
            $undelivered_ids = get_undeliveredorders();
            
            
            //add delivery amounts to inventory:
            foreach($undelivered_ids as $undelivered_id)
            {
                error_log('$undelivered_id= ' . $undelivered_id['orderID']);
                echo $undelivered_id['orderID'] ;
                $curl3 = curl_init($base_url.'/orders/'.$undelivered_id['orderID']);
                curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
                $order_details1 = curl_exec($curl3);
                curl_close($curl3);
                $test = json_decode($order_details1, true);
                if($test['status']==1){
                $flour_quantity = $test['flour_qty'];
                $cheese_quantity = $test['cheese_qty'];
                error_log('$flour_quantity= ' . $test['flour_qty']);
                error_log('$cheese_quantity= ' . $test['cheese_qty']);
                
                
                //deliver the order i.e. add amount to inventory
                add_flour_inventory($flour_quantity);
                add_cheese_inventory($cheese_quantity);
                //now delete orderIDs from undelivered_supplies table for orders delivered above:
                delete_deliverorder_ids($undelivered_id['orderID']);
                }
                
            }
            
            //post new order:
            $n1 = 150;
            //$inventory = get_inventory_details();
            $flour = get_current_flour();
            $cheese = get_current_cheese();
            if ($flour <= $n1 || $cheese <= $n1)
            {
                $quantity11 = floor((150-($flour))/30) + 1;
                $quantity12 = floor((150-($cheese))/20) + 1;
                $data = array('0' => array('customerID' => '1'), 
                              '1' => (array('0' => array('productID' => '11', 'quantity' => $quantity11), 
                                            '1' => array('productID' => '12', 'quantity' => $quantity12))));
                $data_string = json_encode($data);
                $curl1 = curl_init($base_url.'/orders');
                curl_setopt($curl1, CURLOPT_POST, true);
                curl_setopt($curl1, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl1, CURLOPT_HEADER, true);  // return header info
                curl_setopt($curl1, CURLINFO_HEADER_OUT, true); // return headers in response data
                $response = curl_exec($curl1);
                $curl_info = curl_getinfo($curl1);
                curl_close($curl1);
                
                $header = substr($response, 0, $curl_info['header_size']);
                // header has line "Location: <value>" terminated by \n
                $i = strpos($header, 'Location: ');
                $s = substr($header, $i + strlen('Location: ')); // so $s starts with value
                $j = strpos($s, "\n"); // find \n: use double quotes here to get \n to work
                $location = substr($s, 0, $j);  // extract value        
                $response1 = substr($response, $curl_info['header_size']); // body
                $parts = explode('/', $location);
                
                $orderID = end($parts);
                error_log('$orderID= ' . $parts[0]);
                error_log('$orderID= ' . $parts[1]);
                error_log('$orderID= ' . $parts[2]);
                error_log('$orderID= ' . $parts[3]);
                error_log('$orderID= ' . $parts[5]);
                error_log('$orderID= ' . $parts[6]);
                error_log('$orderID= ' . $parts[7]);
                error_log('$orderID= ' . $parts[8]);
                
            
                //get back the order details along with orderID 
                $curl2 = curl_init($base_url.'/orders/'.$orderID);
                curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
                $order_details = curl_exec($curl2);
                curl_close($curl2);
                
                //add the orderID of this new order in undelivered_supplies table
              //  post_orderID($orderID);
              insert_orderID($orderID);
                
            }        
    } catch (PDOException $e) {
            $error_message = $e->getMessage(); 
            include('errors/database_error.php');
            exit();
    }
    
    header("Location: .");
    
    
    } 
?>