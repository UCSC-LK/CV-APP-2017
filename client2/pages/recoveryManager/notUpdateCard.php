
<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <div class="row page-header" style="margin:8px 0px 20px">
            <div class="col-lg-4">
                <h1 >
                    Not Update <small>Card</small>
                </h1>
            </div>

<!--            //fix this-->
            <div class="col-lg-4">
                <h1  style="display: none" >
                    Total Card : <span id="totalCard"></span>
                </h1>
            </div>




        </div>

        <div class="col-md-10 col-md-offset-1">
            <form id="arrearsForm">

                <div class="form-group col-md-3">
                    <label for="ReoCode">Select Collector</label>
                    <select class="form-control "  data-live-search="true"  id="ReoCode" name="ReoCode"></select>
                </div>

                <div class="form-group col-md-3">
                    <label for="vehicleType">No Of Days</label>
                    <select class="form-control" data-live-search="true" id="checkdays" name="checkdays">
                        <option value="">Select no of days</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>

            </form>
        </div>



        <div class="col-md-12">

            <div id = "results"></div>
            </br>

            <div>
                <h3>Full Arrears Report</h3>
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
        </div>


        <!--full card view php include-->
        <?php include('viewCard.php') ?>
        <!--end of full card view include -->


    </div>

</div><!--do not remove -->

<script>


    $('#arrearsForm').validate({
        rules: {
            ReoCode:{
                required: true
            }
        }
    });


    //    var User_ID = 'temp';
    //    var branchId = "aa"; // initial tab branch id

    $(document).ready(function() {


        var ReoCode     = $('#ReoCode');

        var checkDays = $('#checkdays');


       // var fullCard =  '<a class="btn btn-success btn-sm ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';
       // var fullCardModel = $('#fullCardModel');
       // var ajaxModelButton = "ajaxModel";
        // var cardId ='';

        var reoID = '-99';
        var checkDay = '5';

        var table1 = $('#newCardTabel').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getNopaidCardAlertByDate";
                    d.branchID =  branchId;
                    d.reoID = reoID;
                    d.checkDay  = checkDay
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


        //on page load total card
        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getNotUpdateCardCountCheckDaysDays",branchID :branchId,reoID:reoID,checkDay:checkDay}, function( data ) {
            $('#totalCard').html(data);
        });

//
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

        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
            ReoCode.selectList({
                helpText : 'Select collector',
                dataArray : data
            });


        });


        //for collector change and reload table
        ReoCode.on( "change",function() {

            reoID = ReoCode.val();
            checkDay = checkDays.val();
            table1.ajax.reload( null, false );

            //fix this
//            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getNotUpdateCardCountCheckDaysDays",branchID :branchId,reoID:reoID,checkDay:checkDay}, function( data ) {
//                $('#totalCard').html(data);
//            });


        });



        //days function


        //for date change and reload table
        checkDays.on( "change",function() {

            reoID = ReoCode.val();
            checkDay = checkDays.val();
            if (reoID == '' | reoID == null ){
                reoID = '-99'
            }
            //console.log(reoID);
            table1.ajax.reload( null, false );

            //fix this
//            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getNotUpdateCardCountCheckDaysDays",branchID :branchId,reoID:reoID,checkDay:checkDay}, function( data ) {
//                $('#totalCard').html(data);
//            });

        });





        /////// - header
        var branch = $('#Branch');

        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchList"}, function( data ) {
            branch.selectList({
                helpText : 'Select your branch',
                dataArray : data
            });

            //set the current value of the globel branchId
            branch.val(branchId);

        });


        checkDays.val(checkDay);



        //branch change and reload table
        branch.on( "change",function() {
            // set globel branch Id value
            branchId = branch.val();

            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
                ReoCode.selectList({
                    helpText : 'Select collector',
                    dataArray : data
                });
            });

            //rest data
            reoID = '-99';
            checkDay = '5';


            table1.ajax.reload( null, false );


            //update the view card - change collector option list
            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
                ReoCodeUpdate.selectList({
                    helpText : 'Select collector',
                    dataArray : data
                });
            });

//fix this
//            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getNotUpdateCardCountCheckDays",branchID :branchId,reoID:reoID,checkDay:checkDay}, function( data ) {
//                console.log(data);
//                $('#totalCard').html(data);
//            });




        });





    } );






</script>




