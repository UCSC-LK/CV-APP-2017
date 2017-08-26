<div class="row "> <!--do not remove this -->


    <div class="row page-header" style="margin:8px 0px 20px">
        <div class="col-lg-9">
            <h1>
                Load <small>Sheet</small>
            </h1>
        </div>

    </div>

    <div class="load-sheet">
        <form id="loadSheetForm">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="refname">Ref Name</label>
                        <select class="form-control" id="refname" name="refname">
                            <option value="">Select Ref Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="CurrentDatestart">Select Date</label>
                        <div id="datetimepicker1" class="input-append date">
                            <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                            <input data-format="yyyy-MM-dd" id="currentDateStart" name="currentDateStart" type="text"> </input>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="salesheet_submit_btn" style="display:block;opacity: 0">Select Date</label>
                        <button type="button" id = "salesheet_submit_btn" name="salesheet_submit_btn" class="btn btn-success" value="Submit">Submit</button>
                    </div>

                </div>
            </div>

        </form>



    </div>

<!--    <script src='../../../assets/pdf/pdfmake.min.js'></script>-->
<!--    <script src='../../../assets/pdf/vfs_fonts.js'></script>-->

    <script>

        $("#loadSheetForm").validate({
            rules: {
                refname: {
                    required: true
                },
                currentDateStart:{
                    required: true
                }

            }

        });

        function createSheet(data){

            var missing = data["missing"];

            var firstRow = [
                { text: 'No.', style: 'tableHeader', fillColor: '#646464'}, { text: 'Product', style: 'tableHeader', fillColor: '#646464'}, { text: 'Loading', style: 'tableHeader', fillColor: '#646464'}, { text: 'Sold',style: 'tableHeader', fillColor: '#646464'}, { text: 'Unloading', style: 'tableHeader', fillColor: '#646464'}
            ];

            var missingRow = [
                { text: 'No.', style: 'tableHeader', fillColor: '#646464'}, { text: 'Item', style: 'tableHeader', fillColor: '#646464'}, { text: 'Selling Price', style: 'tableHeader', fillColor: '#646464'}, { text: 'Quantity', style: 'tableHeader', fillColor: '#646464'}, { text: 'Value',style: 'tableHeader', fillColor: '#646464'}
            ];

            function missingTopic(data){
                if (missing.length != 0)
                {
                    return buildTopic(data);
                }
                else {
                    return '';
                }
            }

            function buildTopic(data){
                return {
                    style: 'tableExample',
                    table: {
                        widths: ['*'],
                        body: [[{ text: '' + data, style: 'subheader', fillColor: '#C8DCFF' }]]

                    },
                    layout: 'noBorders'
                }

            }

            function buildMissing(data, columns){
                var body = [];

                body.push(columns);

                var tot_sales = 0;
                var tot_quantity = 0;
                var no = 1;
                data.forEach(function(row) {
                    var dataRow = [];

                    tot_sales = tot_sales + parseFloat(row['Value']);
                    tot_quantity = tot_quantity + Number(row['Quantity']);


                    dataRow.push({ text: no.toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: row['P_Name'].toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: parseFloat(row['P_Selling_Price']).toFixed(2), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: row['Quantity'].toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: parseFloat(row['Value']).toFixed(2), alignment: 'right', fontSize: 10});
                    body.push(dataRow);

                    no = no + 1;
                });
                var lastRow =  [
                    { colSpan: 3, text: 'Total', style: 'tableHeader', alignment: 'right', fillColor: '#646464'}, { text: '', style: 'tableHeader', fillColor: '#646464'}, { text: '',  alignment: 'right', style: 'tableHeader', fillColor: '#646464'}, { text: '0',  alignment: 'right', style: 'tableHeader', fillColor: '#646464'}, { text: '0',  alignment: 'right', style: 'tableHeader', fillColor: '#646464'}
                ];

                lastRow[3]["text"] = "" + tot_quantity.toString();
                lastRow[4]["text"] = "" + tot_sales.toFixed(2);
                body.push(lastRow);
                return body;
            }


            function buildTableBody(data, columns) {
                var body = [];

                var data_sheet = data['load'];

                body.push(columns);

                var tot_load = 0;
                var tot_sold = 0;
                var tot_unload = 0;
                var no = 1;

                data_sheet.forEach(function(row) {
                    var dataRow = [];

                    var sold;
                    var unload = 0;

                    if (row['Sold']){
                        sold = Number(row['Sold']);
                    }
                    else{
                        sold = 0;
                    }

                    if (data['user'][0]['count'] == 0){
                        unload = Number(row['Quantity']) - sold;
                    }
                    else{
                        unload = 0;
                    }


                    dataRow.push({ text: no.toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: row['P_Name'].toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: row['Quantity'].toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: sold.toString(), alignment: 'right', fontSize: 10});
                    dataRow.push({ text: unload.toString(), alignment: 'right', fontSize: 10});

                    no = no + 1;
                    tot_load = tot_load + Number(row['Quantity']);
                    tot_sold = tot_sold + sold;
                    tot_unload = tot_unload + unload;


                    body.push(dataRow);
                });
                var lastRow =  [
                    { colSpan: 2, text: 'Total', style: 'tableHeader', alignment: 'right', fillColor: '#646464'}, { text: '', style: 'tableHeader', fillColor: '#646464'}, { text: '',  alignment: 'right', style: 'tableHeader', fillColor: '#646464'}, { text: '0',  alignment: 'right', style: 'tableHeader', fillColor: '#646464'}, { text: '', alignment: 'right', style: 'tableHeader', fillColor: '#646464'}
                ];

                lastRow[2]["text"] = "" + tot_load.toString();
                lastRow[3]["text"] = "" + tot_sold.toString();
                lastRow[4]["text"] = "" + tot_unload.toString();
                body.push(lastRow);
                return body;
            }

            function tableLoad(data, columns) {
                return {
                    table: {
                        headerRows: 1,
                        widths: [40,'*','*','*', '*'],
                        body: buildTableBody(data, columns)
                    }
                };
            }

            function tableMissing(data, columns) {
                if (missing.length != 0)
                {
                    return {
                        table: {
                            headerRows: 1,
                            widths: [40, '*', '*', '*', '*'],
                            body: buildMissing(data, columns)
                        }
                    };
                }
                else {
                    return '';
                }
            }


            var load_sheet = {
                content: [
                    { text: 'Selikno Holding (Pvt.) Ltd.', style: 'header', alignment: 'center' },
                    { text: 'THE WAY TO SUCCESS', style: 'subheader', alignment: 'center'},
                    { text: 'No. 65, Palm Grove AV, 3rd Lane, Rathmalana', style: "address", alignment: "center" },
                    '\n',
                    buildTopic('Load/Unload Sheet'),
                    '\n',
                    'Rep Name   :  ' + data["user"][0].U_Name,
                    'Vehicle No. :  ' + data["vehicle"][0].V_Number,
                    'Date             :  ' + new Date($('#currentDateStart').val()).toLocaleDateString(),
                    '\n',
                    '\n',

                    tableLoad(data, firstRow),
                    '\n',
                    '\n',
                    missingTopic('Missing Item Summary'),
                    '\n',
                    tableMissing(missing, missingRow),
                    '\n',
                    '\n',

                    {
                        columns: [
                            {
                                width: 90,
                                text: ''
                            },
                            {
                                width: '*',
                                text: '...................................',
                                alignment: 'center'
                            },
                            {
                                width: '*',
                                text: '...................................',
                                alignment: 'center'
                            },
                            {
                                width: 90,
                                text: ''
                            }
                        ],

                    },

                    {
                        columns: [
                            {
                                width: 90,
                                text: ''
                            },
                            {
                                width: '*',
                                text: 'Rep Signature',
                                alignment: 'center'
                            },
                            {
                                width: '*',
                                text: 'Issuing Officer',
                                alignment: 'center'
                            },
                            {
                                width: 90,
                                text: ''
                            }
                        ]
                    }

                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 0, 0, 0]
                    },
                    subheader: {
                        fontSize: 14,
                        bold: true,
                        margin: [0, 0, 0, 0]
                    },
                    address: {
                        fontSize: 9,
                        margin: [0, 0, 0, 0]
                    },
                    tableExample: {
                        margin: [0, 5, 0, 15]
                    },
                    tableHeader: {
                        alignment: 'center',
                        bold: true,
                        fontSize: 13,
                        color: 'black'
                    }
                },
                defaultStyle: {
                    // alignment: 'justify'
                }

            }
            pdfMake.createPdf(load_sheet).print();
        }


        $(document).ready(function(){

            var refID;
            var date;



            $('#salesheet_submit_btn').click(function(){
                var formval = $('#loadSheetForm').valid();
                if(formval){
                    refID = $('#refname').val();
                    date = $('#currentDateStart').val();
                    $.getJSON("../../controllers/DBfunctions/JsonAPI.php", {functionName: "getLoadSheet", dateTime: date, empCode: refID}, function (data){
                        if(data["success"]){
                            createSheet(data);
                        }
                        else{
                            alert("No data to show");
                        }
                    })
                }
            });



            $.getJSON( "../../controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchRefList", branchID:branchId}, function( data ) {
                $('#refname').selectList({
                    helpText : 'Sales Representative',
                    dataArray : data
                });

            });

            $(function() {
                $('#datetimepicker1').datetimepicker({
                    language: 'us',
                    pickTime: false
                });
            });


        });




      







    </script>

</div><!--do not remove -->





