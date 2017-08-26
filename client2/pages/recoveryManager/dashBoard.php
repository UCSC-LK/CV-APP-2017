<div class="block-header">
    <h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
           <div class="row clearfix">
               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="info-box bg-pink hover-expand-effect">
                       <div class="icon">
                           <i class="material-icons">playlist_add_check</i>
                       </div>
                       <div class="content">
                           <div class="text">Total Month Sales</div>
                           <div  id="saleCount"></div>
                           <!-- todo -->
                           <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="info-box bg-cyan hover-expand-effect">
                       <div class="icon">
                           <i class="material-icons">help</i>
                       </div>
                       <div class="content">
                           <div class="text">Total Active Card</div>
                           <div  id="activeCard"></div>
                           <!-- <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div> -->
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="info-box bg-light-green hover-expand-effect">
                       <div class="icon">
                           <i class="material-icons">forum</i>
                       </div>
                       <div class="content">
                           <div class="text">Last five days not update</div>
                           <div  id="fiveDaysNotUpdate"></div>
                           <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                       </div>
                   </div>
               </div>

               <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                 <li class="list-group-item" style="display: none">
                     <label for="Branch">Branch</label>
                     <select class="form-control" id="Branch" name="Branch"></select>
                 </li>

                 <div class="list-group-item">
                     <!-- <label for="CurrentDatestart">Month</label> -->
                     <div id="datetimepicker1" class="input-append date">
                         <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                         <input data-format="yyyy-MM" id="checkMonth" name="checkMonth" type="text"> </input>
                     </div>
                 </div>

                 <div class="list-group-item">
                   <button type="button" id="dashBoardRefreshButton" class="btn btn-success waves-effect btn-block btn-xs">SUCCESS</button>
                     <!-- <a class="btn btn-success btn-xs" id="dashBoardRefreshButton" style="width: 100%"> Refresh</span></a> -->
                 </div>
               </div>


           </div>
           <!-- #END# Widgets -->

           <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <!-- <div id="real_time_chart" class="dashboard-flot-chart"></div> -->
                        <div id="salesGraph" style=" height: 300px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->


      <!-- CPU Usage -->
     <div class="row clearfix">
         <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
             <div class="card">
                 <div class="body">
                     <!-- <div id="real_time_chart" class="dashboard-flot-chart"></div> -->
                     <div id="percentagePie" style="height: 400px; max-width: 600px; margin: 0 auto;margin-bottom: 3px;"></div>
                 </div>
             </div>
         </div>

         <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
             <div class="card">
                 <div class="body">
                     <!-- <div id="real_time_chart" class="dashboard-flot-chart"></div> -->
                   <div id="refSaleMonth" style="height: 400px; max-width: 600px; margin: 0 auto"></div>
                 </div>
             </div>
         </div>
     </div>
     <!-- #END# CPU Usage -->

     <!-- CPU Usage -->
  <div class="row clearfix">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
              <div class="body">
                  <!-- <div id="real_time_chart" class="dashboard-flot-chart"></div> -->
                  <div id="TotalMonthSalesGraph" style=" height: 300px; margin: 0 auto"></div>
              </div>
          </div>
      </div>
  </div>
  <!-- #END# CPU Usage -->

  <!-- CPU Usage -->
<div class="row clearfix">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div class="card">
           <div class="body">
               <!-- <div id="real_time_chart" class="dashboard-flot-chart"></div> -->
               <div id="collectionGraph" style="height: 300px; margin: 0 auto"></div>
           </div>
       </div>
   </div>
</div>
<!-- #END# CPU Usage -->



<script type="text/javascript">

    var selectMonth ;


    function converter(data){
        var keys;
        for(keys in data) {
            data[keys].y = parseInt(data[keys].y);
        }
        return data
    }

    function converterDrillDown(dataArry){

        var keys;
        var keys2;
        for(keys in dataArry) {
            var innerData = dataArry[keys].data;
            // console.log(innerData);
            for(keys2 in innerData){
                innerData[keys2]['y'] = parseInt(innerData[keys2]['y']);
            }

        }
        return dataArry
    }
    var selectDate = $('#checkMonth');
    var branch = $('#Branch');




    ///////
    var fullDate = new Date();
    var twoDigitMonth = ((String(fullDate.getMonth() + 1).length) === 2)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentMonth =  fullDate.getFullYear() +"-" + twoDigitMonth ;
    //console.log(currentMonth);

    //set the current month to month variable
    selectDate.val(currentMonth);
    ///////


    function graphDataUpdate(){
        selectMonth = selectDate.val();

        $.getJSON( "../../../application/controllers/DBfunctions/dashBoardJsonAPI.php",{functionName : "currentMonthSalePercentage",branchID: branchId, yearMonth: selectMonth}, function( data ) {
            createPercentagePie(data);
        });

        $.getJSON( "../../../application/controllers/DBfunctions/dashBoardJsonAPI.php",{functionName : "currentMonthSaleByRef",branchID: branchId, yearMonth: selectMonth}, function( data ) {
            var convertedSeriesData = converter(data.seriesData);
            var convertedDrillDownData = converterDrillDown(data.drilldownData);
            createTotalMonthRefSale(convertedSeriesData,convertedDrillDownData);
        });


        $.getJSON( "../../../application/controllers/DBfunctions/dashBoardJsonAPI.php",{functionName : "getTotalMonthSale", branchID: branchId, yearMonth: selectMonth}, function( data ) {
            var convertedSeriesData = converter(data.seriesData);
            var convertedDrillDownData = converterDrillDown(data.drilldownData);
            createTotalMonthSalesGraph (convertedSeriesData,convertedDrillDownData);

        });


        $.getJSON( "../../../application/controllers/DBfunctions/dashBoardJsonAPI.php",{functionName : "getDailySaleProductCount" , branchID: branchId, yearMonth: selectMonth}, function( data ) {
            var convertedSeriesData = converter(data.seriesData);
            var convertedDrillDownData = converterDrillDown(data.drilldownData);
            createSaleGraph (convertedSeriesData,convertedDrillDownData);
        });

        $.getJSON( "../../../application/controllers/DBfunctions/dashBoardJsonAPI.php",{functionName : "getDailyCollectionCount" , branchID: branchId, yearMonth: selectMonth}, function( data ) {
            var convertedSeriesData = converter(data.seriesData);
            var convertedDrillDownData = converterDrillDown(data.drilldownData);
            createCollectionGraph (convertedSeriesData,convertedDrillDownData);
        });

    }
    function createSaleGraph (seriesData,drilldownData) {
        // Create the chart
        $('#salesGraph').highcharts({
            chart: {
                type: 'column'
            },
            credits:{
                enabled: false

            },
            //January, 2015 to May, 2015
            title: {
                text: 'Daily Sales.'
            },
            subtitle: {
                text: 'Click the columns to view product.'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Sale'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> Items<br/> '
            },



            series: [{
                name: 'Total Sale',
                colorByPoint: true,
                tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> Items<br/> ' +
                '<span style="color:{point.color}">Value</span>:<b>Rs: {point.TotalValue}</b><br/>'
            },
                data: seriesData
            }],

            drilldown: {
                series: drilldownData
            }
        });
    }
    function createCollectionGraph (seriesData,drilldownData) {
        // Create the chart
        $('#collectionGraph').highcharts({
            chart: {
                type: 'column'
            },
            credits:{
                enabled: false

            },
            //January, 2015 to May, 2015
            title: {
                text: 'Daily Collection.'
            },
            subtitle: {
                text: 'Click the columns to view by Collector.'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Collection'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> Rupees<br/>'
            },

            series: [{
                name: 'Total collection',
                colorByPoint: true,
                data: seriesData
            }],

            drilldown: {
                series: drilldownData
            }
        });
    }
    function createTotalMonthSalesGraph (seriesData,drilldownData) {
        // Create the chart
        $('#TotalMonthSalesGraph').highcharts({
            chart: {
                type: 'column'
            },
            credits:{
                enabled: false

            },
            //January, 2015 to May, 2015
            title: {
                text: 'Month Sales by Product'
            },
            subtitle: {
                text: 'Click the columns to view day by day.'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Sale'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> Items<br/>'
            },

            series: [{
                name: 'Total Sale',
                colorByPoint: true,
                data: seriesData
            }],

            drilldown: {
                series: drilldownData
            }
        });
    }
    function createPercentagePie(seriesData){
        $('#percentagePie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Sales Percentage'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                        enabled: false,
                        distance: -30,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Sales',
                colorByPoint: true,
                data: seriesData
            }]
        });



    }
    function createTotalMonthRefSale (seriesData,drilldownData) {
        // Create the chart
        $('#refSaleMonth').highcharts({
            chart: {
                type: 'bar'
            },
            credits:{
                enabled: false

            },
            //January, 2015 to May, 2015
            title: {
                text: 'Month Sales.'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Sale By Ref'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> Items<br/>'
            },

            series: [{
                name: 'Total Sale',
                colorByPoint: true,
                data: seriesData
            }],
            drilldown: {
                series: drilldownData
            }

        });
    }
    function setSideInfoBar(){
        //update date variable
        selectMonth = selectDate.val();

        // left info bar
        $.getJSON( "../../../application/controllers/DBfunctions/dashBoardJsonAPI.php",{functionName : "leftInfoListData",branchID: branchId, yearMonth:selectMonth}, function( data ) {
            //console.log(data);
            $('#saleCount').html(data.MonthTotalSale);
            $('#saleValue').html(parseFloat(data.MonthTotalSaleValue).toFixed(2));
            $('#totalCollection').html(parseFloat(data.MonthTotalCollection).toFixed(2));
            $('#activeCard').html(data.TotalActiveCard);
            $('#fiveDaysNotUpdate').html(data.NotUpdateCardCountLastFiveDays);

        });

    }

    $(document).ready(function(){

        //calender
        $(function() {
            $('#datetimepicker1').datetimepicker({
                language: 'us',
                pickTime: false
            });
        });


        //left side list click ajax load
        $("a.rightAjax").on("click", function(e) {
            e.preventDefault();
            pageWrapper.empty();
            pageWrapper.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
            pageWrapper.load(this.href);
        });




        $.getJSON( "../../../application/controllers/DBfunctions/JsonAPI.php",{functionName : "getBranchList"}, function( data ) {
            branch.selectList({
                helpText : 'Select your branch',
                dataArray : data
            });

            //set the current value of the globel branchId
            branch.val(branchId);

        });



        $('#dashBoardRefreshButton').on('click',function(){
            branchId = branch.val();
            selectMonth = selectDate.val();

            setSideInfoBar();
            graphDataUpdate();


        });

        branch.on( "change",function() {
            // set globel branch Id value
            branchId = branch.val();
            selectMonth = selectDate.val();
            console.log(branchId)

            setSideInfoBar();
            graphDataUpdate();
        });


        graphDataUpdate();
        setSideInfoBar();





    });










</script>
