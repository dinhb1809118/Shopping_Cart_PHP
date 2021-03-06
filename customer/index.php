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


    <title>Shopping</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">
</head>

<body>
    <?php require_once 'conect.php';
        session_start();
        if(isset($_SESSION['customer'])){
            $customer=$_SESSION['customer'];
            $phone=$customer['customers_phone'];
            $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$phone ORDER BY `notification_id` DESC");
            $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$phone");
            $showavatar=mysqli_fetch_assoc($querycustomer);
            
        }
        if(isset($_SESSION['cart'])){
            $numbercart=sizeof($_SESSION['cart']);
            // var_dump($numbercart);exit;
        }else{
            $numbercart=0;
        }
        $sqlslider=mysqli_query($conn,"SELECT * FROM `slider`");
    ?>
    <div class="app">
        <div class="header ">
            <div class="grid-header">
                <div class="header-navbar">
                    <ul class="header-navbar-list">
                        <li class="header-navbar-list-item">
                            <a href="" class="header-navbar-list-link header-navbar-list-link-not-bold">
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
                                        <div class="header-navbar-list-notification-icon"><i class="fal fa-bells"></i>
                                        </div>
                                        <div class="header-navbar-list-notification-text">Th??ng b??o</div>
                                    </a>
                                    <?php  if(isset($_SESSION['customer'])){ ?>
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
                                                <li class="header-navbar-list-notification-link-user-item">Xem t???t c???
                                                </li>
                                            </a>
                                        </div>

                                    </ul>
                                    <?php }else { ?>

                                    <ul class="header-navbar-list-notification-list">
                                        <div class="header-navbar-list-notification-list-padding">
                                            <div class="header-navbar-list-notification-heading">Th??ng B??o M???i Nh???n
                                            </div>
                                            
                                            
                                            <a href="notification.php" class="header-navbar-list-notification-link-user">
                                                <li class="header-navbar-list-notification-link-user-item">Xem t???t c???
                                                </li>
                                            </a>
                                        </div>

                                    </ul>

                                    <?php } ?>
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
                                <img src="./uploads/<?php echo $showavatar['customers_avatar'] ;?>" alt=""
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

                        <?php } else{ ?>
                        <li class="header-navbar-list-item">
                                <a href="register.php" class="header-navbar-list-link">
                                ????ng K??   
                                </a> 
                        </li>
                        <li class="header-navbar-list-item">
                            <a href="login.php" class="header-navbar-list-link">
                                ????ng Nh???p       
                            </a> 
                        </li>
                        <?php } ?>
                    </ul>

                </div>
                <div class="header-with">
                    <a href="index.php" class="header-link-home">
                        <div class="header-with-logo">
                            <div class="header-with-logo-img">
                                <div class="header-with-logo-img-img">
                                    <img src="./img/shopping-logo-svgrepo-com.svg" class="header-with-logo-img-svg"">
            
                                    </div>
                                    <div class=" header-with-logo-img-text">
                                    <b>SHOPPING</b>

                                </div>
                            </div>

                        </div>
                    </a>
                    
                    <form style="flex:1;" method="POST" action="" >
                    <div class="header-with-search">
                        <div class="header-width-search-flex">
                            <input type="text" name="searchtext" class="header-with-search-input" autocomplete="off" placeholder="Nh???p ????? t??m ki???m s???n ph???m">
                            <button name="search" class="header-with-search-btn">
                                <i class="header-with-search-btn-icon fal fa-search"></i>
                            </button>
                            <!-- <div class="header-width-search-history">
                                <h5 class="header-width-search-history-text">L???ch S??? T??m Ki???m</h5>
                                <ul class="header-width-search-history-link">
                                    <li class="header-width-search-history-link-item">
                                        <a href="">aaaaaaa</a>
                                    </li>
                                    <li class="header-width-search-history-link-item">
                                        <a href="">bbbb</a>
                                    </li>
                                </ul>
                            </div> -->

                        </div>
                    </div>
                    </form>
                    
                    <div class="header-with-cart">

                        <a href="cart.php" class="header-width-cart-hover">
                            <i class="header-with-cart-icon far fa-shopping-cart"></i>
                            <span class="header-width-cart-number"><?php echo $numbercart ;?></span>
                            <!-- header-width-cart-list-no-cart -->
                            
                        </a>

                    </div>

                </div>

            </div>

        </div>
        <div class="container">
            <div class="container-margin-top">
                <div class="grid">
                    <div class="advertisement">
                        <div class="slider">
                            <?php while($showslider=mysqli_fetch_assoc($sqlslider)){ ?>
                            <div> <img src="../uploads/<?php echo $showslider['slider_link'];?>" class="slider-image-img" alt=""></div>
                            <?php } ?>

                        </div>
                        <script>
                            $(document).ready(function () {
                                $('.slider').bxSlider({
                                    auto: true, pause: 5000
                                });
                            });
                        </script>
                        <div class="slider-img">
                            <div class="slider-img-one">
                                <img src="./img/11.png" class="slider-img-one-one" alt="">
                            </div>
                            <div class="slider-img-two">
                                <img src="./img/12.png" class="slider-img-two-two" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <?php 
               
                $numberproducts=24;
                 if(isset($_GET['page'])){
                    $page=$_GET['page'];
                    settype($page,"int");
                    
                }else{
                    $page= 1;
                }
                $from=($page-1)*$numberproducts;
                $result=mysqli_query($conn,"SELECT * FROM `products`  LIMIT $from,$numberproducts");
              
                if(isset($_POST['search'])){
                    if(!empty($_POST['searchtext'])){
                        $searchtext=$_POST['searchtext'];
                        $result=mysqli_query($conn,"SELECT * FROM `products` WHERE `products_name` LIKE '%$searchtext%' ");
                        
                    }else{
                        $result=mysqli_query($conn,"SELECT * FROM `products`  ");

                    }
                    
                }
                
               
            ?>
            <div class="grid-product">
                <div class="grid-row">
                    <div class="grid-column">
                        <div class="grid-row">
                            
                            <?php while($show = mysqli_fetch_assoc($result)):  ?>
                                <div class="grid-column-2">
                                    <a class="home-product-item" href="details.php?productsid=<?php echo $show['products_id']; ?>">
                                        <div class="home-product-main"> 
                                            <div class="home-product-item-img"
                                                style="background-image: url('../uploads/<?php echo $show['products_image'];  ?>'); ">
                                            </div>
                                            <h5 class="home-product-item-name"><?php echo $show['products_name']; ?></h5>
                                            <div class="home-product-item-price">
                                                <span class="home-product-item-price-old"><?=number_format($show['products_price_last'],"3",".",",") ?></span>
                                                <span class="home-product-item-price-current"><?=number_format($show['products_price'],"3",".",",") ?></span>
                                            </div>
                                            <div class="home-product-item-action">

                                                <span class="home-product-item-like home-product-item-like-liked">
                                                    <i class="home-product-item-like-icon-empty far fa-heart"></i>
                                                    <i class="home-product-item-like-icon-fill fas fa-heart"></i>
                                                </span>
                                                <div class="home-product-item-rating">
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="home-product-item-star-gold fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="home-product-item-sold">C??n l???i:<?php echo $show['products_quantity'];  ?></span>
                                            </div>
                                            <div class="home-product-item-faviurite">
                                                <i class="fas fa-check"></i>
                                                Y??u th??ch
                                            </div>
                                            <div class="home-product-item-sale-of">
                                                <span class="home-product-item-sale-of-percent"><?php echo 100- (round($show['products_price']*100/$show['products_price_last'])); ?>%</span>
                                                <span class="home-product-item-sale-of-label">GI???M</span>
                                            </div>

                                        </div>
                                        <div class="home-product-hover-footer">T??m s???n ph???m t????ng t???</div>

                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
               
              

                $sqlresult=mysqli_query($conn,"SELECT * FROM `products` ");
                $totalpage=mysqli_num_rows($sqlresult);
                $numberpage=ceil($totalpage / $numberproducts);
            ?>
            <div class="grid-page">
                <div class="pag">
                    <ul class="paging">
                        <?php if($page > 1) {
                            $back=$page-1;
                            ?>

                            <li class="paging-item"> <a href="index.php?page=<?=$back ?>"><i class="fas fa-chevron-left"></i></a></li>
                            <?php } ?>
                        <?php for($i=1 ; $i <= $numberpage ;$i++) {?>
                            <?php if($page != $i) {
                                if($i > $page - 3 && $i< $page+3){
                                ?>  
                                <li class="paging-item"> <a href="index.php?page=<?=$i?>"><?php echo $i ?></a></li>
                            <?php }}else { ?>
                                <li class="paging-item"> <a style="background-color: #EE4D2D"><?php echo $i ?></a></li>
                        <?php }} ?>


                        <?php if($page < $numberpage -1){ $next=$page +1; ?>
                            
                            <li class="paging-item"> <a href="index.php?page=<?=$next ?>"><i class="fas fa-chevron-right"></i></a></li>

                        <?php } ?>
                    </ul>
                </div>

            </div>



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
                                <div class="grid-column-2">
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
    </div>
</body>

</html>