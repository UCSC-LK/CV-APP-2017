<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <div class="row page-header" style="margin:8px 0px 20px">
            <div class="col-lg-9">
                <h1 >
                    Card <small>Details</small>
                </h1>
            </div>
        </div>




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
                                <th>Ref Name</th>
                                <th>Reo Name</th>
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
                                <th>Return Date</th>
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

        <div id="viewCardLoadDiv"></div>


    </div>

    <!--full card view php include-->
    <?php include('viewCard.php') ?>
    <!--end of full card view include -->


</div><!--do not remove -->

<script>

    /*

    Need to reset model close save button and etc

     */


    $(document).ready(function() {



        var fullCardModel = $('#fullCardModel');


        //var fullCard =  '<a class="btn btn-success btn-sm"  id="fullCardModel" data-toggle="modal" data-target="#fullCardModel" style = "margin-right:10px;"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>';
       //// var fullCard =  '<a class="btn btn-success btn-xs ajaxModel"  id="fullCardModelButton"  style = "margin-right:10px;"> View</span></a>';
       /// var deleteButton =  '<a class="btn btn-danger btn-xs ajaxDelete" style = "margin-right:10px;"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
        var returnButton = '<a class="btn btn-warning btn-xs ajaxReturn"> Return </a>';

        var removeCard =  '<a class="btn btn-danger btn-xs ajaxRemove" style = "margin-right:10px;">Remove</a>';


       //// var ajaxModelButton = "ajaxModel";

////       var ajaxDelete2 = "ajaxDelete";
        var ajaxReturn2 = "ajaxReturn";
       //// var ReoCode     = $('#ReoCode');
        var ajaxRemove2 = "ajaxRemove";

      ///  var editButton1 = $('#editButton');

        var openTable1 = $('#openTable').DataTable({

            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getAllOpenCard";
                    d.branchID =  branchId;
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

//        // for card entry delete
//        var reoId;
//        // card id for update reo
//        var cardId ='';


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


        // model table
        var cardPayment = $('#cardPayment').DataTable({
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
                { "data": "Ref_ID" },
                { "data": "C_ID" },
                {   "data": null,
                    "defaultContent": fullCard + 123
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


//        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
//            ReoCode.selectList({
//                helpText : 'Select collector',
//                dataArray : data
//            });
//            //ReoCode.selectpicker();     // call plugin
//
//        });
//
//
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
//                { "data": "Amount" },
//                {   "data": null,
//                    "defaultContent": deleteButton
//                }
//
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
//                reoId = data.Collector_ID;
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
//


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


//        collectionTable2.on("click","." + ajaxDelete2,function(){
//            var rowData = collectionTable2.row( $(this).parents('tr') ).data();
//            if(confirm("Do you really want to delete record ?" + rowData["Timestamp"])){
//                var thisRow = $(this).parents('tr');
//                var para = '&Cd_ID=' + rowData['Cd_ID'] + '&Timestamp=' + rowData['Timestamp'] + '&Amount=' + rowData['Amount'] + '&Reoid=' + reoId ;
//                ajaxSend(para,"deleteRow",thisRow);
//            }
//        });




//        var reoIdDchange1 = $('#reoIdDchange');
//        var reoIdDefault1 = $('#reoIdDefault');
//        var saveButton1   = $('#saveButton');
//
//        //model related
//        editButton1.click(function(){
//            reoIdDefault1.hide();
//            reoIdDchange1.show();
//            saveButton1.show();
//            editButton1.hide();
//
//        });
//        saveButton1.click(function(){
//            if (validationPass = $("#fullCardForm").valid()){
//
//                var para = '&Cd_ID=' + cardId + '&Reoid=' + $('#ReoCode').val();
//                //alert(para)
//                ajaxSend(para,"updateReo");
//
//            }
//        });
        openTable1.on("click","." + ajaxReturn2,function(){
            var rowData = openTable1.row( $(this).parents('tr') ).data();
            if(confirm("Do you really want to set this card as return ?" + rowData["Cd_ID"])){
                var thisRow = $(this).parents('tr');
                var para = '&Cd_ID=' + rowData['Cd_ID'] + '&Ref_ID=' + rowData['Ref_ID'] + '&C_ID=' + rowData['C_ID']+ '&B_ID=' + rowData['B_ID'] + '&P_ID=' + rowData['P_ID'];
                //openTable1.row(thisRow).remove().draw();
                alert(para);
                ajaxSend(para,"returnCard",thisRow);
            }
        });


        AllTable1.on("click","." + ajaxRemove2,function(){
            var rowData = AllTable1.row( $(this).parents('tr') ).data();
            if(confirm("Do you really want remove this card ?" + rowData["Cd_ID"])){
                var thisRow = $(this).parents('tr');
                var para = '&Cd_ID=' + rowData['Cd_ID'];
                alert(rowData["Cd_ID"]);
                ajaxSend(para,"removeCard",thisRow);
            }
        });







        function ajaxSend(params,action,clickRow){
            $.ajax({
                type: "POST",
                url: "../../controllers/collectionManagement/collectionManagement.php",
                data : params+"&action="+action+"&User_ID="+userId,
                dataType: "json",
                success: function(response){
                    switch (action){
//                        case "deleteRow":
//                            if(response.success == 1){
//                                collectionTable2.row(clickRow).remove().draw();
//                            }else{
//                                alert("Unexpected error #2, Please try again")
//                            }
//                            break;
//
//                        case "updateReo":
//                            if(response.success == 1){
//                                $('#reoCode').html(response.id);
//                                editButton1.show();
//                                reoIdDefault1.show();
//                                reoIdDchange1.hide();
//                                saveButton1.hide();
//
//                            }else{
//                                alert("Unexpected error #2, Please try again")
//                            }
//                            break;

                        case "returnCard":
                            if(response.success == 1){
                                alert("Return Complete");
                                openTable1.row(clickRow).remove().draw();
                                //alert(response.id);


                            }else{
                                alert("Unexpected error #3, Please try again")
                            }
                            break;

                        case "removeCard":
                            if(response.success == 1){
                                alert("Remove Complete");
                                AllTable1.row(clickRow).remove().draw();
                                //alert(response.id);

                            }else{
                                alert("Unexpected error #4, Please try again")
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
            openTable1.ajax.reload( null, false );
            closedTable1.ajax.reload( null, false );
            AllTable1.ajax.reload( null, false );
            returnTable1.ajax.reload( null, false );


            //update the view card - change collector option list
            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID :branchId }, function( data ) {
                ReoCodeUpdate.selectList({
                    helpText : 'Select collector',
                    dataArray : data
                });
            });

        });

    });

</script>




