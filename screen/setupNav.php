<?php

$personalSLink = FRONT_SITE.'/settings/users';

?>


<div class="content">
    <h4 class="navTitle">Setup</h4>
    <ul class="scrollBar">
        
        <li class="ganeralNav navMenu">
            <a class="navItem db" href="javascript:void(0)"><svg><use href="#arrowIcon"></use></svg> <span>General</span></a>
            <ul>
                <li class="personalSetting"><a href="<?= FRONT_SITE.'/settings/personal-settings' ?>">Personal Settings</a></li>
                <?= (checkWebsiteUserAccess() == 1) ? "<li class='users'><a href='$personalSLink'>Users</a></li>" : ''?>
                <li class="security"><a href="<?= FRONT_SITE.'/settings/security' ?>">Security</a></li>
            </ul>
        </li>

        <?php
        
            if(checkWebsiteUserAccess('',28) == 1){

                $frontSite = FRONT_SITE;
                echo '
                    <li class="hotelNav navMenu">
                        <a class="navItem db" href="javascript:void(0)">
                            <svg><use href="#arrowIcon"></use></svg> <span>Hotel</span>
                        </a>
                        <ul>
                            <li class="basicDetails"><a href="' . $frontSite . '/settings/basic-details">Basic Details</a></li>
                            <li class="amenities"><a href="' . $frontSite . '/settings/amenities">Amenities</a></li>
                            <li class="rooms"><a href="' . $frontSite . '/settings/rooms">Rooms</a></li>
                            <li class="services"><a href="' . $frontSite . '/settings/services">Services</a></li>
                            <li class="extracharge"><a href="' . $frontSite . '/settings/charge-amount">Extra Charges</a></li>
                            <li class="images"><a href="' . $frontSite . '/settings/image-public">All Image</a></li>
                            <li class="termsAndPolicy"><a href="' . $frontSite . '/settings/hotel-policy">Terms and policy</a></li>
                        </ul>
                    </li>
                
                    <li class="pmsNav navMenu">
                        <a class="navItem db" href="javascript:void(0)">
                            <svg><use href="#arrowIcon"></use></svg> <span>PMS</span>
                        </a>
                        <ul>
                            <li class="payment"><a href="' . $frontSite . '/settings/payment">Payment</a></li>
                        </ul>
                    </li>

                    <li class="posNav navMenu">
                        <a class="navItem db" href="javascript:void(0)">
                            <svg><use href="#arrowIcon"></use></svg> <span>POS</span>
                        </a>
                        <ul>
                            <li class="restaurant"><a href="' . $frontSite . '/settings/restaurant">Restaurant</a></li>
                            <li class="table"><a href="' . $frontSite . '/settings/table">Table</a></li>
                            <li class="food"><a href="' . $frontSite . '/settings/food">Food</a></li>
                        </ul>
                    </li>
                
                    <li class="beNav navMenu">
                        <a class="navItem db" href="javascript:void(0)">
                            <svg><use href="#arrowIcon"></use></svg> <span>BE</span>
                        </a>
                        <ul>
                            <li class="colors"><a href="' . $frontSite . '/settings/colors">Colors</a></li>
                            <li class="checkout"><a href="' . $frontSite . '/settings/checkout">Checkout</a></li>
                            <li class="gallery"><a href="' . $frontSite . '/settings/gallery">Gallery</a></li>
                        </ul>
                    </li>
                
                    
                ';
            }
        
        ?>
        

        <!-- <li class="customizeNav navMenu">
                        <a class="navItem db" href="javascript:void(0)">
                            <svg><use href="#arrowIcon"></use></svg> <span>Customization</span>
                        </a>
                        <ul>
                            <li class="emailTemplate"><a href="' . $frontSite . '/settings/email-template">Email</a></li>
                        </ul>
                    </li> -->
    </ul>
</div>