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
                            <li class="rooms"><a href="' . $frontSite . '/settings/rooms">Rooms</a></li>
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