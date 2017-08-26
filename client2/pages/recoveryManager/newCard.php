
<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <div class="row page-header" style="margin:8px 0px 20px">
            <div class="col-lg-12">
                <h1 >
                    New <small>Card</small>
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
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>

            </div>

        </div>


    </div>

</div><!--do not remove -->

<script>


//    var User_ID = 'temp';
//    var branchId = "aa"; // initial tab branch id

    $(document).ready(function() {

        var doneButton =  '<a class="btn btn-success btn-sm ajaxDone"   style = "margin-right:10px;"> Done</a>';


        var ajaxDoneButton = "ajaxDone";

        var table1 = $('#newCardTabel').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getNewCardAlert";
                    d.branchID =  branchId
                }
            },

            "columns": [
                { "data": "Cd_ID" },
                { "data": "Collector_ID" },
                { "data": "Timestamp" },
                {   "data": null,
                    "defaultContent": doneButton
                }
            ]

        });


        //table delete button
        table1.on("click","." + ajaxDoneButton,function(){
            var rowData = table1.row( $(this).parents('tr') ).data();
            if(confirm("Do you really want to Close This card ?" + rowData["Cd_ID"])){
                var thisRow = $(this).parents('tr');
                ajaxSend("cid="+ rowData["Cd_ID"],"removeNewCardAlert",thisRow);
            }


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




    } );






</script>
