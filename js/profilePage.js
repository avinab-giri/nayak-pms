$(function () {
    
    var webUrl = 'https://localhost/retrod-pro/pms/';
    $('.linkBtn').removeClass('active');
    $('.setupLink').addClass('active');

    function loadSocialMediaContent(){
        var form_data = "request_type=loadSocialMediaContent";
        var htmlData = '';
        ajax_request(form_data).done((result) => {
            var returnData = JSON.parse(result);
            $.each(returnData,function(key,val){
                var id = val.detail.id;
                var iconSvg = val.detail.icon;
                var key = val.detail.accesKey;
                var name = val.detail.name;
                var bg = val.detail.bgClr;
                var clr = val.detail.color;
                var link = val.data.link;
                htmlData += '<div class="col-md-6">'+
                                '<div class="iconWithInput '+key+'">'+
                                    '<input name="sKey[]" type="hidden" value="'+id+'"/><label for="'+key+'" style="background: '+bg+'"><span class="rightBar" style="background: '+clr+'"></span><span class="icon" style="color:'+clr+'">'+iconSvg+'</span></label>'+
                                    '<input type="text" class="form-control" placeholder="Enter '+name+' Link." name="socialMedia[]" id="'+key+'" value="'+link+'">'+
                                '</div>'+
                            '</div>';
            });

            $('#socialMediaContent').html(htmlData);
        });
    }

    loadSocialMediaContent();
    
    $(document).on('submit','#profileForm', function(e){
        e.preventDefault();
    });

    $(document).on('click', '#socialMediaAddBtn', function (e) {
        e.preventDefault();
        var form_data = "request_type=losdSysExistSocialMedia";
        ajax_request(form_data).done((result) => {
            var requestData = JSON.parse(result);
            var sOption = '';
            console.log();
            $.each(requestData, (key,val)=>{
                var name = val.name;
                var sid = val.id;
                sOption += '<option value="'+sid+'">'+name+'</span></option>';
            });
            var html = '';
            if(requestData.length == 0){
                html = "No data";
            }else{
                html = '<form><div class="row">'+
                    '<div class="col-md-6"><div class="form-group">'+
                        '<label for="smid">Select Solial</label>'+
                        '<select class="form-control" name="smid" id="smid">'+sOption+'</select>'+
                    '</div></div>'+
                    '<div class="col-md-6"><div class="form-group">'+
                        '<label for="smurl">Url</label>'+
                        '<input id="smurl" type="text" class="form-control" placeholder="Enter URL">'+
                    '</div></div>'+
                '</div></form>'
            }
            

            showModalBox('Add Social Link', 'Submit', html, 'AddSocialMedia');
            var myModal = new bootstrap.Modal(document.getElementById('popUpModal'));
            myModal.show();
        });
    });

    $(document).on('click','#AddSocialMedia', function(){
        var sid = $('#smid').val();
        var smurl = $('#smurl').val().trim();
        if(sid == ''){

        }else if(smurl == ''){

        }else{
            var form_data = "request_type=AddSocialMedia&sid="+sid+"&smurl="+smurl;
            ajax_request(form_data).done((result) => {
                var requestData = JSON.parse(result);
                
                if(requestData == 1){
                    removeModal();
                    loadSocialMediaContent();
                }

            });
        }
    });

    $(document).on('click', '#addProfileAddres', function () {
        $('#bookindDetail').addClass('show');

        var form_data = "request_type=hotelDetailReq";
        ajax_request(form_data).done((result) => {
            var requestData = JSON.parse(result);
            function nullCheck(data){
                if(data == null){
                    return '';
                }else{
                    return data;
                }
            }
            var address = nullCheck(requestData.location.address);
            var coordinate = nullCheck(requestData.location.coordinate);
            var country = nullCheck(requestData.location.country);
            var district = nullCheck(requestData.location.district);
            var mapIfrem = nullCheck(requestData.location.mapIfrem);
            var pincode = nullCheck(requestData.location.pincode);
            var state = nullCheck(requestData.location.state);
            var mapIfremStatus = nullCheck(requestData.location.mapIfremStatus);
            var mapStatusCheck = '';
            if(mapIfremStatus == 1){
                mapStatusCheck = 'checked';
            }

            var html = '<div class="addressProfileContent">'+
                        '<h4 style="margin-left:25px;">Property Location</h4>'+
                        '<form id="addressProfileForm" method="post">'+
                        
                            '<div class="row p0">'+
                                
                                '<div class="form-group mb-3 col-md-12">'+
                                    '<label for="streetAddress">Street Address</label>'+
                                    '<textarea autocomplete="off" name="streetAddress" id="streetAddress" class="form-control">'+address+'</textarea>'+
                                '</div>'+
                                '<div class="form-group mb-3 col-md-6">'+
                                    '<label for="district">District</label>'+
                                    '<input autocomplete="off" class="form-control" type="text" name="district" placeholder="Enter District" id="district" value="'+district+'">'+
                                '</div>'+
                                '<div class="form-group mb-3 col-md-6">'+
                                    '<label for="country">County Name</label>'+
                                    '<input autocomplete="off" class="form-control" type="text" name="country" placeholder="Enter country" id="country" value="'+country+'">'+
                                '</div>'+
                                
                                '<div class="form-group mb-3 col-md-6">'+
                                    '<label for="state">County Name</label>'+
                                    '<input autocomplete="off" class="form-control" type="text" name="state" placeholder="Enter state" id="state" value="'+state+'">'+
                                '</div>'+

                                '<div class="form-group mb-3 col-md-6">'+
                                    '<label for="postCode">Pin Code</label>'+
                                    '<input autocomplete="off" class="form-control" type="text" name="postCode" placeholder="Enter pincode" id="postCode" value="'+pincode+'">'+
                                '</div>'+

                                '<div class="form-group mb-3 col-12">'+
                                    '<label for="coordinate">Coordinate</label>'+
                                    '<input autocomplete="off" class="form-control" type="text" name="coordinate" placeholder="20.00000000000000, 85.00000000000000" id="coordinate" value="'+coordinate+'">'+
                                '</div>'+

                                '<div class="form-group mb-3 col-md-12">'+
                                    '<label for="googleMap">Google Map Ifrem</label>'+
                                    '<div style="display: inline-block;margin-left: 15px;" class="form-check"><input '+mapStatusCheck+' class="form-check-input" name="googleMapIfremCheck" type="checkbox" value="" id="googleMapIfremCheck"><label class="form-check-label" for="googleMapIfremCheck">Checked to display google map</label></div>'+
                                    '<textarea name="googleMap" id="googleMap" class="form-control">'+mapIfrem+'</textarea>'+
                                '</div>'+

                                '<div class="btnGroup p-0">'+
                                    '<input class="form-controlbtn btn bg-gradient-primary btn-sm mb-0 pr-3" type="submit" name="submit" value="Submit">'+
                                    '<a href="javascript:void(0)" type="button" class="btn bg-gradient-secondary" id="closeAddressPopUp"=>Cancel</a>'+
                                '</div>'+

                            '</div>'+
                        
                        '</form>'+
                        
                    '</div>'
            
                    $('#bookindDetail .content').html(html);
        });
    });

    $(document).on('click', '#closeAddressPopUp', function () {
        $('#bookindDetail').removeClass('show');
    });


    $(document).on('submit', '#addressProfileForm', function (e) {
        e.preventDefault();
        $('#addressProfileForm button').prop('disabled', false);
        $('#addressProfileForm button').html('Loading..');
        var data = new FormData(this);
        data.append('type', 'addressProfileSubmit');
        $.ajax({
            url: webUrl + 'include/ajax/property.php',
            type: 'post',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data == 1) {
                    $('#bookindDetail').removeClass('show');
                    sweetAlert("Successfully Update Location.");
                    location.reload();
                }

            }
        });

    }); 

    $(document).on('click', '#hotelProfileFormSubmitBtn', function (e) {
        e.preventDefault();
        $('#hotelProfileFormSubmitBtn').prop('disabled', false);
        $('#hotelProfileFormSubmitBtn').html('Loading..');
        var data = new FormData(document.getElementById('profileForm'));
        data.append('type', 'propertyAllUpdate');

        $.ajax({
            url: webUrl + 'include/ajax/property.php',
            type: 'post',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                var result = JSON.parse(data);
                var error = result.error;
                var msg = result.msg;
                if (error == 'no') {
                    sweetAlert(msg);
                    location.reload();
                }
            }
        });

    });

    function enterToDataPuss($target, $type, $data) {
        var type = $type;
        var data = $data;
        var target = $target;

        $.ajax({
            url: webUrl + 'include/ajax/propertySetup.php',
            type: 'post',
            data: { 'type': type, 'data': data },
            success: function (jsonData) {
                var result = JSON.parse(jsonData);
                var msg = result.msg;
                var error = result.error;

                if (error == 'no') {
                    var contentHtml = "<li><span>" + data + "</span> <span class='removeitem'><i class='bi bi-x'></i></span></li>";
                    $(this).val('');
                    target.append(contentHtml);
                    sweetAlert(msg);
                }

                if (error == 'yes') {
                    $(this).val('');
                    Swal.fire("Error", msg, "error");
                    sweetAlert(msg, 'error');
                }


            }
        });

    }

    $(document).on('keyup', '#hemail', function (e) {
        e.preventDefault();
        if (e.keyCode === 13) {
            var data = $(this).val().trim();
            var target = $(this).parent().siblings('.enterToDataDisplay');
            enterToDataPuss(target, 'emailIdAddd', data);
            $(this).val('');
        }

    });

    $(document).on('click', '.removeitem', function () {
        var emailId = $(this).siblings('span').html();
        var target = $(this).parent().siblings('.enterToDataDisplay');
        enterToDataPuss(target, 'removeEmailId', emailId);
        $(this).parent().remove();
        sweetAlert('Successfully delete email id');

    });

    $(document).on('keyup', '#phone', function (e) {
        e.preventDefault();
        if (e.keyCode === 13) {
            var data = $(this).val().trim();
            var target = $(this).parent().siblings('.enterToDataDisplay');
            enterToDataPuss(target, 'phoneNumAddd', data);
            $(this).val('');
        }

    });

    $(document).on('click', '.removeNumItem', function () {
        var phoneNum = $(this).siblings('span').html();
        var target = $(this).parent().siblings('.enterToDataDisplay');
        enterToDataPuss(target, 'removePhoneNum', phoneNum);
        $(this).parent().remove();
    });
    
});