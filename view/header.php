<!DOCTYPE html>
<?php require_once '/../util/main.php'; ?>
<html>
<!-- the head section -->
<head>
    <title>MY PIZZA SHOP</title>
    <link rel="stylesheet" type="text/css"  href="<?php echo $app_path . 'main.css'?>">
      

</head>

<!-- the body section -->
<body>
<header>
    
    <h1> MY PIZZA SHOP</h1>
    <a href="/pizza1">
    
    <image alt="Home" src="/pizza1/images/pizza_slice.png" ></a>
</header>
<aside>
    
    <nav class="vertical">
        <ul>
            <li><a href="<?php echo $app_path . 'admin/'?>">Admin</a></li>
            <li><a href="<?php echo $app_path . 'pizza/'?>">Student</a></li>
        </ul>
    </nav>
        
</aside>
