<!--Full Card Model -->
<div class="modal fade bs-example-modal-lg" id="fullCardModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modeTitle1">Card details</h4>
            </div>
            <div class="modal-body" id="cardLable">
                <form id="fullCardForm">
                    <div class="row ">
                        <div class="col-xs-6  ">
                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Customer name</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="customerName" ></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label >Address</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label >:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="address"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Business Name</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="businessName"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Mobile Number</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="mobileNumber"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>land Number</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="landNumber"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Product Name</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="productName"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Open By</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="openBy"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Open Date</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="openDate"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Close By</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="closeBy"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Close Date</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="closeDate"></label>
                                    </div>
                                </div>
                            </div>




                        </div> <!--end of col-xs-6 -->
                        <div class="col-xs-6">
                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Ref Code</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="refCode"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Reo Code</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>

                                    <div class="col-xs-4 text-left" id="reoIdDefault">
                                        <label id="reoCodeDefault"></label>
                                    </div>

                                    <div class="col-xs-4 text-left" id="reoIdDchange" style="display: none">
                                        <!-- Make select list by js-->
                                        <select class="form-control "  data-live-search="true"  id="ReoCodeUpdate" name="ReoCodeUpdate">
                                        </select>
                                    </div>

                                    <div class="col-xs-2 text-left">
                                        <label for="ProductName" >
                                            <a class="btn btn-warning btn-xs" id="editButton">Change</a>
                                        </label>

                                        <label id="saveButton" style="display: none" >
                                            <a class="btn btn-success btn-xs" id="editButton">Save</a>
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Product Price</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="productPrice"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Discount</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="discount"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Down Payment</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="downPayment">customer name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Daily Payment</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="dailyPayment"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Current Total</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left">
                                        <label id="currentTotal"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Closing Balance</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left alert-warning">
                                        <label id="closingBalance"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Arrears</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left alert-danger" >
                                        <label id="arrears"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-4">
                                        <label>Active Days</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-xs-6 text-left" >
                                        <label id="activeDays"></label>
                                    </div>
                                </div>
                            </div>








                        </div> <!--end of col-xs-6 -->

                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-2">
                                        <label>Comment</label>
                                    </div>
                                    <div class="col-xs-1">
                                        <label>:</label>
                                    </div>

                                    <div class="col-xs-5 text-left" id="comment">
                                        <label id="reoCodeDefault"></label>
                                    </div>

                                </div>
                            </div>

                            <!--action bar-->

                            <div class="form-group">
                                <div class="row ">
                                    <div class="col-xs-2">
                                        <label for="ProductName" >
                                            <a class="btn btn-warning btn-xs" id="commentButton">Comment</a>
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </form>

                <!--Button Part-->
                <a class="btn bg-pink waves-effect m-b-15" role="button" data-toggle="collapse" href="#payments" aria-expanded="false"
                   aria-controls="payments">
                    Payments
                </a>

                <div class="collapse" id="payments">

                <div class="well">

                    <table id="collectionTable" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount (Rs)</th>
                            <th>Collected By</th>
                        </tr>
                        </thead>
                    </table>
                </div>
              </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Close</button>
            </div>

        </div>

        <!--Comment  Model -->
        <div class="modal fade" id="commentModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close closeModal"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modeTitle">Comment</h4>
                    </div>
                    <div class="modal-body">
                        <form id="commentForm">

                            <div class="form-group">
                                <label for="comment" >Comment</label>
                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>

                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default closeModal">Close</button>
                        <button type="button" class="btn btn-primary" id="commentSave">Save</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- end of Comment  Model -->

    </div>
</div>
<!-- end of Full Card -->


<!--view Card related script -->

<script>

    $('.closeModal').click(function(){
        $($(this).closest('.modal')).modal('hide');
    });

    var validator =  $("#fullCardForm").validate({
        rules: {
            ReoCodeUpdate: {
                required: true

            }
        },
        messages: {
            ReoCodeUpdate: "required"
        }

    });


    $("#commentForm").validate({
        rules: {
            comment: {
                required: true

            }
        }

    });



    // button
    var fullCard =  '<a class="btn btn-success btn-xs ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';

    // click event binder
    var ajaxModelButton = "ajaxModel";

    var fullCardModel = $('#fullCardModel');

    var ReoCodeUpdate    = $('#ReoCodeUpdate');

    var editButton1 = $('#editButton');

    // for card entry delete
    var reoId;
    // card id for update reo
    var cardId ='';

    var commentButton = $('#commentButton');

    var commentModel = $('#commentModel');

    var commentSave = $('#commentSave');

    var commentForm = $('#commentForm');





    // load the all collection for click card id
    var collectionTable2 = $('#collectionTable').DataTable({
        ajax: {
            url: '../../../application/controllers/DBfunctions/JsonAPI.php',
            dataSrc: '',
            "data"   : function( d ) {
                d.functionName =  "getAllCollectionCardId";
                d.cardId =  cardId;
            }
        },

        "columns": [
            { "data": "Timestamp" },
            { "data": "Amount" },
            { "data": "CollectedBy" }
        ]

    });

    function cardCreator(cardID){
        // get all information for givin bill number
        $.getJSON( "../../../application/controllers/DBfunctions/JsonAPI.php",{functionName : "getAllInfoCardId",cardId :cardId }, function( data ) {
            console.log(data);
            //modelTitle
            $('#modeTitle1').html("Card :   " + data.Cd_ID);
            $('#refCode').html( data.Ref_ID);
            $('#reoCodeDefault').html(data.Collector_ID);
            $('#productPrice').html(data.Value);
            $('#downPayment').html(data.Down_Payment);
            $('#dailyPayment').html(data.Daily);
            $('#currentTotal').html(data.Current_Total);
            $('#customerName').html(data.C_Name);
            $('#address').html(data.C_Address);
            $('#businessName').html(data.C_Business_Name);
            $('#landNumber').html(data.C_Landphone);
            $('#productName').html(data.P_Name);
            $('#mobileNumber').html(data.C_Telephone);


            $('#discount').html(data.Discount);  // check here when something wrong
            $('#openDate').html(data.openDate);

            $('#activeDays').html(data.ActiveDays);
            $('#comment').html(data.comment);





            if(data.C_Open == 1){
//                if ((data.Balance + data.Current_Total) > data.Value){
//                    $('#arrears').html(data.Value - data.Current_Total );
//                }else{
//                    $('#arrears').html(data.Balance);
//                }

                $('#arrears').html(data.Balance);

                $('#closingBalance').html(data.Value - data.Current_Total );
                $('#closeBy').html('-');
                $('#closeDate').html('-');

            }else{



                $('#arrears').html('-');
                $('#closingBalance').html('-');
                $('#closeBy').html(data.closeedBy);
                $('#closeDate').html(data.closeDate);

            }

            reoId = data.Collector_ID;
            cardId = data.Cd_ID;
        });

        //reload data table in the model
        collectionTable2.ajax.reload(null, false );


        //model load
        fullCardModel.modal('toggle')


    }





    //--->Card Update Methods <---//

    // for change collector
    $.getJSON( "../../../application/controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
        ReoCodeUpdate.selectList({
            helpText : 'Select collector',
            dataArray : data
        });
    });


    var reoIdDchange1 = $('#reoIdDchange');
    var reoIdDefault1 = $('#reoIdDefault');
    var saveButton1   = $('#saveButton');

    //model related
    editButton1.click(function(){
        reoIdDefault1.hide();
        reoIdDchange1.show();
        saveButton1.show();
        editButton1.hide();

    });
    saveButton1.click(function(){
        if (validationPass = $("#fullCardForm").valid()){

            var para = '&Cd_ID=' + cardId + '&Reoid=' + $('#ReoCodeUpdate').val();
            //alert(para)
            ajaxSend(para,"updateReo");

        }
    });


    //Comment function

    commentButton.click(function(){
        document.getElementById("commentForm").reset();
        commentModel.modal('toggle');
    });

    commentSave.click(function () {
        if(commentForm.valid()){
            var formData = commentForm.serialize()+'&Cd_ID='+cardId;
            ajaxSend(formData,"addComment");
        }
    });


    function ajaxSend(params,action,clickRow){
        $.ajax({
            type: "POST",
            url: "../../../application/controllers/collectionManagement/collectionManagement.php",
            data : params+"&action="+action+"&User_ID="+userId,
            dataType: "json",
            success: function(response){
                switch (action){
                    case "updateReo":
                        if(response.success == 1){
                            $('#reoCodeDefault').html(response.id);
                            editButton1.show();
                            reoIdDefault1.show();
                            reoIdDchange1.hide();
                            saveButton1.hide();

                        }else{
                            alert("Unexpected error #2, Please try again")
                        }
                        break;

                    case "addComment":
                        if(response.success == 1){
                            commentModel.modal('toggle');
                            //if success set comment to current open card model
                            $('#comment').html(response.id);


                        }else{
                            alert("Unexpected error #2, Please try again")
                        }
                        break;
                }


            },
            error: function(xhr, status, error){
                console.log(xhr);
                alert("Unexpected error");
                console.log(status,error);
            }
        });

    }


</script>
