<?php


    function gettingMail(){
        $brand = 'Retrod';
        $retrodLogo = FRONT_SITE_IMG.'retrod-logo.png';
        $thankYouImg = FRONT_SITE_IMG.'thank-you-vector.png';
        $fbIcon = FRONT_SITE_IMG.'icon/facebook.png';
        $inIcon = FRONT_SITE_IMG.'icon/instagram.png';
        $twIcon = FRONT_SITE_IMG.'icon/twitter.png';
        $liIcon = FRONT_SITE_IMG.'icon/linkedin.png';
        $yoIcon = FRONT_SITE_IMG.'icon/youtube.png';
        
        $retrodSite = 'https://retrodtech.com';
        $guestName = 'AVINAB GIRI';
        $contactUrl = '';
        $year = date('Y');
        $fullAddress = '441 - 4th Floor , Esplanade One Mall, Nexus Esplanade, Rasulgarh, Bhubaneswar, Odisha 751010';
        $gstNo = RETROD_GST;
        $termLink = 'https://retrodtech.com/';
        $policyLink = 'https://retrodtech.com/';
        $supportMail = 'support@retrodtech.com';
        $fbLink = 'https://www.facebook.com/RetrodTechnologies';
        $twLink = 'https://twitter.com/retrodtech';
        $inLink = 'https://www.instagram.com/retrod_tech';
        $liLink = 'https://www.linkedin.com/company/retrod-technologies/mycompany/';
        $yoLink = 'https://www.youtube.com/@retrodpodcast';
        $property = 'Vijoya';
        $addRoomUrl = '';

        $html = '
                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color:#f2f5f8;font-family:Arial,sans-serif;word-spacing:normal">
                    <tbody>
                        <tr>
                            <td>
                                <div style="max-width:600px;margin:0px auto;background-color:#f2f5f8">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="padding:20px 0"><a href="'.$retrodSite.'" target="_blank" >
                                                    <img src="'.$retrodLogo.'" style="text-align:center;max-width:140px" alt="'.$brand.'" vspace="0" hspace="0" align="absmiddle" ></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background-color:#fff;padding:20px 50px">
                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                        style="max-width:530px;margin:0 auto;text-align:center">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="padding:0">

                                                                    <p style="font-family:Avenir Next,Arial,sans-serif;line-height:25px;font-size:16px;color:#000;text-align:left;margin:20px 0 20px;padding:0">
                                                                        Hi <b>'.$guestName.'</b>, </p>

                                                                    <img src="'.$thankYouImg.'" style="text-align:center;max-width:75%;margin-bottom: 15px;" alt="'.$brand.' thank you image" vspace="0" hspace="0" align="absmiddle" >

                                                                    <p style="font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0">
                                                                        <b>'.$brand.'</b> wanted to express our sincere gratitude for trusting us as your partner. We are honored and committed to delivering excellent results.</p>
                                                                    <p style="font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0">
                                                                    We look forward to a <b>successful collaboration</b> and we are excited about the journey ahead.</p>
                                                                    <p style="font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0">
                                                                    Now let’s take a step forward in setting up your properly by adding rooms to your online booking engine <b>'.$property.'</b>.</p>

                                                                    <p style="font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0">
                                                                    Here are the following steps to do it.</p>

                                                                    <ul>
                                                                        <li style="text-align: left;"><a href="'.$addRoomUrl.'">Add Room</a></li>
                                                                    </ul>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding:0 50px 0px;border-top: 1px solid #bdbdbd;">&nbsp;</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding:10px">
                                                                    <p
                                                                        style="font-family:Avenir Next,Arial,sans-serif;line-height:20px;font-size:17px;color:#000;text-align:left;padding:0;text-align:center">
                                                                        Any Queries? Learn more in <a href="'.$contactUrl.'" style="color:#3478f6;text-decoration:none;font-weight: 700" target="_blank"> Contact Us</a></p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background-color:#f7f9fc;padding:20px 50px">
                                                    <table width="100%" align="center" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="vertical-align:top">
                                                                    <table cellspacing="0" cellpadding="0" border="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="vertical-align:top;padding-right:5px"><p style="text-align:center;">
                                                                                    <a href="'.$policyLink.'" style="color:black;text-decoration:none;font-weight:600;font-size:13px" target="_blank">Privacy Policy</a> 
                                                                                    <span style="font-size:20px;font-weight:700">&nbsp;⋅&nbsp;</span> 
                                                                                    <a href="'.$termLink.'" style="color:black;text-decoration:none;font-weight:600;font-size:13px" target="_blank">Terms &amp; Conditions</a> 
                                                                                    <span style="font-size:20px;font-weight:700">&nbsp;⋅&nbsp;</span>
                                                                                    <a href="mailto:'.$supportMail.'" style="color:black;text-decoration:none;font-weight:600;font-size:13px" target="_blank">Support</a> </p>
                                                                                    <div style="text-align:center"> 
                                                                                        <a style="text-decoration:none" href="'.$inLink.'" target="_blank">
                                                                                            <img width="24" height="24" src="'.$inIcon.'" alt="instagram" data-bit="iit"> </a> &nbsp;
                                                                                        <a style="text-decoration:none" href="'.$fbLink.'" target="_blank">
                                                                                            <img width="24" height="24" src="'.$fbIcon.'" alt="facebook" data-bit="iit"> </a> &nbsp; 
                                                                                        <a style="text-decoration:none" href="'.$twLink.'" target="_blank">
                                                                                            <img width="24" height="24" src="'.$twIcon.'" alt="twitter" data-bit="iit"> </a> &nbsp; 
                                                                                        <a style="text-decoration:none" href="'.$yoLink.'" target="_blank">
                                                                                            <img width="24" height="24" src="'.$yoIcon.'" alt="youtube" data-bit="iit"> </a> &nbsp; 
                                                                                        <a style="text-decoration:none" href="'.$liLink.'" target="_blank">
                                                                                            <img width="24" height="24" src="'.$liIcon.'" alt="linkedin" data-bit="iit"> 
                                                                                        </a> 
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <footer style="padding:5px 16px 20px 16px;background-color:#f2f5f8">
                                        

                                        <p style="font-weight:500;font-size:11px;color:#757779;text-align:center;padding:15px 0 0">
                                            Copyrights ©'.$year.', '.$brand.' Private Limited, All Rights Reserved. Registered Office - '.$fullAddress.' | GST '.$gstNo.'. 
                                        </p>
                                        <p style="text-align:center;color:#757779;font-size:13px;font-weight:600;border-top:1px solid #bdbdbd;padding-top:20px">
                                            '.$brand.'
                                        </p>
                                    </footer>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
        ';

        return $html;
    }
    
    function generateMailSocialMedia(){
        global $hotelId;
        $smHtml = '';
        foreach(getHotelSocialLinkData('',$hotelId) as $item){
            $name = $item['name'];
            $link = $item['link'];
            $icon = $item['icon'];
            $color = $item['color'];
            $bgClr = $item['bgClr'];
            $img = $item['img'];
            $imgHtml = FRONT_SITE_IMG.'icon/'.$img;

            $smHtml .= "<a style='text-decoration:none' href='$link' target='_blank'><img width='24' height='24' src='$imgHtml'></a> ";
        }

        return $smHtml;
    }

    function generateInvoice($type,$gname,$bid){
        $reviewsImg = FRONT_SITE_IMG.'icon/google-review.png';        
        $bookDetailImg = FRONT_SITE_IMG.'icon/book-detail-btn.jpg';        
        $guestName = $gname;
        $year = date('Y');
        $addRoomUrl = '';
        
        $hotelData = hotelDetail();
        $brand = ucfirst($hotelData['hotelName']);
        $propertyLogo = $hotelData['fullKotLogoUrl'];
        $address = $hotelData['address'];
        $city = $hotelData['city'];
        $pincode = $hotelData['pincode'];
        $state = $hotelData['state'];
        $fullAddress = "$address, $city, $state, $pincode";
        $hotelPhoneNum = $hotelData['hotelPhoneNum'];
        $website = $hotelData['website'];
        $supportMail = $hotelData['hotelEmailId'];
        $gstNo = RETROD_GST;
        $pageLinkArray = getHotelPageLink()[0];
        $contactUrl = $pageLinkArray['contactPage'];
        $termLink = $pageLinkArray['hotelPolicy'];
        $policyLink = $pageLinkArray['hotelPolicy'];

        $bookingDetailArray = getBookingData($bid)[0];
        $guestAmendArray = guestAmendReport('','',$bid);

        $checkin = (isset($bookingDetailArray['checkIn']) && $bookingDetailArray['checkIn'] != '') ? date('d M, Y', strtotime($bookingDetailArray['checkIn'])) : '';
        $checkinTime = (isset($guestAmendArray['checkInTime']) && $guestAmendArray['checkInTime'] != '') ? date('h:i A', strtotime($guestAmendArray['checkInTime'])) : '';

        $checkOut = ($bookingDetailArray['checkOut'] != '') ? date('d M, Y', strtotime($bookingDetailArray['checkOut'])) : '';
        $checkOutTime = (isset($guestAmendArray['checkOutTime']) && $guestAmendArray['checkOutTime'] != '') ? date('h:i A', strtotime($guestAmendArray['checkOutTime'])) : ''; 
        $bookingTime = (isset($guestAmendArray['add_on']) && $guestAmendArray['add_on'] != '') ? date('d M Y, h:i A', strtotime($guestAmendArray['add_on'])) : ''; 
        $roomNum = $bookingDetailArray['room_number'];
        $reviewButton = "<a target='_blank' href=''><img style='width:80%' src='$reviewsImg'/></a>";

        $bDFillLink = GUEST_QR_CODE.'?id='.customEncodeBase64($bookingDetailArray['bookinId']);
        $bookingDetailsFillLink = "<a target='_blank' href='$bDFillLink'><img style='width:80%' src='$bookDetailImg'/></a>";

        $socialMediaHtml = generateMailSocialMedia();

        $databaseString = mailInvoiceData($type);

        $mainContent = preg_replace_callback('/\{([^}]+)\}/', function($matches) use ($brand,$checkin,$checkinTime,$roomNum,$checkOut,$checkOutTime,$city,$reviewButton,$bookingTime,$bookingDetailsFillLink) {
            return isset($matches[1]) ? eval('return $'. $matches[1] . ';') : $matches[0];  
        }, $databaseString);

        $html = "
        
        <table width='100%' cellspacing='0' cellpadding='0' border='0' align='center'
            style='background-color:#f2f5f8;font-family:Arial,sans-serif;word-spacing:normal'>
            <tbody>
                <tr>
                    <td>
                        <div style='max-width:600px;margin:0px auto;background-color:#f2f5f8'>
                            <table width='100%' cellspacing='0' cellpadding='0'>
                                <tbody>
                                    <tr>
                                        <td align='center' style='padding:20px 0'><a href='$website' target='_blank'>
                                                <img src='$propertyLogo' style='text-align:center;max-width:140px'
                                                    alt='$brand' vspace='0' hspace='0' align='absmiddle'></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='background-color:#fff;padding:20px 50px'>
                                            <table width='100%' cellpadding='0' cellspacing='0'
                                                style='max-width:530px;margin:0 auto;text-align:center'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center' style='padding:0'>
        
                                                            <p
                                                                style='font-family:Avenir Next,Arial,sans-serif;line-height:25px;font-size:16px;color:#000;text-align:left;margin:20px 0 20px;padding:0'>
                                                                Hi <b>$guestName</b>, </p>
                                                            $mainContent
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center'
                                                            style='padding:0 50px 0px;border-top: 1px solid #bdbdbd;'>&nbsp;
                                                        </td>
                                                    </tr>
        
                                                    <tr>
                                                        <td style='padding:10px'>
                                                            <p
                                                                style='font-family:Avenir Next,Arial,sans-serif;line-height:20px;font-size:17px;color:#000;text-align:left;padding:0;text-align:center'>
                                                                Any Queries? Learn more in <a href='$contactUrl'
                                                                    style='color:#3478f6;text-decoration:none;font-weight: 700'
                                                                    target='_blank'> Contact Us</a></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='background-color:#f7f9fc;padding:20px 50px'>
                                            <table width='100%' align='center' cellpadding='0' cellspacing='0'>
                                                <tbody>
                                                    <tr>
                                                        <td style='vertical-align:top'>
                                                            <table cellspacing='0' cellpadding='0' border='0' align='center'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style='vertical-align:top;padding-right:5px'>
                                                                            <p style='text-align:center;'>
                                                                                <a href='$policyLink' style='color:black;text-decoration:none;font-weight:600;font-size:13px' target='_blank'>Privacy Policy</a>
                                                                                                                                                    
                                                                                <a href='$termLink' style='color:black;text-decoration:none;font-weight:600;font-size:13px' target='_blank'>Terms &amp; Conditions</a>
                                                                             
                                                                                <a href='mailto:$supportMail' style='color:black;text-decoration:none;font-weight:600;font-size:13px' target='_blank' >Support</a>
                                                                            </p>
                                                                            <div style='text-align:center'>
                                                                                $socialMediaHtml
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
        
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <footer style='padding:5px 16px 20px 16px;background-color:#f2f5f8'>
        
        
                                <p style='font-weight:500;font-size:11px;color:#757779;text-align:center;padding:15px 0 0'>
                                    Copyrights ©$year, $brand Private Limited, All Rights Reserved. Registered Office -
                                    $fullAddress | GST $gstNo.
                                </p>
                                <p
                                    style='text-align:center;color:#757779;font-size:13px;font-weight:600;border-top:1px solid #bdbdbd;padding-top:20px'>
                                    $brand
                                </p>
                            </footer>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        ";

        return $html;
    }

    function paymentLinkMail($payAmount,$invoiceNum,$expireTime,$paymentLink){
        $expireMt = 20;
        $hotelDetailArry = hotelDetail();
        $logo = $hotelDetailArry['fullDarklogoUrl'];
        $hotelPhoneNum = $hotelDetailArry['hotelPhoneNum'];
        $hotelName = $hotelDetailArry['hotelName'];
        $fontFamily = 'font-family:Cera Round Pro,Proxima Nova Soft,Proxima Nova,Helvetica Neue,Helvetica,Arial,sans-serif';
        $payicon = FRONT_SITE_IMG.'credit-card.gif';
        $titleText = "You've requested a payment.";
        $firstParagraph = "We would like to inform you that a payment of Rs $payAmount for the $invoiceNum";
        $secondParagraph = "To facilitate the payment process, you can click on the secure payment link ";
        $thardParagraph = ", button.";
        $footerTitle = "Why are we sending you this?";
        $footerText = "Please ensure that the payment is expire on $expireMt minute, made on or before <strong>$expireTime</strong>. If you encounter any issues or have questions about the payment, feel free to reach out to us at <strong>$hotelPhoneNum</strong>.";
        $alertMsg = "Youre receiving this email because a payment was requested for $hotelName.";

        $html = '
            <table style="margin:0;background:#f0f1f3;border-collapse:collapse;border-spacing:0;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;height:100%;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                <tbody>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td align="center" valign="top" style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                            <center style="width:100%">
                                <table align="center" style="margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td height="24"style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:24px;font-weight:400;line-height:24px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                &nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="center" style="margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                            <td style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                <table align="center" style="margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th style="margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0 auto;padding:0;padding-bottom:16px;padding-left:0;padding-right:0;text-align:left;vertical-align:top;width:601px;word-wrap:break-word">
                                                                            <table role="presentation"
                                                                            style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                            <tbody>
                                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                                <th
                                                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                                    <h1
                                                                                    style="margin:0;margin-bottom:10px;color:inherit;'.$fontFamily.';font-size:24px;font-weight:600;letter-spacing:5px;line-height:1.5;margin:0;margin-bottom:0;padding:0;text-align:center;word-wrap:normal">
                                                                                    <img width="400" height="73"
                                                                                        src="'.$logo.'"
                                                                                        alt="'.$hotelName.'"
                                                                                        style="clear:none;display:inline-block;height:73px;max-width:100%;outline:0;text-decoration:none;vertical-align:middle;width:400px">
                                                                                    </h1>
                                                                                </th>
                                                                                <th
                                                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0!important;text-align:left;vertical-align:top;width:0;word-wrap:break-word">
                                                                                </th>
                                                                                </tr>
                                                                            </tbody>
                                                                            </table>
                                                                        </th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table align="center" style="margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td
                                            style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                            <table align="center" style="margin:0 auto;background:#fff;border-collapse:collapse;border-radius:16px;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td
                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    <table style="border-collapse:collapse;border-spacing:0;border-top-left-radius:16px;border-top-right-radius:16px;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0 auto;padding:0;padding-bottom:32px;padding-left:42px;padding-right:42px;text-align:left;vertical-align:top;width:538px;word-wrap:break-word">
                                                            <table role="presentation"
                                                            style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                            <tbody>
                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                <th
                                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                    <table role="presentation"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <td height="42"
                                                                            style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:42px;font-weight:400;line-height:42px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                            &nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                    <center style="width:100%">
                                                                    <img height="100" width="100"
                                                                        src="'.$payicon.'"
                                                                        alt="" align="center"
                                                                        style="margin:0 auto;clear:both;display:block;float:none;height:100px;margin:0 auto;max-width:100%;outline:0;text-align:center;text-decoration:none;width:100px">
                                                                    <h2 align="center"
                                                                        style="margin:0;margin-bottom:10px;color:inherit;'.$fontFamily.';font-size:28px;font-weight:700;line-height:1.5;margin:0;margin-bottom:10px;margin-top:1em;padding:0;text-align:center;word-wrap:normal">
                                                                        '.$titleText.'
                                                                    </h2>
                                                                    </center>
                                                                </th>
                                                                <th
                                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0!important;text-align:left;vertical-align:top;width:0;word-wrap:break-word">
                                                                </th>
                                                                </tr>
                                                            </tbody>
                                                            </table>
                                                        </th>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    <table style="border-bottom-left-radius:16px;border-bottom-right-radius:16px;border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0 auto;padding:0;padding-bottom:32px;padding-left:42px;padding-right:42px;text-align:left;vertical-align:top;width:538px;word-wrap:break-word">
                                                            <table role="presentation"
                                                            style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                            <tbody>
                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                <th
                                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                    <table role="presentation"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="margin:0;border-bottom:3px solid #f0f1f3;border-collapse:collapse!important;border-left:0;border-right:0;border-top:0;box-sizing:border-box;clear:both;color:#183153;'.$fontFamily.';font-size:0;font-weight:400;height:0;line-height:0;margin:0;padding:0;padding-bottom:0;padding-top:0;text-align:center;vertical-align:top;width:580px;word-wrap:break-word">
                                                                            &nbsp;</th>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                    <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <td height="42" style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:42px;font-weight:400;line-height:42px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                            &nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                    <p style="margin:0;margin-bottom:10px;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    '.$firstParagraph.'
                                                                    </p>

                                                                    <p style="margin:0;margin-bottom:10px;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    '.$secondParagraph.'
                                                                    <a href="'.$paymentLink.'" style="margin:default;color:#183153;'.$fontFamily.';font-weight:700;line-height:1.5;margin:default;padding:0;text-align:left;text-decoration:underline"
                                                                        target="_blank">Pay Now</a>
                                                                    '.$thardParagraph.'
                                                                    </p>
                                                                    <p style="margin:0;margin-bottom:10px;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    </p>
                                                                </th>
                                                                <th style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0!important;text-align:left;vertical-align:top;width:0;word-wrap:break-word"></th>
                                                                </tr>
                                                            </tbody>
                                                            </table>
                                                        </th>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <th style="margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0 auto;padding:0;padding-bottom:32px;padding-left:42px;padding-right:42px;text-align:left;vertical-align:top;width:538px;word-wrap:break-word">
                                                            <table  style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                            <tbody>
                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                <th
                                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                    <table role="presentation"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <th
                                                                            style="margin:0;border-bottom:3px solid #f0f1f3;border-collapse:collapse!important;border-left:0;border-right:0;border-top:0;box-sizing:border-box;clear:both;color:#183153;'.$fontFamily.';font-size:0;font-weight:400;height:0;line-height:0;margin:0;padding:0;padding-bottom:0;padding-top:0;text-align:center;vertical-align:top;width:580px;word-wrap:break-word">
                                                                            &nbsp;</th>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                    <table role="presentation"
                                                                    style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                                    <tbody>
                                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                                        <td height="42"
                                                                            style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:42px;font-weight:400;line-height:42px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                            &nbsp;</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    </table>
                                                                    <p
                                                                    style="margin:0;margin-bottom:10px;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    <strong>'.$footerTitle.'</strong></p>
                                                                    <p
                                                                    style="margin:0;margin-bottom:10px;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                                    '.$footerText.'
                                                                    </p>
                                                                </th>
                                                                <th style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0!important;text-align:left;vertical-align:top;width:0;word-wrap:break-word">
                                                                </th>
                                                                </tr>
                                                            </tbody>
                                                            </table>
                                                        </th>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="center" role="presentation"
                                style="margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td height="50" style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:50px;font-weight:400;line-height:50px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                            &nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="center" role="presentation"
                                style="margin:0 auto;background-color:#f0f1f3;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:95%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td
                                            style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                            <table align="center" style="margin:0 auto;background:0 0;border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                <td
                                                    style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:16px;font-weight:400;line-height:1.5;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                    <table role="presentation"
                                                    style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                                                    <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                        <td>
                                                            <center style="width:100%">
                                                            <p align="center" style="margin:0;margin-bottom:10px;color:#8991a5;'.$fontFamily.';font-size:.9rem;font-weight:400;line-height:1.5;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                                '.$alertMsg.'
                                                            </p>
                                                            </center>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table align="center" style="margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                                    <tbody>
                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                        <td height="32" style="margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#183153;'.$fontFamily.';font-size:32px;font-weight:400;line-height:32px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                            &nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        ';

        return $html;
    }
    
    function posInvoice($invoceNo='',$resnmae='', $data=[],$totalPro='',$tax='',$total='',$paid=''){
        global $hotelId;
        $hotelDetailArry =  hotelDetail('','','','',$hotelId);
        
        $address = $hotelDetailArry['address'].', '.$hotelDetailArry['city'].', '.$hotelDetailArry['state'].', '.$hotelDetailArry['pincode'];
        $gst = $hotelDetailArry['gst'];
        $pan = $hotelDetailArry['pan'];
        $hsn = $hotelDetailArry['hsn'];
        $fullKotLogoUrl = $hotelDetailArry['fullKotLogoUrl'];
        $fullFaviconUrl = $hotelDetailArry['fullFaviconUrl'];
        $productHtml = '';
        $totalItem = count($data);

        $sn = 0;
        foreach($data as $item){
            $sn ++;
            $proName = $item['proName'];
            $qty = $item['qty'];
            $proPrice = $item['proPrice'] * $qty;
            $serial = getNumberFormat($sn,2);
            $productHtml .= '
                    <tr style="font-size: 14px;border-top: 1px dashed #ddd;">
                        <td style="padding: 14px 0;">'.$serial.'</td>
                        <td style="padding: 14px 0;">'.$proName.'</td>
                        <td style="padding: 14px 0;">'.$qty.'</td>
                        <td style="text-align: right; text-align: right;">&#8377; '.$proPrice.'</td>
                    </tr>
            ';
        }

        $html = '
                <!DOCTYPE html>
                <html>
                
                    <head>
                        <meta charset="utf-8" />
                        <title>Invoice</title>
                        <link rel="shortcut icon" type="image/png" href="'.$fullFaviconUrl.'" />
                        <style>
                            * {
                                box-sizing: border-box;
                            }
                            
                    
                            body {
                                font-family: Arial, Helvetica, sans-serif;
                                margin: 0;
                                padding: 0;
                                font-size: 16px;
                            }
                            
                            .h4-14 h4 {
                                font-size: 12px;
                                margin-top: 0;
                                margin-bottom: 5px;
                            }
                    
                            td,
                            th {
                                text-align: left;
                                padding: 8px 6px;
                            }
                    
                            .table-b td,
                            .table-b th {
                                border: 1px solid #ddd;
                            }
                            
                            
                            .main-pd-wrapper {
                                box-shadow: 0 0 10px #ddd;
                                background-color: #fff;
                                border-radius: 10px;
                                padding: 15px;
                            }
                            
                        </style>
                    </head>
                    
                    <body>
                        <section class="main-pd-wrapper" style="width: 450px; margin: auto">
                            <table style="width: 100%;border-collapse: collapse;padding: 1px;">
                                <tr>
                                    <td style="text-align: center;"><img style="height: 115px;width: auto;" src="'.$fullKotLogoUrl.'" alt=""></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px; margin: 0;">
                                            '.$resnmae.'
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="margin: 0;">
                                            '.$address.'
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="margin: 0;">
                                            <b>GSTIN:</b> '.$gst.'
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="margin: 0;">
                                            <b>Pan:</b> '.$pan.'
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="margin: 0;">
                                            <b>HSN. :</b> '.$hsn.'
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
                    
                            <table style="width: 100%; table-layout: fixed;width: 100%;border-collapse: collapse;padding: 1px;">
                                <thead>
                                    <tr>
                                        <th style="width: 50px; padding-left: 0;">Sn.</th>
                                        <th style="width: 220px;">Item Name</th>
                                        <th>QTY</th>
                                        <th style="text-align: right; padding-right: 0;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    '.$productHtml.'
                                </tbody>
                            </table>
                    
                            <table style="width: 100%;background: #fcbd024f;border-radius: 4px;">
                                <thead>
                                    <tr>
                                        <th>Sub Total</th>
                                        <th style="text-align: center;">Item ('.$totalItem.')</th>
                                        <th>&nbsp;</th>
                                        <th style="text-align: right;">&#8377; '.$totalPro.'</th>
                    
                                    </tr>
                                </thead>
                    
                            </table>
                    
                            <table style="width: 100%;margin-top: 15px;border: 1px dashed #00cd00;border-radius: 3px;">
                                <thead>
                                    <tr>
                                        <td>Tax: </td>
                                        <td style="text-align: right;">&#8377; '.$tax.'</td>
                                    </tr>
                                    <tr>
                                        <td>Total: </td>
                                        <td style="text-align: right;">&#8377; '.$total.'</td>
                                    </tr>
                                    <tr>
                                        <td>Settlement Amount: </td>
                                        <td style="text-align: right;">&#8377; '.$paid.'</td>
                                    </tr>
                                </thead>
                    
                            </table>
                    
                        </section>
                    </body>
                
                </html>
        ';

        return $html;
    }

    function viewPosInvoice($invoceNo='',$resnmae='', $data=[],$totalPro='',$tax='',$total='',$paid=''){
        global $hotelId;
        $hotelDetailArry =  hotelDetail('','','','',$hotelId);
        
        $address = $hotelDetailArry['address'].', '.$hotelDetailArry['city'].', '.$hotelDetailArry['state'].', '.$hotelDetailArry['pincode'];
        $gst = $hotelDetailArry['gst'];
        $pan = $hotelDetailArry['pan'];
        $hsn = $hotelDetailArry['hsn'];
        $fullKotLogoUrl = $hotelDetailArry['fullKotLogoUrl'];
        $fullFaviconUrl = $hotelDetailArry['fullFaviconUrl'];
        $productHtml = '';
        $totalItem = count($data);

        $sn = 0;
        foreach($data as $item){
            $sn ++;
            // $proName = $item['proName'];
            // $qty = $item['qty'];
            // $proPrice = $item['proPrice'] * $qty;
            // $serial = getNumberFormat($sn,2);
            $productHtml .= '
                    <tr class="sectionGroupItem">
                        <td style="white-space:nowrap !important;text-align:center;">
                            <div class="checker"><span>
                                    <div class="checker" id="uniform-chkTableItemChild_31_67"><span><input
                                                id="chkTableItemChild_31_67" name="chkTableItemChild_31_67"
                                                class="form-control" type="checkbox"
                                                onclick="ClickChildCheckbox();"></span></div>
                                </span></div>
                        </td>
                        <td style="white-space:nowrap !important;">BACARDI LEMON 750 ML</td>
                        <td style="white-space:nowrap !important;text-align:right;">1100.00</td>
                        <td style="white-space:nowrap !important;text-align:center;">1</td>
                        <td style="white-space:nowrap !important;text-align:right;" class="inputItemAmount">
                            1100.00</td>
                        <td style="white-space:nowrap !important;text-align:right;" class="inputItemDiscount">
                            0.00</td><input type="hidden" class="inputItemId" value="31"><input type="hidden"
                            class="inputItemVariantId" value="67"><input type="hidden"
                            class="inputItemHiddenDiscount" value="0"><input type="hidden"
                            class="inputItemHiddenDiscountAfterTax" value="0">
                    </tr>
            ';
        }

        $html = '
            <div class="row">
                <div class="col-md-6">
                    <p id="orderInvoiceTableRoomNumber"><strong>Table # : </strong><span
                            id="spanOrderDetailTableNumber">15</span></p>
                    <p><strong>Steward : </strong><span id="spanOrderDetailCaptain"></span></p>
                    <p><strong>Start Time : </strong><span id="spanOrderDetailStartDate">05:39 PM</span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Guest Name : </strong><span id="spanOrderDetailGuestName"></span></p>
                    <p><strong>Mobile : </strong><span id="spanOrderDetailMobile"></span></p>
                    <p><strong>PAX : </strong><span id="spanOrderDetailPax">0</span></p>
                </div>
            </div>
            <div id="section-order-bill-detail" class="grid-aea table-responsive">
                <table class="table order-summary nowhitespace">
                    <tbody>
                        <tr>
                            <td colspan="6" style="white-space:nowrap !important;">
                                <div class="row"><label class="col-md-3" style="margin-top:7px;">Invoice
                                        Date</label>
                                    <div class="col-md-3"><input class="form-control input-nothing date-picker"
                                            data-date-format="dd/mm/yyyy" id="inputBillDetailInvoiceDate"
                                            maxlength="10" placeholder="DD/MM/YYYY" type="text" value="25/01/2024"
                                            readonly=""></div>
                                    <div class="col-md-3">
                                        <div class="input-group input-append bootstrap-timepicker"><input
                                                class="form-control input-nothing time-picker"
                                                id="inputBillDetailInvoiceTime" maxlength="8" placeholder="HH:MM"
                                                style="padding:6px 5px!important" type="text" value="07:03 PM"
                                                readonly=""><span class="input-group-addon add-on"><i
                                                    class="fa fa-clock-o"></i></span></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="2%" style="white-space:nowrap !important;text-align:center;">
                                <div class="checker"><span>
                                        <div class="checker" id="uniform-chkTableItemMaster"><span><input
                                                    id="chkTableItemMaster" name="chkTableItemMaster"
                                                    class="form-control" type="checkbox"
                                                    onclick="ClickMasterCheckbox();"></span></div>
                                    </span></div>
                            </td>
                            <td width="35%" style="white-space:nowrap !important;"><strong>Items</strong></td>
                            <td width="15%" align="right" style="white-space:nowrap !important;">
                                <strong>Rate</strong></td>
                            <td width="15%" align="center" style="white-space:nowrap !important;">
                                <strong>Qty.</strong></td>
                            <td width="15%" align="right" style="white-space:nowrap !important;">
                                <strong>Amt.</strong></td>
                            <td width="18%" align="right" style="white-space:nowrap !important;">
                                <strong>Disc</strong></td>
                        </tr>
                        '.$productHtml.'
                        <tr>
                            <td style="white-space:nowrap !important;text-align:right;font-weight:bold;"
                                colspan="5">Sub-Total Amount</td>
                            <td style="white-space:nowrap !important;text-align:right;font-weight:bold;"
                                id="inputSubTotalAmount">1100.00</td>
                        </tr>
                        <tr class="sectionRowDiscount">
                            <td style="white-space:nowrap !important;"></td>
                            <td colspan="2" style="white-space:nowrap !important;"><input
                                    id="inputInvoiceDiscountRemarks" type="text" class="form-control"
                                    placeholder="Remarks" style="display: none;"></td>
                            <td style="white-space:nowrap !important;text-align:right;font-weight:bold;"
                                colspan="2">Discount<div id="sectionBillDiscount"
                                    class="input-group input-bill-discount input-append" style="display: none;">
                                    <input type="text" id="inputBillDiscount" value="0"
                                        class="form-control input-decimal-no-minus"
                                        onblur="CalculateDiscount();"><span
                                        class="input-group-addon add-on">%</span></div><small
                                    id="sectionBillFixedDiscount" style="display:none;font-weight:normal;">
                                    <div class="checker"><span>
                                            <div class="checker" id="uniform-inputPOSBillFixedDisc"><span><input
                                                        id="inputPOSBillFixedDisc" name="inputPOSBillFixedDisc"
                                                        class="form-control" type="checkbox"
                                                        onclick="OpenCloseFixedDisc();"></span></div>
                                        </span></div>Fixed Discount Amount
                                </small></td>
                            <td style="white-space:nowrap !important;text-align:right;font-weight:bold;"><input
                                    id="inputTotalDiscount" value="0.00" class="form-control input-decimal"
                                    onblur="OnBlurFixedDisc()"
                                    style="border:0;text-align:right;padding:0!important;background-color:#fff;"
                                    readonly=""></td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap !important;text-align:right;font-weight:bold;font-size:14px"
                                colspan="5">Total Amount</td>
                            <td style="white-space:nowrap !important;text-align:right;font-weight:bold;font-size:14px"
                                id="inputTotalAmount">1100.00</td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap !important;text-align:right;" colspan="6">
                                <div class="col-md-4 text-left">
                                    <div class="checker"><span>
                                            <div class="checker" id="uniform-chkSplitLiquorBill"><span
                                                    class="checked"><input id="chkSplitLiquorBill"
                                                        name="chkSplitLiquorBill" class="form-control"
                                                        type="checkbox" checked=""></span></div>
                                        </span></div> Split Liquor Bill
                                </div>
                                <div class="col-md-8"><a href="javascript:;" class="btn btn-success mr-5"
                                        onclick="SaveOrderBill(31047);">Create Bill</a><a href="javascript:;"
                                        class="btn btn-info" onclick="SaveOrderBill(31047, true);">Create &amp;
                                        Print Bill</a></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        ';

        return $html;
    }

    function blankGRC(){
        $html = '
            <tr>
                <td align="center" valign="top" style="padding:5px 10px; border-bottom:#000 1px solid;border-left:#000 1px solid;border-right:#000 1px solid;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tbody>
                            <tr>
                                <td align="left" valign="bottom" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;  padding-bottom:2px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="bottom" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;">Reservation No.:</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" valign="bottom" width="40%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold;  padding-top:0px;">GUEST REGISTRATION FORM</td>
                                <td align="right" valign="bottom" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;  padding-bottom:2px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="right" valign="bottom" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-top:0px;padding-right:120px;">Date: </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:0 10px; border-bottom:#000 1px solid;border-left:#000 1px solid;border-right:#000 1px solid;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" width="60%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;" colspan="2">GUEST INFORMATION</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Guest Name:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Phone Number:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Email:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Address:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" valign="top" width="40%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Nationality:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Gender:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">DOB:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">ID:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">VIP:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:0 10px; border-bottom:#000 1px solid;border-left:#000 1px solid;border-right:#000 1px solid;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" width="60%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;" colspan="2">STAY INFORMATION</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Booked On:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Arrival:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Departure:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">No. Of Rooms:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Booking Ref. #:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" valign="top" width="40%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;" colspan="2">BILLING INFORMATION</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Billing Mode:</td>
                                                <td align="left" valign="top" width="70%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Organisation:</td>
                                                <td align="left" valign="top" width="70%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">GST:</td>
                                                <td align="left" valign="top" width="70%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Business Source:</td>
                                                <td align="left" valign="top" width="70%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:0 10px; border-bottom:#000 1px solid;border-left:#000 1px solid;border-right:#000 1px solid;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" width="60%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;" colspan="2">ROOM DETAILS</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Room Type:</td>
                                                <td align="left" valign="top" width="70%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Room No.:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Room Plan:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" valign="top" width="40%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;" colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Adult:</td>
                                                <td align="left" valign="top" width="70%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Child:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Room Rate:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        ';

        return $html;
    }

    function invoice($bid){
        $hotelData = hotelDetail();
        $gstNo = $hotelData['gst'];
        $panNo = $hotelData['pan'];
        $bookingFolioArray = filterBookingFolio($bid,'','Room Charge');
        $bookingArray = getBookingDetailById($bid);

        $guestArry = $bookingArray['guestArray'][0];
        $guestName = $guestArry['name'];
        $gcountry = $guestArry['country'];
        $gstate = $guestArry['state'];
        $gcity = $guestArry['city'];
        $address = "$gcity  $gstate  $gcountry";
        $invoiceNo = generateInvoiceNum($bid);
        $reciptNo = threeNumberFormat($bookingArray['reciptNo']);
        $add_on = date('d-M-Y', strtotime($bookingArray['add_on']));
        $roomNum = $bookingArray['roomNum'];
        $checkIn = date('d-M-Y', strtotime($bookingArray['checkIn']));
        $checkOut = date('d-m-Y', strtotime($bookingArray['checkOut']));
        $night = $bookingArray['night'];
        $totalAdult = $bookingArray['totalAdult'];
        $totalChild = $bookingArray['totalChild'];
        $pax = $totalAdult + $totalChild;

        $roomDetailArry = $bookingArray['roomDetailArry'][0];
        $planType = $roomDetailArry['rateplan'][0];
        $folioHtml ='';

        $totalCharge = 0;
        $totalRecive = 0;

        foreach($bookingFolioArray as $folioitem){
            $chargeDate = date('d-M-Y', strtotime($folioitem['chargeDate']));
            $bid = $folioitem['bid'];
            $bdId = $folioitem['bdId'];

            $particulars = $folioitem['particulars'];
            $charged = $folioitem['charged'];
            $received = $folioitem['received'];
            $balance = $folioitem['balance'];

            if($bdId != ''){
                $roomNum = getBookingDetail($bid,$bdId)[0]['room_number'];
                $gst = $folioitem['gst'];

                $folioHtml .= '
                    <tr>
                        <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px;">'.$chargeDate.'</td>
                        <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:center;">'.$roomNum.'</td>
                        <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px;">'.$particulars.'</td>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:right;">'.$charged.'</td>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:right;">'.$received.'</td>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:right;"></td>
                    </tr>
                ';

                foreach($gst as $key=>$val){
                    $folioHtml .= '
                        <tr>
                            <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px;"></td>
                            <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px 0 15px; text-align:center;"></td>
                            <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px;">'.$key.'</td>
                            <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:right;">'.$val.'</td>
                            <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:right;">0</td>
                            <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding:1px 5px; text-align:right;"></td>
                        </tr>
                    ';
                }
            }

            if(!isset($folioitem['bid'])){
                $totalCharge += $charged;
                $totalRecive += $received;
                $folioHtml .= '
                
                    <tr>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px;" colspan="4">'.$particulars.'</td>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px; text-align:right;">'.$charged.'</td>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px; text-align:right;">'.$received.'</td>
                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px; text-align:right;">'.$balance.'</td>
                    </tr>
                ';

            }
        }

        $totalBalance = $totalCharge - $totalRecive;
        $gstPrice = getGSTPrice($totalCharge);
        $netAmount = $totalCharge - $gstPrice;
        $halfGst = $gstPrice / 2;
        $gstPercentage = getGSTPercentage($totalCharge);
        $halfPer = $gstPercentage / 2;

        $roundOff = $totalRecive - $totalCharge;
        $amountInWord = convertNumberToWords($totalRecive);
        $html = '
            <tr>
                <td align="center" valign="top" style="padding:0 10px; border-bottom:#000 4px solid;border-left:#000 1px solid;border-right:#000 1px solid;border-bottom-style:double">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" width="40%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">GST : '.$gstNo.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;">PAN : '.$panNo.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="center" valign="bottom" width="20%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold;text-transform: uppercase;">TAX INVOICE</td>
                                <td align="right" valign="bottom" width="40%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                        <tbody>
                                            <tr>
                                                <td align="right" valign="bottom" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;">ORIGINAL FOR RECIPIENT</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" valign="top" style="padding:5px 10px; border-bottom:#000 4px solid;border-left:#000 1px solid;border-right:#000 1px solid;border-bottom-style:double;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tbody>
                            <tr>
                                <td align="left" valign="top" width="60%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Invoice No.:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$invoiceNo.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" width="25%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Reservation No.:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$reciptNo.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;">Guest Name:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding-bottom:2px;">'.$guestName.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Address:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$address.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;"></td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;"></td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Place of Supply:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$gcountry.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" valign="top" width="40%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" width="40%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Date:</td>
                                                <td align="left" valign="top" width="60%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$add_on.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Room No:</td>
                                                <td align="left" valign="top" width="75%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$roomNum.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Pax:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$pax.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Check In:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$checkIn.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Check Out:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$checkOut.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">No. of Day(s):</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$night.'</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">Plan Type:</td>
                                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:2px;">'.$planType.' PLAN</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" style="border-bottom:#000 4px solid;border-left:#000 1px solid;border-right:#000 1px solid;border-bottom-style:double;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                        <tbody>

                            '.$folioHtml.'
                            

                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px; border-top:#000 4px solid;border-top-style:double;" colspan="4">Grand Total</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px;  border-top:#000 4px solid;border-top-style:double;">'.$totalCharge.'</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px;  border-top:#000 4px solid;border-top-style:double;">'.$totalRecive.'</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px;  border-top:#000 4px solid;border-top-style:double;">'.$totalBalance.'</td>
                            </tr>

                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px; border-top:#000 1px solid;" colspan="5">Net Amount</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;  border-top:#000 1px solid;" colspan="2">'.$netAmount.'</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="5">CGST @ '.$halfPer.'%</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="2"> '.$halfGst.'</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="5">SGST @ '.$halfPer.'%</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="2"> '.$halfGst.'</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="5">Round Off</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="2"> '.$roundOff.'</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:bold; padding:5px 5px 0px 0px;" colspan="5">Invoice Amount</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:bold; padding:5px 5px 0px 0px;" colspan="2"> '.$totalRecive.'</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="5">Less Receipts</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:15px; font-weight:normal; padding:5px 5px 0px 0px;" colspan="2"> '.$totalRecive.'</td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:17px; font-weight:bold; padding:5px 5px 0px 0px;" colspan="5">Balance</td>
                                <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:17px; font-weight:bold; padding:5px 5px 0px 0px;" colspan="2"> '.$totalBalance.'</td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px 5px; border-top:#000 1px solid;" colspan="7">Invoice Amount In Words: '.$amountInWord.' Only.</td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        ';

        return $html;
    }


    function generateDownloadInvoice($type='',$bid=''){
        $hotelData = hotelDetail();
        $hotelName = strtoupper($hotelData['hotelName']);
        $fullKotLogoUrl = $hotelData['fullKotLogoUrl'];
        $address = $hotelData['address'];
        $address2 = $hotelData['address2'];
        $city = $hotelData['city'];
        $pincode = $hotelData['pincode'];
        $state = $hotelData['state'];
        $hotelPhoneNum = $hotelData['hotelPhoneNum'];
        $website = $hotelData['website'];
        $hotelEmailId = $hotelData['hotelEmailId'];

        $content = '';

        if($type == 'blankGRC'){
            $content = blankGRC();
        }

        if($type == 'invoice'){
            $content = invoice($bid);
        }

        $html = '
            <table id="table-print" width="850" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td align="center" valign="top" style="padding:5px 5px 0; font-family:Calibri; color:#000;border-top:#000 1px solid;border-left:#000 1px solid;border-right:#000 1px solid;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td width="25%" align="center" valign="top" style="padding:0 10px; font-family:Calibri; color:#000;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" valign="top" style="padding:10px; font-family:Calibri; color:#000;"><img src="'.$fullKotLogoUrl.'" style="width:100%;"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td width="50%" align="center" valign="top" style="padding:0 10px; font-family:Calibri; color:#000;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:Georgia; color:#000; font-size:26px; font-weight:normal; padding-bottom:5px;">'.$hotelName.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">'.$address.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">'.$city.', '.$state.'- '.$pincode.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Phone +91 '.$hotelPhoneNum.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Website: www.'.$website.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal; padding-bottom:0px;">Email: '.$hotelEmailId.'</td>
                                                    </tr>
                                                </tbody>  
                                            </table>
                                        </td>
                                        <td width="25%" align="center" valign="top" style="padding:0 10px; font-family:Calibri; color:#000;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    '.$content.'

                    <tr>
                        <td align="center" valign="top" style="padding:0 10px; font-family:Calibri; color:#000;border-left:#000 1px solid;border-right:#000 1px solid;border-bottom:#000 1px solid;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td width="100%" align="center" valign="top" style="font-family:Calibri; color:#000;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold; padding:5px 0 0px;">Conditions &amp; Policies</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" valign="top" style="font-family:Calibri; color:#000; font-size:12px; font-weight:normal; padding:5px 0 0px;font-style:italic;line-height: 20px;"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="padding:40px 10px 5px;border-left:#000 1px solid;border-right:#000 1px solid;border-bottom:#000 1px solid;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td align="left" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:13px; font-weight:normal;  padding-bottom:2px;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="left" valign="top" style="font-family:Calibri;padding-bottom:2px; color:#000; font-size:14px; font-weight:normal;">GUEST SIGNATURE</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td align="center" valign="top" width="40%" style="font-family:Calibri; color:#000; font-size:14px; font-weight:bold;"></td>
                                        <td align="right" valign="top" width="30%" style="font-family:Calibri; color:#000; font-size:13px; font-weight:normal;  padding-bottom:2px;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td align="right" valign="top" style="font-family:Calibri; color:#000; font-size:14px; font-weight:normal;">CASHIER/ FO. SIGNATURE</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        ';

        return $html;
    }

   

?>