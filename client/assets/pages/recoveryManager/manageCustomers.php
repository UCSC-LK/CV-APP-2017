<div class="row">

    <div class="row page-header" style="margin:8px 0px 20px">
        <div class="col-lg-9">
            <h1 >
                Manage <small>Customers</small>
            </h1>
        </div>


    </div>


    <div class="col-md-10 col-md-offset-1">


        <div class="well well-lg">
            <div class="container-fluid">
                <form id="customerUpdateForm">
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="PhoneNumber">Phone Number</label>
                                    <input type="text" class="form-control" id="PhoneNumber" autocomplete="off" name="PhoneNumber" list="datalist" placeholder="Phone Numbe">
                                    <!--auto complete result load div -->
                                    <div class="list-group" id="results2" style="position: absolute"></div>

                                </div>

                                <div class="form-group">
                                    <label for="LandphoneNumber">Landphone Number</label>
                                    <input type="text"  class="form-control" autocomplete="off" id="LandphoneNumber" name="LandphoneNumber" placeholder="Landphone Number">
                                </div>

                                <div class="form-group">
                                    <label for="CustomerName">Customer Name</label>
                                    <input type="text" class="form-control" autocomplete="off" id="CustomerName" name="CustomerName" placeholder="Customer Name">
                                </div>


                                <input type="hidden" name="Cid" id="Cid" value = "-1" >

                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label for="CustumerAddress">Customer Address</label>
                                    <input type="text" class="form-control" autocomplete="off" id="CustumerAddress" name="CustumerAddress" placeholder="Customer Address">
                                </div>

                                <div class="form-group">
                                    <label for="Businessname">Business name</label>
                                    <input type="text" class="form-control" autocomplete="off" id="Businessname" name="Businessname" placeholder="Business name">
                                </div>

                                <div class="form-group">
                                    <label for="CustomerName">NIC</label>
                                    <input type="text" class="form-control" autocomplete="off" id="NIC" name="NIC" placeholder="NIC">
                                </div>

                                <div class="form-group">
                                      <button type="button" class="btn btn-default btn-success ajaxSubmitForm">Update</button>
                                </div>

                            </div>

                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var  validator1 = $("#customerUpdateForm").validate({
    rules: {

        PhoneNumber: {
            required: true,
            number: true

        },

        CustomerName: {
            required: true

        },

        CustumerAddress: {
            required: true
        },

        NIC: {
            //required: true
        },

        LandphoneNumber: {
            number: true

        },

        Businessname: {
            required: true
        }
    }
});

  $(document).ready(function() {
    var submitButton        = "ajaxSubmitForm";
    var customerUpdaterForm    = $('#customerUpdateForm');
    var phoneNumber         = $("#PhoneNumber");
    var MIN_LENGTH          = 2; // auto complete
    var autoResult          = $('#results2');
    var CustomerName        = $('#CustomerName');
    var CustumerAddress     = $('#CustumerAddress');
    var LandphoneNumber     = $('#LandphoneNumber');
    var Businessname        = $('#Businessname');
    var Cid                 = $('#Cid');
    var NIC                 = $('#NIC');



    customerUpdaterForm.on("click","." + submitButton,function(){
        var validationPass = customerUpdaterForm.valid();
        if (validationPass){
            var formData = customerUpdaterForm.serialize();
            alert(formData);
            ajaxSend(formData,"updateCustomer");
        }

    });

    //auto complete for phone number
    phoneNumber.keyup(function() {
        var keyword = phoneNumber.val();
        if (keyword.length >= MIN_LENGTH) {

            Cid.val('-1');                                      //remove the auto fill before the new and set default value
            CustomerName.val('').removeAttr('disabled');       //remove the auto fill before the new search
            CustumerAddress.val('').removeAttr('disabled');    //remove the auto fill before the new search
            LandphoneNumber.val('').removeAttr('disabled');
            Businessname.val('').removeAttr('disabled');
            NIC.val('').removeAttr('disabled');


            $.get( "../../controllers/DBfunctions/JsonAPI.php", { keyword: keyword ,functionName : "autoCompletePhone" } )
                .done(function( data ) {
                    autoResult.html('');
                    var results = jQuery.parseJSON(data);
                    $(results).each(function(key, value) {
                        autoResult.append('<a data-name="' + value.C_Name  + '" data-address="'+ value.C_Address + '" data-nic="'+ value.C_NIC + '" data-landnum="'+ value.C_Landphone  + '" data-bname="'+ value.C_Business_Name +  '" data-cid="'+ value.C_ID +'" class="list-group-item autoSelect">' + value.C_Telephone + '</a>');
                        if (value.C_Telephone == keyword ){
                            //alert("This is match");
                            Cid.val(value.C_ID);
                            CustomerName.val(value.C_Name);            // set auto customer name
                            CustumerAddress.val(value.C_Address);       // set auto customer address
                            LandphoneNumber.val(value.C_Landphone);
                            NIC.val(value.C_NIC);
                            Businessname.val(value.C_Business_Name); ///////////////
                            $("#results2").fadeOut(100);
                        }
                    });


                    $('.autoSelect').click(function() {
                        var name = $(this).attr('data-name');
                        var address = $(this).attr('data-address');
                        var LandNum = $(this).attr('data-landnum');
                        var NICnum = $(this).attr('data-nic');
                        var cid = $(this).attr('data-cid');
                        var business = $(this).attr('data-bname');
                        var text = $(this).html();
                        Cid.val(cid);
                        phoneNumber.val(text);              // set auto phone number
                        CustomerName.val(name);             // set auto customer name
                        CustumerAddress.val(address);       // set auto customer address
                        LandphoneNumber.val(LandNum);
                        NIC.val(NICnum);
                        Businessname.val(business); ///////////////

                    })

                });
        } else {
            autoResult.html('');
        }
    });

    //auto complte list
    phoneNumber.blur(function(){
        $("#results2").fadeOut(500);
    })
        .focus(function() {
            $("#results2").show();
        });

    //auto complete for phone number - end


            function ajaxSend(params,action,clickRow){
                $.ajax({
                    type: "POST",
                    url: "../../controllers/cardAndCustomerManagement/cardUserManagement.php",
                    data : params+"&action="+action+"&branch_ID="+branchId,
                    dataType: "json",
                    success: function(response){
                        if(response.success == 1){
                            alert(response.id);

                            $('#customerUpdateForm').trigger("reset");
                            Cid.val('-1');              //remove the auto fill before the new and set default value
                            CustomerName.val('');       //remove the auto fill before the new search
                            CustumerAddress.val('');    //remove the auto fill before the new search
                            LandphoneNumber.val('');
                            Businessname.val('');
                            NIC.val('');
                        }

                        else if(response.success == 3){
                          alert(response.id);
                        }
                    },
                    error: function(xhr, status, error){
                        console.log(xhr);
                        alert("Unexpected error");
                        console.log(status,error);
                    }
                });

            };
  });


</script>
