<div class="row">

    <div class="row page-header" style="margin:8px 0px 20px">
        <div class="col-lg-9">
            <h1 >
                Collector <small>Summary</small>
            </h1>
        </div>
    </div>

    <form id="collectorForm">
        <div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="collectorname">Collector Name</label>
                    <select class="form-control" id="collectorname" name="collectorname">
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group col-md-5">
                    <label for="CurrentDatestart">From</label>
                    <div id="datetimepicker1" class="input-append date">
                        <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                        <input data-format="yyyy-MM-dd" id="currentDateStart" name="currentDateStart" type="text">
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <label for="CurrentDatestart">To</label>
                    <div id="datetimepicker2" class="input-append date">
                        <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                        <input data-format="yyyy-MM-dd" id="currentDateEnd" name="currentDateEnd" type="text">
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label for="CurrentDatestart" style="opacity: 0;margin: 0;padding: 0">submit</label>
                    <input type="button" class="btn btn-default btn-success" value="Submit" id="collectorSubmit">
                </div>
            </div>
        </div>
    </form>
</div>


    <div class="col-md-8">
        <div>
            <table id="collectorSummary" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Collection</th>
                    <th>No Cards</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <div class="row ">
                <div class="col-md-4">
                    <label>Collector Name</label>
                </div>
                <div class="col-md-1">
                    <label>:</label>
                </div>
                <div class="col-md-6 text-left">
                    <label id="collectorName" ></label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row ">
                <div class="col-md-4">
                    <label>Total Collection</label>
                </div>
                <div class="col-md-1">
                    <label>:</label>
                </div>
                <div class="col-md-6 text-left">
                    <label id="tCollection" ></label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row ">
                <div class="col-md-4">
                    <label>Total Cards</label>
                </div>
                <div class="col-md-1">
                    <label>:</label>
                </div>
                <div class="col-md-6 text-left">
                    <label id="totalCards" ></label>
                </div>
            </div>
        </div>
    </div>

<script>

    $('#collectorForm').validate({
        rules: {
            collectorname: {
                required: true
            },
            currentDateStart:{
                required: true
            },
            currentDateEnd:{
                required: true
            }

        }
    });

    //var branchID = 'aa';
    var collectorSumry = null;

    var cID = '',date1 = '',date2 = '';

    var deleteButton =  '<a class="btn btn-xs btn-danger cDelete" style = "margin-right:10px;"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
    var collectorDelete = "cDelete";


    $(document).ready(function(){



        var cSumryTable = $('#collectorSummary').DataTable({
            ajax: {
                url: '../../controllers/DBfunctions/JsonAPI.php',
                dataSrc: '',
                "data"   : function( d ) {
                    d.functionName =  "getCollectorSummary";
                    d.cID =  cID;
                    d.date1 = date1;
                    d.date2 = date2
                }
            },

            "columns": [
                { "data": "cdate" },
                { "data": "Total_Collection" },
                { "data": "No_Of_Card" }
            ]

        });



        $("#collectorSubmit").click(function(){
            var formval = $('#collectorForm').valid();
            if(formval){
                cID = $('#collectorname').val();
                date1 = $('#currentDateStart').val();
                date2 = $('#currentDateEnd').val();
                getCollectorSummary(cID,date1,date2,"collectorSummary");

                cSumryTable.ajax.reload( null, false );
            }
        });


        function getCollectorSummary(cID,date1,date2,action){
            $.ajax({
                type:"POST",
                url: "../../controllers/summary/collectorSummary.php",
                data: "&action="+action+"&cID="+cID+"&date1="+date1+"&date2="+date2,
                dataType: "json",
                success:function(response){
                   if(response.success == 1){
                       var collectorSum = jQuery.parseJSON(response.sum);
                       var collectorName = jQuery.parseJSON(response.cID);
                       //console.log(collectorName);
                       $('#tCollection').html(collectorSum[0]['TCollection']);
                       $('#totalCards').html(collectorSum[0]['NCards']);
                       $('#collectorName').html(collectorName[0]['U_Name']);
                   }
                    else{
                       alert("no")
                   }
                }
            });
        }

        $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchCollectorList",branchID:branchId}, function( data ) {
            $('#collectorname').selectList({
                helpText : 'Select Collector',
                dataArray : data
            });

        });

        $(function() {
            $('#datetimepicker1,#datetimepicker2').datetimepicker({
                language: 'us',
                pickTime: false
            });
        });

    });

</script>