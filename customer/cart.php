<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">

    <title>Shopping</title>
    <style>

    </style>
</head>

<body>
    <?php   
            require_once "conect.php";
            session_start();
           
            if(isset($_SESSION['customer'])){
                $customer=$_SESSION['customer'];
                // var_dump($customer);
                $address=$customer['customers_phone'];
            }else{
                header('Location:login.php');
                exit;
            }
            if(!isset($_SESSION["cart"])){
                $_SESSION["cart"]=array();
                //tao mot session
                // unset($_SESSION["cart"]);exit;
            }
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case "add":
                        
                        // Lay gia tri ve
                        $id=$_POST['id'];
                        $img=$_POST['image'];
                        $namesp=$_POST['namesp'];
                        $color=$_POST['color'];
                        $size=$_POST['size'];
                        $price=$_POST['price'];
                        $pricelast=$_POST['pricelast'];
                        $quantity=$_POST['quantity'];

                       


                        //co
                        $flag=0;
                        //kiem tra co id trung vs id sp truoc do hay khong
                        for($i=0;$i<sizeof($_SESSION["cart"]);$i++){
                            if($_SESSION["cart"][$i][0]==$id && $_SESSION["cart"][$i][3]==$color && $_SESSION["cart"][$i][4]==$size){
                                $newquantity=$quantity+$_SESSION["cart"][$i][7];
                                $_SESSION["cart"][$i][7]=$newquantity;
                                $flag=1;
                                break;
                            }
                        }
                        //neu khong co thi them do
                        if($flag==0){
                            $product=[$id,$img,$namesp,$color,$size,$price,$pricelast,$quantity];
                            $_SESSION["cart"][]=$product;
                        }
                        if(isset($_POST['submit'])){
                            header('Location:cart.php');
                        }else if(isset($_POST['addsubmit'])){
                            header("location:javascript://history.go(-1)");
                        }
                        
                    break;
                    case "delete":
                        if(isset($_GET['deleteid'])){
                            array_splice($_SESSION["cart"],$_GET['deleteid'],1);
                        
                        }
                        header('Location:cart.php');
                    break;
                    case "errors":
                        echo "<script>alert('L???i:S??? l?????ng c??n l???i kh??ng ????? b???n y??u c???u!');</script>" ;
                        
                    break;
                    
                    
                        
                }

                  
                
            }
            if(isset($_POST['addressadd'])){
                if(isset($_POST['address-name'])){
                    $addressname=$_POST['address-name'];
                }
                if(isset($_POST['address-phone'])){
                    $addressphone=$_POST['address-phone'];
                }
                if(isset($_POST['address-city'])){
                    $addresscity=$_POST['address-city'];
                }
                if(isset($_POST['address-district'])){
                    $addressdistrict=$_POST['address-district'];
                }
                if(isset($_POST['address-district-details'])){
                    $addressdistrictdetails=$_POST['address-district-details'];
                }
                if(isset($_SESSION['customer'])){
                    $customer=$_SESSION['customer'];
                    // var_dump($customer);
                    $address=$customer['customers_phone'];
                }
                
                // var_dump($address);
                // var_dump($addressphone);
                // var_dump($addresscity);
                // var_dump($addressdistrict);
                // var_dump($addressdistrictdetails);

                $sql=mysqli_query($conn,"INSERT INTO `addresses`(`customers_phone`, `addresses_name_customer`, `addresses_phone`, `addresses_name`) 
                VALUES ('$address','$addressname','$addressphone','$addresscity , $addressdistrict , $addressdistrictdetails')");
                header('Location:cart.php');
            }
            if(isset($_SESSION['customer'])){
                $customer=$_SESSION['customer'];
                // var_dump($customer);
                $address=$customer['customers_phone'];
                $queryaddress=mysqli_query($conn,"SELECT * FROM `addresses` WHERE `customers_phone`=$address");
                $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$address ORDER BY `notification_id` DESC");
                $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$address");
                $showavatar=mysqli_fetch_assoc($querycustomer);
            }
            
        
                
        
            
           


     ?>
     
    
    <div class="app">
        <div class="header-cart">
            <div class="header-cart-navigation-1">
                <div class="grid-header">
                    <div class="header-navbar">
                        <ul class="header-navbar-list">
                            <li class="header-navbar-list-item">
                                <a href="index.php" class="header-navbar-list-link header-navbar-list-link-not-bold">
                                    Trang Ch???
                                </a>
                            </li>
                            <li class="header-navbar-list-item">
                                <a href="" class="header-navbar-list-link header-navbar-list-link-not-bold">
                                    Gi???i Thi???u
                                </a>
                            </li>
                        </ul>
                        <ul class="header-navbar-list">
                            <li class="header-navbar-list-notification">
                                <div class="header-navbar-list-notification-flex">
                                    <div class="header-navbar-list-notification-link-hover">
                                        <a href="notification.php" class="header-navbar-list-notification-link">
                                            <div class="header-navbar-list-notification-icon"><i
                                                    class="fal fa-bells"></i>
                                            </div>
                                            <div class="header-navbar-list-notification-text">Th??ng b??o</div>
                                        </a>

                                        <ul class="header-navbar-list-notification-list">
                                            <div class="header-navbar-list-notification-list-padding">
                                                <div class="header-navbar-list-notification-heading">Th??ng B??o M???i Nh???n
                                                </div>
                                                <?php $dem=0;
                                            while($shownoti=mysqli_fetch_assoc($querynotication)){ ?>
                                            <li class="header-navbar-list-notification-list-item">
                                                <div class="header-navbar-list-notification-list-item-image">
                                                    <img src="../uploads/<?php echo $shownoti['notification_img'] ;?>"
                                                        alt="" class="header-navbar-list-notification-list-item-img">
                                                </div>
                                                <div class="header-navbar-list-notification-list-item-text">
                                                    <div class="header-navbar-list-notification-list-item-text-heading">
                                                        <?php echo $shownoti['notification_title'] ;?>

                                                    </div>
                                                    <div
                                                        class="header-navbar-list-notification-list-item-text-container">
                                                        <?php echo $shownoti['notification_name'] ;?>
                                                    </div>
                                                    <?php echo $shownoti['notification_date_start'] ;?>
                                                </div>
                                            </li>
                                                <?php  $dem=$dem+1; 
                                                    if($dem==5){
                                                        break;
                                                    }
                                                } ?>
                                                <a href="notification.php" class="header-navbar-list-notification-link-user">
                                                    <li class="header-navbar-list-notification-link-user-item">Xem t???t
                                                        c???
                                                    </li>
                                                </a>
                                            </div>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="header-navbar-list-help">
                                <div class="header-navbar-list-help-flex">
                                    <a href="" class="header-navbar-list-help-link">
                                        <div class="header-navbar-list-help-icon">
                                            <i class="fal fa-question-circle"></i>
                                        </div>
                                        <div class="header-navbar-list-help-text">
                                            H??? Tr???
                                        </div>
                                    </a>
                                </div>
                            </li>

                            <?php if(isset($customer)){ ?>
                        
                            <li class="header-navbar-list-item header-navbar-list-item-user">
                                <?php if(!empty($showavatar['customers_avatar'])){ ?>
                                    <img src="uploads/<?php echo $showavatar['customers_avatar'] ;?>" alt=""
                                        class="header-navbar-user-img">
                                <?php } else{ ?>
                                    <img src="./img/avatar.png" alt=""
                                        class="header-navbar-user-img">
                                <?php } ?>
                                <span class="header-navbar-user-name"><?php echo $customer['customers_name'];?></span>
                                <ul class="header-navbar-user-list">
                                    <a href="account.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser">T??i Kho???n C???a T??i</li>
                                    </a>
                                    <a href="order.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser-user">????n Mua</li>
                                    </a>
                                    <a href="logout.php" class="header-navbar-user-link">
                                        <li class="header-bavber-user-list-item-myuser-logout">????ng Xu???t</li>
                                    </a>
                                </ul>
                            </li>

                        <?php }  ?>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="header-cart-navigation-2">
                <div class="grid-header">
                    <div class="header-with-search-cart-details-margin">
                        <div class="header-with-cart-details">
                            <a href="index.php" class="header-link-home">
                                <div class="header-with-logo-cart">
                                    <div class="header-with-logo-img-cart">
                                        <div class="header-with-logo-img-img">
                                            <img src="./img/shopping-logo-svgrepo-com.svg"
                                                class="header-with-logo-img-svg"">
                
                                    </div>
                                    <div class=" header-with-logo-img-text-cart">
                                            <b>SHOPPING</b>
                                        </div>
                                    </div>
                                    <div class="header-with-logo-cart-item">
                                        <div class="header-with-logo-cart-text">Gi??? h??ng</div>
                                    </div>

                                </div>
                            </a>

                            <div class="header-with-search-cart-details">
                                <div class="header-width-search-flex">
                                    <input type="text" class="header-with-search-input"
                                        placeholder="Nh???p ????? t??m ki???m s???n ph???m">
                                    <button class="header-with-search-btn-cart">
                                        <i class="header-with-search-btn-icon fal fa-search"></i>
                                    </button>
                                    <div class="header-width-search-history">
                                        <h5 class="header-width-search-history-text">L???ch S??? T??m Ki???m</h5>
                                        <ul class="header-width-search-history-link">
                                            <li class="header-width-search-history-link-item">
                                                <a href="">aaaaaaa</a>
                                            </li>
                                            <li class="header-width-search-history-link-item">
                                                <a href="">bbbb</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </div>



    
    <?php //kiem tra gio hang co rong hay khong
            if(sizeof($_SESSION["cart"])>0){
    ?>



        <div class="container-cart">
<form method="POST" action="pay.php?action=submitcart" id="myform" >
            <div class="grid-header">
                <div class="container-cart-big">
                    <div class="container-cart-heading">
                        <div class="container-cart-heading-item">
                            <div class="container-cart-heading-icon"><i
                                    class="fad fa-shipping-fast container-cart-heading-icon-color"></i></div>
                            <div class="container-cart-heading-text">Nh???n v??o m???c M?? gi???m gi?? ??? cu???i trang ????? h?????ng mi???n
                                ph?? v???n chuy???n b???n nh??!
                            </div>
                        </div>
                    </div>
                    <div class="container-pay-big">
                        <div class="container-pay-address">
                            <div class="container-pay-address-space"></div>
                                <div class="container-pay-address-fex">
                                    <div class="container-pay-address-heading">
                                        <div class="container-pay-address-heading-icon">
                                            <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                                            <lord-icon src="https://cdn.lordicon.com/zzcjjxew.json" trigger="loop"
                                                colors="primary:#e83a30,secondary:#e83a30" style="width:35px;height:40px">
                                            </lord-icon>
                                        </div>
                                        <div class="container-pay-address-heading-text">
                                            ?????a ch??? nh???n h??ng
                                        </div>
                                    </div>
                                    <div class="container-pay-address-button-add">
                                        <div  class="container-pay-address-button-add-btn">
                                            <div class="container-pay-address-button-add-icon">
                                                <i class="fal fa-plus"></i>
                                            </div>
                                            <div class="container-pay-address-button-add-text">
                                                Th??m ?????a ch??? m???i
                                            </div>

                                        </div>
                                    </div>

                            </div>
                            <div class="container-pay-address-list">
                                <div class="container-pay-address-list-big">
                                
                                <?php while($showaddress=mysqli_fetch_assoc($queryaddress)) { ?>
                                    <div class="container-pay-address-list-item">
                                        <div class="container-pay-address-list-input">
                                            <input type="radio" name="addressorders" checked value="<?php echo $showaddress['addresses_name_customer']; ?>;<?php echo $showaddress['addresses_phone']; ?>;<?php echo $showaddress['addresses_name']; ?>"
                                                class="container-pay-address-list-input-check">
                                        </div>
                                        <div class="container-pay-address-list-name">
                                            <div class="container-pay-address-list-name-customers">
                                                <b><?php echo $showaddress['addresses_name_customer']; ?> &nbsp; <?php echo $showaddress['addresses_phone']; ?></b>
                                                
                                            </div>
                                        </div>
                                        <div class="container-pay-address-list-address">
                                            <?php echo $showaddress['addresses_name']; ?>
                                        </div>
                                    </div>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-cart-category">
                        <div class="container-cart-category-item">
                            <div class="container-cart-category-input">
                                <input type="checkbox"  class="container-cart-category-input-check">
                            </div>
                            <div class="container-cart-category-products">
                                <div class="container-cart-category-products-item">
                                    S???n ph???m
                                </div>
                            </div>
                            <div class="container-cart-price">
                                <div class="container-cart-price-item">????n gi??</div>
                            </div>
                            <div class="container-cart-quantity">
                                <div class="container-cart-quantity-item">
                                    S??? l?????ng
                                </div>
                            </div>
                            <div class="container-cart-money">
                                <div class="container-cart-money-item">
                                    S??? ti???n
                                </div>
                            </div>
                            <div class="container-cart-operation">
                                <div class="container-cart-operation-item">
                                    Thao t??c
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-cart-details">
                        <div class="container-cart-details-big">
                            <div class="container-cart-details-heading">
                                <div class="container-cart-details-heading-love">Y??u th??ch+</div>
                                <div class="container-cart-details-heading-icon">
                                    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/gmzxduhd.json" trigger="loop"
                                        colors="primary:#e83a30,secondary:#e83a30" style="width:25px;height:25px">
                                    </lord-icon>
                                </div>
                                <div class="container-cart-details-heading-text">Shopping</div>
                                <div class="container-cart-details-heading-chat">
                                    <i class="far fa-comment-alt-lines"></i>

                                </div>
                            </div>
                       
                            <?php 
                                    if(isset($_SESSION["cart"])){
                                            for( $i=0; $i<sizeof($_SESSION["cart"]) ; $i++){
                                                //thanh tien
                                                $total=$_SESSION["cart"][$i][5]*$_SESSION["cart"][$i][7];
                                        
                                    
                            ?>
                        
                            <div class="container-cart-details-products">
                                <div class="container-cart-details-products-input">
                                    <input type="checkbox" name="checkked[]" value="<?=$_SESSION["cart"][$i][0];?>,<?=$_SESSION["cart"][$i][3];?>,<?=$_SESSION["cart"][$i][4];?>,<?=$_SESSION["cart"][$i][7];?>"  class="container-cart-details-products-input-check">
                                </div>
                                <div class="container-cart-details-products-product">
                                    <div class="container-cart-details-products-product-big">
                                        <div class="container-cart-details-products-product-item1">
                                            <a href="" class="container-cart-details-products-link1">
                                                <div class="container-cart-details-products-image">
                                                    <img src="../uploads/<?php echo $_SESSION["cart"][$i][1]; ?>"
                                                        alt="" class="container-cart-details-products-img">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="container-cart-details-products-product-item2">
                                            <a href="" class="container-cart-details-products-link2">
                                                <div class="container-cart-details-products-text">
                                                    <?php echo $_SESSION["cart"][$i][2]; ?>
                                                </div>
                                            </a>
                                            <div class="container-cart-details-products-image-sale">
                                                <img src="https://cf.shopee.vn/file/b6a5d995ed7d4875c78a012fac73bbe2"
                                                    alt="" class="container-cart-details-products-img-sale">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-cart-details-products-classity">
                                    <div class="container-cart-details-products-classity-big">
                                        <div class="container-cart-details-products-classity-heading">
                                            <div class="container-cart-details-products-classity-item">Ph??n lo???i h??ng:<i
                                                    class="fal fa-sort-down container-cart-details-products-classity-button-btn"></i>

                                            </div>

                                        </div>
                                        <div class=" container-cart-details-products-classity-text">

                                            <div class="container-cart-details-products-color"><?php echo $_SESSION["cart"][$i][3];?></div>
                                            <div class="container-cart-details-products-space">,</div>
                                            <div class="container-cart-details-products-size"><?php echo $_SESSION["cart"][$i][4];?></div>
                                            <div class="container-cart-details-products-daucham">.</div>

                                        </div>
                                        <input type="hidden" class="input-submit-color" name="colorcart[]" value="<?php echo $_SESSION["cart"][$i][3] ;?>">
                                        <input type="hidden" class="input-submit-size" name="sizecart[]" value="<?php echo $_SESSION["cart"][$i][4] ;?>">
                                      
                                    </div>
                                </div>
                                <div class="container-cart-details-products-price">
                                    <div class="container-cart-details-products-price-big">
                                        <div class="container-cart-details-products-price-last">???<?=number_format($_SESSION["cart"][$i][6],"3",".",",") ?></div>
                                        <div class="container-cart-details-products-price-now">???<?=number_format($_SESSION["cart"][$i][5],"3",".",",") ?></div>
                                    </div>
                                </div>
                                <div class="container-cart-details-products-number">
                                    <div class="container-details-quantity-products">


                                        <div class="container-details-quantity-number-quantity">
                                            <div class="container-details-minus" >
                                                <i class="fal fa-minus container-details-minus-btn"></i>
                                            </div>
                                           
                                                        
                                            <input type="number"  
                                                class="container-details-input-text" min="1" max="300"
                                                value="<?php echo $_SESSION["cart"][$i][7] ;?>">
                                               
                                            <div class="container-details-minus-btn-btn">
                                                <i class="fal fa-plus container-details-minus-btn"></i>
                                            </div>
                                            <input type="hidden" name="quantitycart[]" value="<?php echo $_SESSION["cart"][$i][7] ;?>">
                                        </div>


                                    </div>
                                </div>
                                <div class="container-cart-details-products-money">
                                    <div class="container-cart-details-products-money-number">
                                        ???<?=number_format($total,"3",".",",") ?>
                                    </div>
                                </div>
                                <div class="container-cart-details-products-operation">
                                    <div class="container-cart-details-products-operation-item">
                                        <a href="cart.php?action=delete&deleteid=<?=$i;?>" class="container-cart-details-products-delete">X??a</a>
                                    </div>
                                </div>

                            </div>
                           
                      
                            <input type="hidden" name="idcart[]" value="<?php echo $_SESSION["cart"][$i][0] ;?>">
                            
                           
                            <input type="hidden" name="imagecart[]" value="<?php echo $_SESSION["cart"][$i][1] ;?>">
                            <input type="hidden" name="namecart[]" value="<?php echo $_SESSION["cart"][$i][2] ;?>">
                            <input type="hidden" name="pricecart[]" value="<?php echo $_SESSION["cart"][$i][5] ;?>">
                            <input type="hidden" name="pricelastcart[]" value="<?php echo $_SESSION["cart"][$i][6] ;?>">
                            <!-- $product=[$id,$img,$namesp,$color,$size,$price,$pricelast,$quantity]; -->
                            
                            <?php   }} ?>
                            <div class="container-cart-details-buy-button" >
                                <button class="container-cart-details-buy-btn" name="submitadd">C???p nh???t</button>
                            </div>
                       
                            <div class="container-cart-details-buy">
                                <div class="container-cart-details-buy-flex">
                                    <div class="container-cart-details-buy-flex-item1">
                                        <div class="container-cart-details-buy-input">
                                            <input type="checkbox" class="container-cart-details-buy-input-check">
                                        </div>
                                        <div class="container-cart-details-buy-list">
                                            <button class="container-cart-details-buy-list-item">Ch???n t???t c???
                                                (183)</button>
                                        </div>
                                        <div class="container-cart-details-buy-delete">
                                            <div href="" class="container-cart-details-buy-link">X??a</div>
                                        </div>

                                    </div>
                                    <div class="container-cart-details-buy-flex-item2">
                                        <div class="container-cart-details-buy-sum">
                                            <div class="container-cart-details-buy-sum-text">
                                                T???ng thanh to??n (0 S???n ph???m):
                                            </div>
                                            <div class="container-cart-details-buy-sum-number">
                                                ???0
                                            </div>
                                        </div>
                                        <div class="container-cart-details-buy-button">
                                            <button class="container-cart-details-buy-btn" name="submitlink">Mua h??ng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <div class="grid-image-empty">
            <div class="cart-empty-image">
                <div class="cart-empty-big">
                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/cart/9bdd8040b334d31946f49e36beaf32db.png" alt="" class="cart-empty-img">

                </div>
                <div class="cart-empty-text">Gi??? h??ng c???a b???n c??n tr???ng</div>
            </div>
        </div>

    <?php } ?>




<form method="POST" action="cart.php" >
    <div class="modal-app">
        <div class="app-pay">
            <div class="app-pay-big">
                <div class="app-pay-heading">?????a ch??? m???i</div>
                <div class="app-pay-information">
                    <input type="text" name="address-name" placeholder="H??? v?? t??n" class="app-pay-information-name" required>
                    <input type="text" name="address-phone" placeholder="S??? ??i???n tho???i" class="app-pay-information-phone" required>
                </div>
                <div class="app-pay-address">
                    <div class="app-pay-address-flex">
                        <select name="calc_shipping_provinces" class="app-pay-address-city" required="">
                            <option class="app-pay-address-city-value" value="">T???nh/ Th??nh ph???</option>
                        </select>
                        <select name="calc_shipping_district" class="app-pay-address-district" required="">
                            <option class="app-pay-address-district-value" value="">Qu???n / Huy???n</option>
                        </select>

                    </div>
                    <input class="billing_address_1 " name="address-city" type="hidden" value="">
                    <input class="billing_address_2" name="address-district" type="hidden" value="">
                    <script src='./javascript/lib.js'></script>
                </div>
                <div class="app-pay-address-details">
                    <input type="text"  name="address-district-details" placeholder="?????a ch??? c??? th???" required class="app-pay-address-details-check">
                </div>
                <div class="app-pay-button">
                    <div class="app-pay-btn-back">Tr??? L???i</div>
                    <button  name="addressadd" class="app-pay-btn-submit">Ho??n Th??nh</button>
                </div>

            </div>
        </div>
    </div>

</form>




        <div class="footer-brg-text">
            <div class="hr"></div>
            <div class="grid-footer">
                <footer class="footer-text">
                    <p class="footer-text-1">
                    <h3>SHOPPING - G?? C??NG C??, MUA H???T ??? SHOPPING</h3>
                    Shopping - ???ng d???ng mua s???m tr???c tuy???n th?? v???, tin c???y,
                    an to??n v?? mi???n ph??! Shopping l?? n???n t???ng giao d???ch tr???c tuy???n h??ng ?????u ??? ????ng Nam ??, Vi???t Nam,
                    Singapore, Malaysia, Indonesia, Th??i Lan, Philipin, ????i loan v?? Brazil. V???i s??? ?????m b???o c???a
                    Shopping, b???n s??? mua h??ng tr???c tuy???n an t??m v?? nhanh ch??ng h??n bao gi??? h???t!
                    </p>
                    <p class="footer-text-2">
                    <h3>MUA S???M V?? B??N H??NG ONLINE ????N GI???N, NHANH CH??NG V?? AN TO??N</h3>
                    N???u b???n ??ang t??m ki???m m???t trang web ????? mua v?? b??n h??ng tr???c tuy???n th?? Shopping.vn l?? m???t s??? l???a
                    ch???n tuy???t v???i d??nh cho b???n.
                    B???n ch???t c???a Shopping l?? m???t social E-commerce platform - n???n t???ng trang web th????ng m???i ??i???n t???
                    t??ch h???p m???ng x?? h???i. ??i???u n??y cho ph??p ng?????i mua v?? ng?????i b??n h??ng d??? d??ng t????ng t??c, trao ?????i
                    th??ng tin v??? s???n ph???m v?? ch????ng tr??nh khuy???n m??i c???a shop. Nh??? n???n t???ng ????, vi???c mua b??n tr??n
                    Shopping tr??? n??n nhanh ch??ng v?? ????n gi???n h??n.
                    B???n c?? th??? tr?? chuy???n tr???c ti???p v???i nh?? b??n h??ng ????? h???i tr???c ti???p v??? m???t h??ng c???n mua.
                    </p>
                    <p class="footer-text-3">
                    <h3>MUA H??NG HI???U CAO C???P GI?? T???T T???I SHOPPING</h3>
                    B??n c???nh Shopping Premium, Shopping c??n c?? r???t nhi???u khuy???n m??i kh???ng cho h??ng hi???u gi???m ?????n
                    50%. C???ng v???i m?? giao h??ng mi???n ph??, Shopping c??ng c?? c??c m?? gi???m gi?? ???????c ph??n ph???i m???i th??ng
                    t??? r???t nhi???u gian h??ng ch??nh h??ng tham gia ch????ng tr??nh khuy???n m??i n??y. B??n c???nh ????,
                    Shopping c??n t???p h???p r???t nhi???u th????ng hi???u ????nh ????m ???????c c??c nh?? b??n l??? uy t??n ph??n ph???i b??n
                    tr??n Shopping, ??em ?????n cho b???n s??? l???a ch???n ??a d???ng, t??? c??c h??ng m??? ph???m n???i ti???ng h??ng ?????u
                    </p>
                    <p class="footer-text-4">
                    <h3>MUA H??NG CH??NH H??NG T??? C??C TH????NG HI???U L???N V???I SHOPPING</h3>
                    Mua h??ng tr??n Shopping lu??n l?? m???t tr???i nghi???m ???n t?????ng. D?? b???n ??ang c?? nhu c???u mua b???t k??? m???t
                    h??ng th???i trang nam, th???i trang n???
                    L?? m???t k??nh b??n h??ng uy t??n, Shopping lu??n cam k???t mang l???i cho kh??ch h??ng nh???ng tr???i nghi???m mua
                    s???m online gi?? r???, an to??n v?? tin c???y. M???i th??ng tin v??? ng?????i b??n v?? ng?????i mua ?????u ???????c b???o m???t
                    tuy???t ?????i.
                    C??c ho???t ?????ng giao d???ch thanh to??n t???i Shopping lu??n ???????c ?????m b???o di???n ra nhanh ch??ng, an to??n.
                    M???t v???n ????? n???a khi???n cho c??c kh??ch h??ng lu??n quan t??m ???? ch??nh l?? mua h??ng tr??n Shopping c?? ?????m
                    b???o kh??ng. Shopping lu??n cam k???t m???i s???n ph???m tr??n Shopping,
                    ?????c bi???t l?? Shopping Mall ?????u l?? nh???ng s???n ph???m ch??nh h??ng, ?????y ????? tem nh??n, b???o h??nh t??? nh?? b??n
                    h??ng. Ngo??i ra, Shopping b???o v??? ng?????i mua v?? ng?????i b??n b???ng c??ch gi??? s??? ti???n giao d???ch ?????n khi
                    ng?????i mua x??c nh???n ?????ng ?? v???i ????n h??ng v?? kh??ng c?? y??u c???u khi???u n???i,
                    tr??? h??ng hay ho??n ti???n n??o. Thanh to??n sau ???? s??? ???????c chuy???n ?????n cho ng?????i b??n. ?????n v???i Shopping
                    ngay h??m nay ????? mua h??ng online gi?? r??? v?? tr???i nghi???m d???ch v??? ch??m s??c kh??ch h??ng tuy???t v???i t???i
                    ????y. ?????c bi???t khi mua s???m tr??n Shopping Mall, b???n s??? ???????c mi???n ph?? v???n chuy???n, giao h??ng t???n n??i
                    v?? 7 ng??y mi???n ph?? tr??? h??ng. Ngo??i ra,
                    kh??ch h??ng c?? th??? s??? d???ng Shopping Xu ????? ?????i l???y m?? gi???m gi?? c?? gi?? tr??? cao v?? voucher d???ch v???
                    h???p d???n.
                    </p>
                </footer>
                <div class="hr-footer"></div>



            </div>

        </div>
        <div class="footer-brg">
            <div class="grid">
                <footer class="footer">
                    <div class="grid-column">
                        <div class="grid-row-footer">
                            <div class="grid-column-footer-2">
                                <h5 class="header-color">CH??M S??C KH??CH H??NG</h5>
                                <ul class="footer-list">
                                    <li class="footer-list-item">Trung T??m Tr??? Gi??p</li>
                                    <li class="footer-list-item">Shopping Blog</li>
                                    <li class="footer-list-item">Shopping Mall</li>
                                    <li class="footer-list-item">H?????ng D???n Mua H??ng</li>
                                    <li class="footer-list-item">H?????ng D???n B??n H??ng</li>
                                    <li class="footer-list-item">Thanh To??n</li>
                                    <li class="footer-list-item">Shopping Xu</li>
                                    <li class="footer-list-item">V???n chuy???n</li>
                                    <li class="footer-list-item">Tr??? H??ng & Ho??n Ti???n</li>
                                    <li class="footer-list-item">Ch??m S??c Kh??ch H??ng</li>
                                    <li class="footer-list-item">Ch??nh Sach B???o h??nh</li>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">V??? SHOPPING</h5>
                                <ul class="footer-list">
                                    <li class="footer-list-item">Gi???i Thi???u Shopping Vi???t Nam</li>
                                    <li class="footer-list-item">Tuy???n D???ng</li>
                                    <li class="footer-list-item">??i???u Kho???n Shopping</li>
                                    <li class="footer-list-item">Ch??nh S??ch B???o M???t</li>
                                    <li class="footer-list-item">Ch??nh H??ng </li>
                                    <li class="footer-list-item">K??nh Ng?????i B??n</li>
                                    <li class="footer-list-item">Flash Sales</li>
                                    <li class="footer-list-item">Ch????ng Tr??nh Ti???p Th??? Li??n K???t Shopping</li>
                                    <li class="footer-list-item">Li??n H???n V???i Truy???n Th??ng</li>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">THANH TO??N</h5>
                                <ul class="footer-list footer-list-icon">
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo1.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo2-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo3-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo4.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo5-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo6-removebg-preview.png" alt=""></li>

                                </ul>
                                <div class="footer-logistic">????N V??? V???N CHUY???N</div>
                                <ul class="footer-list footer-list-icon-logistic">
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/SPX__Shopee_Express__Logo_-_Free_Vector_Download_PNG-removebg-preview.png"
                                            alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/giao-hang-tiet-kiem-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_ghn.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo-viettelpost-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo-vietnampost-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_jt_E-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_GrapE-removebg-preview.png" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_ninjavansvg.svg" alt=""></li>
                                    <li class="footer-list-item "><img class="foter-list-imtem-img"
                                            src="./img/logo_bestE-removebg-preview.png" alt=""></li>
                                </ul>

                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">THEO D??I CH??NG T??I TR??N</h5>
                                <ul class="footer-list-list">
                                    <li class="footer-list-item"><a class=" footer-list-item-link"
                                            href="https://www.facebook.com/">
                                            <div class="footer-icon">
                                                <i class="fab fa-facebook footer-list-item-icon-link"></i>
                                            </div>
                                            <div class="text-big">
                                                Facebook
                                            </div>
                                    </li>
                                    </a>
                                    <li class="footer-list-item footer-list-item-link "><a
                                            class=" footer-list-item-link" href="https://www.instagram.com/">
                                            <div class="footer-icon">
                                                <i class="fab fa-instagram footer-list-item-icon-link"></i>
                                            </div>
                                            <div class="text-big">
                                                Instagram
                                            </div>
                                    </li>
                                    </a>
                                    <li class="footer-list-item footer-list-item-link "><a
                                            class=" footer-list-item-link" href="https://www.linkedin.com/">
                                            <div class="footer-icon">
                                                <i class="fab fa-linkedin footer-list-item-icon-link"></i>
                                            </div>
                                            <div class="text-big">
                                                Linkedln
                                            </div>
                                    </li>
                                    </a>
                                </ul>
                            </div>
                            <div class="grid-column-2">
                                <h5 class="header-color">T???I ???NG D???NG NGAY TH??I</h5>
                                <div class="footer-dowload">
                                    <div class="footer-qr">
                                        <a href="" class="footer-qr-img"><img class="footer-qr-img-dowload"
                                                src="./img/qr.png" alt=""></a>
                                    </div>
                                    <div class="footer-app">
                                        <ul class="footer-list-dowload">
                                            <li class="footer-list-item-dowload"><img
                                                    class="footer-list-item-dowload-text"
                                                    src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/39f189e19764dab688d3850742f13718.png"
                                                    alt=""></li>
                                            <li class="footer-list-item-dowload-space"><img
                                                    class="footer-list-item-dowload-text"
                                                    src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/f4f5426ce757aea491dce94201560583.png"
                                                    alt=""></li>
                                            <li class="footer-list-item-dowload footer-list-item-dowload-space"><img
                                                    class="footer-list-item-dowload-text"
                                                    src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/1ae215920a31f2fc75b00d4ee9ae8551.png"
                                                    alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </footer>
                <div class="footer-hr-color"></div>
                <div class="grid-text-hr">
                    <div class="grid-text-hr-text">
                        ?? 2021 Shopping. T???t c??? c??c quy???n ???????c b???o l??u.
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-address">
            <div class="grid-address">
                <ul class="footer-address-list">
                    <li class="footer-address-list-text footer-address-list-text-space">CH??NH S??CH B???O M???T</li>

                    <li class="footer-address-list-text footer-address-list-text-space">QUY CH??? HO???T ?????NG</li>
                    <li class="footer-address-list-text footer-address-list-text-space">CH??NH S??CH V???N CHUY???N</li>
                    <li class="footer-address-list-text">CH??NH S??CH TR??? H??NG VA HO??N TI???N</li>
                </ul>
                <div class="footer-address-image">
                    <img src="./img/logo-removebg-preview.png" alt="" class="footer-address-image-item">
                    <img src="./img/logo-removebg-preview.png" alt="" class="footer-address-image-item">
                    <img src="./img/4bdefde103e8aa245cd17511adde9f89-removebg-preview.png" alt=""
                        class="footer-address-image-item-item">
                </div>
                <div class="footer-shopping">C??ng ty TNHH Shopping</div>
            </div>
        </div>
    </div>
    
    <script src="./javascript/cart.js"></script>
</body>

</html>