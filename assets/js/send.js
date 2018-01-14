$(function () {
    $(document).on("click",'#js-submit-send',function(e)
    {
        var address = $("#send-address").val();
        var label = $("#send-label").val();
        var amount = $("#send-amount").val();
        var type = $("#send-type").val();

        if( address != undefined && address.length >0  && amount.length >0 && isNumber(amount))
        {
            var $data = {
                action:  'sendwhitecoin',
                sendaddress: address,
                sendlabel: label,
                sendamount: amount,
                sendtype: type
            };
            //console.log($data);
            var $success = function ($json)
            {
                if($json.message != undefined)
                {
                    $("#js--deal-infor").text($json.message);
                }
            };

            if(confirm("Send confirm"))
            {
               action($data, $success, 'json');
            }
        }
        else if(address.length==0)
        {
            alert('Address null');
        }
        else if(amount.length==0 || !isNumber(amount))
        {
            alert('Amount error');
        }

        $("#newaddress").modal('hide');
        e.preventDefault();

    });

    $(document).on("click",'#submitnewaddress',function(e)
    {
        var $address = $("#newaddressvalue").val();
        var $label = $("#newaddresslabel").val();

        if($("#newaddresslabel").val() != undefined)
        {
            var $data = {
                action:  'newaddress',
                newaddress: $address,
                newlabel: $label
            };

            var $success = function ($json)
            {
                console.log($json);

                if($json.message === 'success'){
                    location.reload();
                }
                //location.reload();
            };

            if(confirm("Get new address confirm"))
            {
                action($data, $success, 'json');
            }
        }
        $("#newaddress").modal('hide');
        e.preventDefault();
    });

    var dialogSelectAddress = null;
   $(document).on("click",'#js-open-address-book',function(e)
    {
        dialogSelectAddress = $( "#js-select-address-book" ).dialog({
            height: 500,
            width: 800,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        return false;
    });

    $('[id^=send-address-select]').click(function () {
        $('#send-address-for-select').val($(this).attr('id').substring(20));
        $('#send-address').val($(this).attr('id').substring(20));
        $(this).addClass('select-item');
        $(this).siblings().removeClass('select-item');
        dialogSelectAddress.dialog('close');
    });

});

function isNumber(obj){
    var reg = /^[0-9]*$/;
    return reg.test(obj);
}

function action($data, $success, $type)
{

    $.ajax({
        type:     'POST',
        url:      "/Operators/Action.php",
        data:     $data,
        dataType: $type,
        cache:    false,
        success:  $success
    });
}