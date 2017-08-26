
<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <div class="row page-header" style="margin:8px 0px 20px">
            <div class="col-lg-12">
                <h1 >
                    Unpaid <small>Card</small>
                </h1>
            </div>

        </div>



        <div class="col-md-10 col-md-offset-1">
            <div id = "results"></div>
            </br>


            <div>

                <table id="newCardTabel" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Card ID</th>
                        <th>Collector ID</th>
                        <th>Open Date</th>
                        <th>Price</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>

            </div>



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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Customer name</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="customerName" ></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label >Address</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label >:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="address"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Business Name</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="businessName"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Mobile Number</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="mobileNumber"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>land Number</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="landNumber"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Product Name</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="productName"></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!--end of col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Ref Code</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="refCode"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Reo Code</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>

                                                <div class="col-md-6 text-left" id="reoIdDefault">
                                                    <label id="reoCode"></label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Product Price</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="productPrice"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Down Payment</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="downPayment">customer name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Daily Payment</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="dailyPayment"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <label>Current Total</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>:</label>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <label id="currentTotal"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--end of col-md-6 -->
                                </div>
                            </form>

                            <!--Button Part-->
                            <div class="well">

                                <table id="collectionTable" class="display" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount (Rs)</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end of Full Card -->


        </div>


    </div>

</div><!--do not remove -->

<script>


//    var User_ID = 'temp';
//    var branchId = "aa"; // initial tab branch id

    $(document).ready(function() {

        var fullCard =  '<a class="btn btn-success btn-sm ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';
        var fullCardModel = $('#fullCardModel');
        var ajaxModelButton = "ajaxModel";
        var cardId ='';


        var table1 = $('#newCardTabel').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getNopaidCardAlert";
                    d.branchID =  branchId
                }
            },

            "columns": [
                { "data": "Cd_ID" },
                { "data": "Collector_ID" },
                { "data": "Timestamp" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "DueAmount" },
                { "data": "Balance" },
                {   "data": null,
                    "defaultContent": fullCard
                }
            ]

        });


        //full card deatiles
        // givin card id load the all collection
        var collectionTable2 = $('#collectionTable').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getAllCollectionCardId";
                    d.cardId =  cardId;
                }
            },

            "columns": [
                { "data": "Timestamp" },
                { "data": "Amount" }

            ]

        });



        function cardCreator(cardID){
            // get all information for givin bill number
            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getAllInfoCardId",cardId :cardId }, function( data ) {
                //modelTitle
                $('#modeTitle1').html("Card :   " + data.Cd_ID);
                $('#refCode').html( data.Ref_ID);
                $('#reoCode').html(data.Collector_ID);
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
                cardId = data.Cd_ID;
            });

            //reload data table in the model
            collectionTable2.ajax.reload(null, false );
            //model load
            fullCardModel.modal('toggle')


        }


        // get the id add call card create function
        table1.on("click","." + ajaxModelButton,function() {
            var rowData = table1.row($(this).parents('tr')).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });



        function ajaxSend(params,action,clickRow){
            $.ajax({
                type: "POST",
                url: "../../controllers/cardAndCustomerManagement/cardUserManagement.php",
                data : params+"&action="+action+"&User_ID="+User_ID,
                dataType: "json",
                success: function(response){
                    switch (action){
                        case "removeNewCardAlert":
                            if(response.success == 1){
                                table1.row(clickRow).remove().draw();
                                alert(response.id);
                            }else{
                                alert("Unexpected error #2, Please try again")
                            }
                            break;


                    }


                },
                error: function(){
                    alert("Unexpected error, Please try again");
                }
            });

        }





    } );






</script>




