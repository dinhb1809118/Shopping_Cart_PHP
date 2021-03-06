<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/base.css">

</head>
    
<body>
    <?php 
        require_once 'conect.php';
        session_start();
        if(isset($_SESSION['customer'])){
            $customer=$_SESSION['customer'];
            $phone=$customer['customers_phone'];
            $querynotication=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$phone ORDER BY `notification_id` DESC");
            $querynotications=mysqli_query($conn,"SELECT * FROM `notification` WHERE `customers_phone`=$phone ORDER BY `notification_id` DESC");
            $querycustomer=mysqli_query($conn,"SELECT `customers_avatar` FROM `customers` WHERE `customers_phone`=$phone");
            $showavatar=mysqli_fetch_assoc($querycustomer);
        }else{
            header('Location:login.php');
        }
        if(isset($_SESSION['cart'])){
            $numbercart=sizeof($_SESSION['cart']);
            // var_dump($numbercart);exit;
        }else{
            $numbercart=0;
        }
    ?>
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
                    <div class="header-with-search">
                        <div class="header-width-search-flex">
                            <input type="text" class="header-with-search-input" placeholder="Nh???p ????? t??m ki???m s???n ph???m">
                            <button class="header-with-search-btn">
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
    <div class="app-account">
        <div class="app-account-notifi"></div>
        <div class="grid-account">
            <div class="app-account-space">
                <div class="grid-column-number-2">
                    <div class="account-navbar">
                        <div class="account-navbar-heading">
                            <div class="account-navbar-heading-image">
                                <?php if(!empty($showavatar['customers_avatar'])) { ?>
                                    <img src="uploads/<?php echo $showavatar['customers_avatar'] ;?>"
                                        alt="" class="account-navbar-heading-img">
                                <?php } else{ ?>
                                    <img src="./img/avatar.png"
                                        alt="" class="account-navbar-heading-img">
                                <?php } ?>
                            </div>
                            <div class="account-navbar-heading-text">
                                <div class="account-navbar-heading-name">
                                    beaxbox
                                </div>
                                <a href="" class="account-navbar-heading-link">
                                    <i class="fas fa-pencil-alt"></i>
                                    S???a h??? s??
                                </a>
                            </div>
                        </div>
                        <div class="account-navbar-container">
                            <div class="account-navbar-container-list">
                                <div class="account-navbar-container-flex">
                                    <a href="account.php" class="account-navbar-container-heading">
                                        <img src="https://cf.shopee.vn/file/ba61750a46794d8847c3f463c5e71cc4" alt=""
                                            class="account-navbar-container-image">
                                        <div class="account-navbar-container-heading-text">
                                            T??i kho???n c???a t??i
                                        </div>
                                    </a>

                                </div>
                                <div class="account-navbar-container-item">
                                    <div class="account-navbar-container-item-list">
                                        <a href="account.php" class="account-navbar-container-link">H??? s??</a>
                                    </div>
                                    <div class="account-navbar-container-item-list">
                                        <a href="password.php" class="account-navbar-container-link">?????i m???t kh???u</a>
                                    </div>
                                </div>
                            </div>
                            <div class="account-navbar-container-orther">
                                <a href="order.php" class="account-navbar-container-orther-link">
                                    <img src="https://cf.shopee.vn/file/f0049e9df4e536bc3e7f140d071e9078"
                                        class="account-navbar-container-image">
                                    <div class="account-navbar-container-orther-text">????n Mua</div>
                                </a>

                            </div>
                            <div class="account-navbar-container-notifition">
                                <a href="notification.php" class="account-navbar-container-notifition-link">
                                    <img src="https://cf.shopee.vn/file/e10a43b53ec8605f4829da5618e0717c"
                                        class="account-navbar-container-notify-img">
                                    <div class="account-navbar-container-notifition-text">Th??ng B??o</div>
                                </a>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="grid-column-number-10">
                    <div class="notification-big">
                        <div class="notification-flex">
                            <?php 
                                $dem=0;
                                while($shownotis=mysqli_fetch_assoc($querynotications)){ ?>
                            <a href="" class="notification-item">
                                <div class="notification-image">
                                    <img src="../uploads/<?php echo $shownotis['notification_img'] ;?>" alt=""
                                        class="notification-img">
                                </div>
                                <div class="notification-container">
                                    <div class="notification-title">
                                        <?php echo $shownotis['notification_title'] ;?>

                                    </div>
                                    <div class="notification-text">
                                    <?php echo $shownotis['notification_name'] ;?>
                                    </div>
                                    <div class="notification-time-big">
                                        <div class="notification-time">
                                            <div class="notification-time-now">
                                                <?php echo $shownotis['notification_date_start'] ;?>
                                            </div>
                                            <div class="notification-time-dealine">
                                                
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="notification-button-details">
                                    <button class="notification-button-details-btn">Xem chi ti???t</button>
                                </div>
                            </a>
                            <?php 
                                $dem=$dem+1; 
                                if($dem==15){
                                    break;
                                }
                            } ?>
                           
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="footer-brg-text">
        <div class="hr"></div>
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

</body>

</html>