<?php

include('include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
// include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>Visitor</title>

    <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

    <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">


        <div class="container">

            <div class="row mt-2 justify-content-center">

                <?= backNavbarUi('','Visitor') ?>

                <div class="col-md-8 col-sm-12">
                    
                </div>

            </div>



        </div>

    </main>

    <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>
    
    <?php include(FO_SERVER_SCREEN_PATH . 'booing_detail.php') ?>


    <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>


    <script>
        $('.linkBtn').removeClass('active');
        $('.setupLink').addClass('active');

        $(document).on('click', '#customDomainSubmit', function(e) {
            e.preventDefault();
            var customDomain = $('#customDomain').val().trim();
            var slugName = convertToSlug(customDomain);
            if (customDomain == '') {
                sweetAlert('Custom Domain field required.', 'error');
            }else if(slugName != customDomain){
                sweetAlert('Domain name should be lowercase and no space user (-).', 'error');
            } else {
                var data = 'customDomain=' + customDomain + '&request_type=customDomainSubmit';

                Swal.fire({
                        title: 'Are you sure?',
                        text: "Did you want to change this domain name?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    })
                    .then((willDelete) => {
                        function updateRecord() {
                            ajax_request(data).done(function(result) {
                                var array = JSON.parse(result);
                                var error = array.error;
                                var msg = array.msg;
                                var num = array.num;

                                if (error == 'no') {
                                    sweetAlert(msg);
                                    var changeDomain = customDomain+".<?= DOMAIN ?>";
                                    var html = `<a hrf="http://${changeDomain}">${changeDomain}</a>`;
                                    $('#beDomainName').html(html);
                                }

                                if (error == 'yes') {
                                    sweetAlert(msg, 'error');
                                }

                            });
                        }

                        if (willDelete.isConfirmed) {
                            updateRecord();
                        }

                    });
            }

        });
    </script>

</body>

</html>