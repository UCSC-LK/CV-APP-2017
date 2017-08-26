
<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <div class="row page-header" style="margin:8px 0px 20px">
            <div class="col-lg-3">
                <h1 >
                    Unpaid <small>Card</small>
                </h1>
            </div>

            <div class="col-lg-4">
                <h1 >
                    Total Arrears : <span id="totalArrears"></span>
                </h1>
            </div>


        </div>

        <div class="col-md-10 col-md-offset-1">
            <form id="arrearsForm">

                <div class="form-group col-md-3">
                        <label for="ReoCode">Reo:Code</label>
                        <select class="form-control "  data-live-search="true"  id="ReoCode" name="ReoCode"></select>
                </div>

                <div class="form-group col-md-3">
                    <label for="CurrentDatestart">From</label>
                    <div id="datetimepicker1" class="input-append date">
                        <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                        <input data-format="yyyy-MM-dd" id="currentDateStart" name="currentDateStart" type="text">
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="CurrentDatestart">To</label>
                    <div id="datetimepicker2" class="input-append date">
                        <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                        <input data-format="yyyy-MM-dd" id="currentDateEnd" name="currentDateEnd" type="text">
                    </div>
                </div>

                <div class="form-group col-md-2" style="margin-top: 17px;">
                    <input type="button" class="btn btn-default btn-success" value="Submit" id="collectorSubmit">
                </div>

            </form>
        </div>



        <div class="col-md-12">

            <div id = "results"></div>
            </br>

            <div id="selectDateNotUpdateCard" style="display: none;">
                <h3>Not Collected Card</h3>
                <table id="selectDateNotUpdateCardTable" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Card ID</th>
                        <th>Collector Name</th>
                        <th>Open Date</th>
                        <th>Price</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Arrears</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>

            <div id="DailySummary" style="display: none;">
                <h3>Dialy Arrears Report</h3>
                <table id="DailyArrearsTable" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Card</th>
                        <th>Collected Card</th>
                        <th>Not Collected Card</th>
                        <th>Total Amount</th>
                        <th>Collected Amount</th>
                        <th>Not Colleted Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>

            <div>
                <h3>ALL Arrears Card</h3>
                <table id="newCardTabel" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Card ID</th>
                        <th>Collector Name</th>
                        <th>Open Date</th>
                        <th>Price</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Arrears</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>

            </div>

            <!--full card view php include-->
            <?php include('viewCard.php') ?>
            <!--end of full card view include -->




        </div>


    </div>

</div><!--do not remove -->

<script>


    $('#arrearsForm').validate({
        rules: {
            currentDateStart:{
                required: true
            },
            currentDateEnd:{
                required: true
            },
            ReoCode:{
                required: true
            }
        }
    });


    //    var User_ID = 'temp';
    //    var branchId = "aa"; // initial tab branch id

    $(document).ready(function() {


        var ReoCode     = $('#ReoCode');

       // var fullCard =  '<a class="btn btn-success btn-sm ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';

        var viewCards =  '<a class="btn btn-success btn-sm currentDateButton"   style = "margin-right:10px;"> View Card</span></a>';

        //var fullCardModel = $('#fullCardModel');
        //var ajaxModelButton = "ajaxModel";

        var currentDateButton1 = "currentDateButton";

        //var cardId ='';

        var reoID = '';
        var date1 = '';
        var date2 = '';

        var checkDate = '';




        var table1 = $('#newCardTabel').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getNopaidCardAlertReo";
                    d.branchID =  branchId;
                    d.reoID = reoID
                }
            },

            "columns": [
                { "data": "Cd_ID" },
                { "data": "CollectorName" },
                { "data": "Timestamp" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "DueAmount" },
                { "data": "Balance",
                    "render":function(data){
                        return '<h4> <span class="label label-danger">'+ parseFloat(data).toFixed(2)+'</span> </h4>' ;
                    }
                },
                {   "data": null,
                    "defaultContent": fullCard
                }



            ]

        });

        var table2 = $('#DailyArrearsTable').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getSummaryOfCollection";
                    d.branchID =  branchId;
                    d.reoID = reoID;
                    d.date1 = date1;
                    d.date2 = date2;
                }
            },

            "columns": [
                { "data": "Datee" },
                { "data": "totalCard" },
                { "data": "collectedNoOfCard" },
                { "data": "cardDifferent",
                    "render":function(data){
                        return '<h4> <span class="label label-danger">'+ data+'</span> </h4>' ;
                    }
                },
                { "data": "TotalTarget" },
                { "data": "collectedAmount" },
                { "data": "amountDifferent",
                    "render":function(data){
                        return '<h4> <span class="label label-danger">'+ parseFloat(data).toFixed(2)+'</span> </h4>' ;
                    }
                },
                {   "data": null,
                    "defaultContent": viewCards
                }
            ]

        });

        var table3 = $('#selectDateNotUpdateCardTable').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getNotCollectedCardAlertReoSelectDate";
                    d.branchID =  branchId;
                    d.reoID = reoID;
                    d.datee = checkDate
                }
            },

            "columns": [
                { "data": "Cd_ID" },
                { "data": "CollectorName" },
                { "data": "Timestamp" },
                { "data": "Value" },
                { "data": "Current_Total" },
                { "data": "DueAmount" },
                { "data": "Balance",
                    "render":function(data){
                        return '<h4> <span class="label label-danger">'+ parseFloat(data).toFixed(2)+'</span> </h4>' ;
                    }
                },
                {   "data": null,
                    "defaultContent": fullCard
                }



            ]

        });



//        //full card deatiles
//        // givin card id load the all collection
//        var collectionTable2 = $('#collectionTable').DataTable({
//            ajax: {
//                url: '../../controllers/DBfunctions/JsonAPI.php',
//                dataSrc: '',
//                "data"   : function( d ) {
//                    d.functionName =  "getAllCollectionCardId";
//                    d.cardId =  cardId;
//                }
//            },
//
//            "columns": [
//                { "data": "Timestamp" },
//                { "data": "Amount" }
//
//            ]
//
//        });


//
//        function cardCreator(cardID){
//            // get all information for givin bill number
//            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getAllInfoCardId",cardId :cardId }, function( data ) {
//                //modelTitle
//                $('#modeTitle1').html("Card :   " + data.Cd_ID);
//                $('#refCode').html( data.Ref_ID);
//                $('#reoCode').html(data.Collector_ID);
//                $('#productPrice').html(data.Value);
//                $('#downPayment').html(data.Down_Payment);
//                $('#dailyPayment').html(data.Daily);
//                $('#currentTotal').html(data.Current_Total);
//                $('#customerName').html(data.C_Name);
//                $('#address').html(data.C_Address);
//                $('#businessName').html(data.C_Business_Name);
//                $('#landNumber').html(data.C_Landphone);
//                $('#productName').html(data.P_Name);
//                $('#mobileNumber').html(data.C_Telephone);
//                cardId = data.Cd_ID;
//            });
//
//            //reload data table in the model
//            collectionTable2.ajax.reload(null, false );
//            //model load
//            fullCardModel.modal('toggle')
//
//
//        }


        // get the id add call card create function
        table1.on("click","." + ajaxModelButton,function() {
            var rowData = table1.row($(this).parents('tr')).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });

        // get the id add call card create function
        table3.on("click","." + ajaxModelButton,function() {
            var rowData = table3.row($(this).parents('tr')).data();
            cardId = rowData["Cd_ID"];
            cardCreator(cardId);
        });



        table2.on("click","." + currentDateButton1,function() {
            $('#selectDateNotUpdateCard').slideUp( "slow" );
            var rowData = table2.row($(this).parents('tr')).data();
            // set selected date for variable and reload tabale
            checkDate = rowData["Datee"];
            table3.ajax.reload( null, false );
            $('#selectDateNotUpdateCard').slideDown( "slow" );
            //alert(checkDate);
        });



        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
            ReoCode.selectList({
                helpText : 'Select collector',
                dataArray : data
            });
            //ReoCode.selectpicker();     // call plugin

        });




        function ajaxSend(params,action,clickRow){
            $.ajax({
                type: "POST",
                url: "../../controllers/cardAndCustomerManagement/cardUserManagement.php",
                data : params+"&action="+action+"&User_ID="+userId,
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



        var branch = $('#Branch');

        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchList"}, function( data ) {
            branch.selectList({
                helpText : 'Select your branch',
                dataArray : data
            });

            //set the current value of the globel branchId
            branch.val(branchId);

        });



        //branch change and reload table
        branch.on( "change",function() {
            // set globel branch Id value
            branchId = branch.val();


            //update select collector list
            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
                ReoCode.selectList({
                    helpText : 'Select collector',
                    dataArray : data
                });
            });


            //update the view card - change collector option list
            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
                ReoCodeUpdate.selectList({
                    helpText : 'Select collector',
                    dataArray : data
                });
            });


        });


        //for collector change and reload table
        ReoCode.on( "change",function() {

            reoID = ReoCode.val();
            $('#selectDateNotUpdateCard').slideUp( "slow" );
            $('#DailySummary').slideUp( "slow" );
            table1.ajax.reload( null, false );

            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getTotalBranchNotPaidReo",branchID :branchId,reoID:reoID}, function( data ) {
                $('#totalArrears').html(data);
            });


        });




        $(function() {
            $('#datetimepicker1,#datetimepicker2').datetimepicker({
                language: 'us',
                pickTime: false
            });
        });


        $("#collectorSubmit").click(function(){
            if($('#arrearsForm').valid()){
                date1 = $('#currentDateStart').val();
                date2 = $('#currentDateEnd').val();
                reoID = ReoCode.val();
                //alert(date1+date2+reoID);
                table2.ajax.reload( null, false );
                $('#selectDateNotUpdateCard').slideUp( "slow" );
                $('#DailySummary').slideDown( "slow" );
                //getCollectorSummary(cID,date1,date2,"collectorSummary");
            }
        });
    } );






</script>




