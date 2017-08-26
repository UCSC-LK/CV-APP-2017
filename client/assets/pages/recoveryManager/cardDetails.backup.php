<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Card <small>details</small>
        </h1>


        <div class="col-md-12">
            <div id = "results"></div>
            <br>
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Open" id="openClick" aria-controls="home" role="tab" data-toggle="tab">Open</a></li>
                    <li role="presentation"><a href="#Closed" id="closedClick" aria-controls="profile" role="tab" data-toggle="tab">Closed</a></li>
                    <li role="presentation"><a href="#Return" id="retrunClick" aria-controls="profile" role="tab" data-toggle="tab">Return</a></li>
                    <li role="presentation"><a href="#All" id="allClick" aria-controls="messages" role="tab" data-toggle="tab">All</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Open"> <!-- Open panes -->
                        <table id="openTable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>CardID</th>
                                <th>Ref ID</th>
                                <th>Reo ID</th>
                                <th>Value</th>
                                <th>CurrentTotal</th>
                                <th>OpenDate</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div><!-- Open panes  - End -->

                    <div role="tabpanel" class="tab-pane" id="Closed"><!-- Closed panes -->
                        <table id="closedTable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>CardID</th>
                                <th>Ref ID</th>
                                <th>Reo ID</th>
                                <th>Value</th>
                                <th>CurrentTotal</th>
                                <th>OpenDate</th>
                                <th>Closed Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div><!-- Closed panes  - End -->


                    <div role="tabpanel" class="tab-pane" id="Return"><!-- Return panes -->
                        <table id="returnTable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>CardID</th>
                                <th>Ref ID</th>
                                <th>Reo ID</th>
                                <th>Value</th>
                                <th>CurrentTotal</th>
                                <th>OpenDate</th>
                                <th>Closed Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div><!-- Return panes  - End -->

                    <div role="tabpanel" class="tab-pane" id="All"><!-- All panes -->
                        <table id="allTable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>CardID</th>
                                <th>Ref ID</th>
                                <th>Reo ID</th>
                                <th>Value</th>
                                <th>CurrentTotal</th>
                                <th>OpenDate</th>
                                <th>Closed Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div><!-- All panes  - End -->






            </div>
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

</div><!--do not remove -->

<script>





    $(document).ready(function() {
        var fullCardModel = $('#fullCardModel');


        //var fullCard =  '<a class="btn btn-success btn-sm"  id="fullCardModel" data-toggle="modal" data-target="#fullCardModel" style = "margin-right:10px;"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>';
        var fullCard =  '<a class="btn btn-success btn-sm ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';


        var ajaxModelButton = "ajaxModel";


        var ReoCode     = $('#ReoCode');


        var openTable1 = $('#openTable').DataTable({

            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getAllOpenCard";
                    d.branchID =  branchId; // no use of current
                }
            },



            "columns": [
                { "data": "Cd_ID" },
                { "data": "RefName" },
                { "data": "CollectorName" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "Timestamp" },
                {   "data": null,
                    "defaultContent": fullCard
                }


            ]

        });

        var closedTable1 = $('#closedTable').DataTable({

            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getAllClosedCard";
                    d.branchID =  branchId;
                }
            },



            "columns": [
                { "data": "Cd_ID" },
                { "data": "RefName" },
                { "data": "CollectorName" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "Timestamp"},
                { "data": "Close_Date" },
                {   "data": null,
                    "defaultContent": fullCard
                }



            ]

        });

        var returnTable1 = $('#returnTable').DataTable({

            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getAllReturnCard";
                    d.branchID =  branchId;
                }
            },



            "columns": [
                { "data": "Cd_ID" },
                { "data": "RefName" },
                { "data": "CollectorName" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "Timestamp"},
                { "data": "Close_Date" },
                {   "data": null,
                    "defaultContent": fullCard
                }



            ]

        });


        var cardId ='';


        var AllTable1 = $('#allTable').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getAllCard";
                    d.branchID =  branchId;
                }
            },


            "columns": [
                { "data": "Cd_ID" },
                { "data": "RefName" },
                { "data": "CollectorName" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "Timestamp"},
                { "data": "Close_Date" },
                {   "data": null,
                    "defaultContent": fullCard
                }

            ]

        });




        var timerOpen = '';
        var timerClosed = '';
        var timerAll ='';
        var timerReturn ='';

        $('#openClick').click(function(){
                //immediate reload table
                openTable1.ajax.reload(null, false );

                // remove auto refresh for other table
                clearInterval(timerClosed);
                clearInterval(timerAll);
                clearInterval(timerReturn);
                timerOpen = setInterval( function () {
                    openTable1.ajax.reload(null, false );
                }, 15000 );

            }

        );
        $('#closedClick').click(function(){
                closedTable1.ajax.reload(null, false );
                clearInterval(timerOpen);
                clearInterval(timerAll);
                clearInterval(timerReturn);
                timerClosed = setInterval( function () {
                    closedTable1.ajax.reload(null, false );
                }, 15000 );

            }

        );
        $('#allClick').click(function(){
                AllTable1.ajax.reload(null, false );
                clearInterval(timerOpen);
                clearInterval(timerClosed);
                clearInterval(timerReturn);
                timerAll = setInterval( function () {
                    AllTable1.ajax.reload(null, false );
                }, 15000 );

            }
        );

        $('#retrunClick').click(function(){
                returnTable1.ajax.reload(null, false );
                clearInterval(timerOpen);
                clearInterval(timerClosed);
                clearInterval(timerAll);
                timerReturn = setInterval( function () {
                    returnTable1.ajax.reload(null, false );
                }, 15000 );

            }
        );

        //trigger click event when page load
        $( "#openClick" ).click();





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
                { "data": "Amount" },

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
        AllTable1.on("click","." + ajaxModelButton,function() {
            var rowData = AllTable1.row($(this).parents('tr')).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });


        closedTable1.on("click","." + ajaxModelButton,function() {
            var rowData = closedTable1.row($(this).parents('tr')).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });


        openTable1.on("click","." + ajaxModelButton,function(){
            var rowData = openTable1.row( $(this).parents('tr') ).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });

        returnTable1.on("click","." + ajaxModelButton,function(){
            var rowData = returnTable1.row( $(this).parents('tr') ).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });





    });

</script>




