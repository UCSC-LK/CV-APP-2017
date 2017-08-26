<div>
    <div class="row">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Customers <small>Details</small>
        </h1>
    </div>

    <div id="customerCardView" style="display: none">
        <div class="row">
            <div class="customer-details" id="customer-details">
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Name :</label>
                        </div>
                        <div class="col-md-6">
                            <label id="Name"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Business Name :</label>
                        </div>
                        <div class="col-md-6">
                            <label id="Business_Name"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Address :</label>
                        </div>
                        <div class="col-md-6">
                            <label id="Address"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Mobile :</label>
                        </div>
                        <div class="col-md-6">
                            <label id="Mobile"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Landphone :</label>
                        </div>
                        <div class="col-md-6">
                            <label id="Landphone"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table id="customerCardList" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Card ID</th>
                        <th>Value</th>
                        <th>Current Payment</th>
                        <th>Open Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
                <div class="form-group" id="back_cardView">
                    <button type="button" id = "cardView_back_btn" name="cardView_back_btn" class="btn btn-danger" value="Submit">Back</button>
                </div>
            </div>

        </div>
    </div>

    <div id="customerDetails">
        <div class="row">
            <div class="col-md-8">
                <table id="customerList" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Business Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Landphone</th>
                        <th>Profile</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--full card view php include-->
    <?php include('viewCard.php') ?>
    <!--end of full card view include -->




</div>

<script>

    $(document).ready(function() {
        var customerProfile =  '<a class="btn btn-warning btn-sm viewProfile"  id = "56"  data-toggle="modal" data-target="#myModalAdd" style = "margin-right:10px;"> <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>';
        var customerCardListV;
        var cName,cAddress,cMobile,cLandphone,cBusiness;

        var cardOpen = '<span class="label label-success">Open</span>';
        var cardClose = '<span class="label label-default">Close</span>';
        var cardReturn = '<span class="label label-danger">Return</span>';


        //var fullCard =  '<a class="btn btn-success btn-sm ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';
        //var fullCardModel = $('#fullCardModel');
        //var ajaxModelButton = "ajaxModel";
        //var cardId ='';
        var customerID = '';

        $(document).ready(function(){
            var cProfile = 'viewProfile';

            var customerList = $('#customerList').DataTable({

                ajax: {
                    url: '../../controllers/DBfunctions/JsonAPI.php',
                    dataSrc: '',
                    "data"   : function( d ) {
                        d.functionName =  "getCustomerList";
                        d.branchID =  branchId;
                    }
                },
                "columns": [
                    { "data": "C_Name" },
                    { "data": "C_Business_Name" },
                    { "data": "C_Address" },
                    { "data": "C_Telephone" },
                    { "data": "C_Landphone" },
                    {   "data": null,
                        "defaultContent": customerProfile
                    }
                ]

            });


            //cardId = '';

            var customerCdList = $('#customerCardList').DataTable({
                ajax: {
                    url: '../../controllers/DBfunctions/JsonAPI.php',
                    dataSrc: '',
                    "data"   : function( d ) {
                        d.functionName =  "customerCardList";
                        d.Customer_ID =  customerID;
                    }
                },

                "columns": [
                    { "data": "Cd_ID" },
                    { "data": "Value" },
                    { "data": "Current_Total" },
                    { "data": "Timestamp" },
                    { "data": "C_Open",
                        "render":function(data){
                            if(data == 1){
                                return cardOpen + fullCard;
                            }else if(data == 3){
                                return cardReturn + fullCard;
                            }
                            else{
                                return cardClose + fullCard;
                            }
                        }

                    }

                ]

            });



//
//            //full card deatiles
//            // givin card id load the all collection
//            var collectionTable2 = $('#collectionTable').DataTable({
//                ajax: {
//                    url: '../../controllers/DBfunctions/JsonAPI.php',
//                    dataSrc: '',
//                    "data"   : function( d ) {
//                        d.functionName =  "getAllCollectionCardId";
//                        d.cardId =  cardId;
//                    }
//                },
//
//                "columns": [
//                    { "data": "Timestamp" },
//                    { "data": "Amount" }
//
//                ]
//
//            });



//            function cardCreator(cardID){
//                // get all information for givin bill number
//                $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getAllInfoCardId",cardId :cardId }, function( data ) {
//                    //modelTitle
//                    $('#modeTitle1').html("Card :   " + data.Cd_ID);
//                    $('#refCode').html( data.Ref_ID);
//                    $('#reoCode').html(data.Collector_ID);
//                    $('#productPrice').html(data.Value);
//                    $('#downPayment').html(data.Down_Payment);
//                    $('#dailyPayment').html(data.Daily);
//                    $('#currentTotal').html(data.Current_Total);
//                    $('#customerName').html(data.C_Name);
//                    $('#address').html(data.C_Address);
//                    $('#businessName').html(data.C_Business_Name);
//                    $('#landNumber').html(data.C_Landphone);
//                    $('#productName').html(data.P_Name);
//                    $('#mobileNumber').html(data.C_Telephone);
//                    cardId = data.Cd_ID;
//                });
//
//                //reload data table in the model
//                collectionTable2.ajax.reload(null, false );
//                //model load
//                fullCardModel.modal('toggle')
//
//
//            }

            // get the id add call card create function
            customerCdList.on("click","." + ajaxModelButton,function() {
                var rowData = customerCdList.row($(this).parents('tr')).data();
                cardId = rowData["Cd_ID"];
                cardCreator(cardId);
            });


            customerList.on("click","." + cProfile,function(){
                var rowData = customerList.row( $(this).parents('tr') ).data();
                cID = rowData['C_ID'];
                cName = rowData['C_Name'];
                cAddress = rowData['C_Address'];
                cMobile = rowData['C_Telephone'];
                cLandphone = rowData['C_Landphone'];
                cBusiness = rowData['C_Business_Name'];
                $('#Name').html(cName);
                $('#Address').html(cAddress);
                $('#Mobile').html(cMobile);
                $('#Landphone').html(cLandphone);
                $('#Business_Name').html(cBusiness);

                // set the card id and reload the data table
                customerID = cID;
                customerCdList.ajax.reload(null, false );

                //cardLiast(cID);
                $('#customerCardView').slideDown( "slow" );
                $('#customerDetails').slideUp( "slow" );
            });

            $('#cardView_back_btn').click(function(){
                $('#customerCardView').slideUp("slow");
                $('#customerDetails').slideDown("slow");
            });


        });

    });


</script>