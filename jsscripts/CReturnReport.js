


$( document ).ready(function() {
   // $('#dpAsOfDate').datepicker().datepicker('setDate','Today','DD/MM/YYYY');

   $( "#sltBusinessUnit" ).change(function() {  
    //$('#CRetreport').empty();
    $('#tablediv').hide();
    $('#tableNoRecdiv').hide();
    var bunit = $("#sltBusinessUnit option:selected").text();
    
        if((bunit != null)){
            $.ajax({
                url:"fetchAGroupDropDown.php", //the page containing php script to check filter Acct grp based on business unit
                type: "post", //request type,
                data: {BusinessUnit:bunit},
                success: function(response) { 
                    if (!response.includes("No data")){
                         var res= $.parseJSON(response);
                       //  console.log(res);
                        $('#sltSalesExecutiveCode').empty();
                        $('#sltAccountGroup').empty();
                        $('#sltAccountGroup').append('<option value="" selected>- Choose Account Group  -</option><option value="">ALL</option>');
                        for(var i=0; i<res.length;i++)
                         {
                            $('#sltAccountGroup').append('<option >'+res[i]+' </option>');
                         }
                       }
                    }
            });
        }
        else{
                    alert("Select The Business unit");
                    $('select[name="sltAccountGroup"]').empty();
                    $('select[name="sltSalesExecutiveCode"]').empty();
                   
            }
               
           
});

$( "#sltAccountGroup" ).change(function() {  
    $('#tablediv').hide();
    $('#tableNoRecdiv').hide();
            var Agrp = $("#sltAccountGroup option:selected").text();
            var bunit = $("#sltBusinessUnit option:selected").text();
            console.log(Agrp,bunit);
                                      
            if(Agrp != null && bunit != null ){
                $.ajax({
                    url:"fetchSalesExecDropDown.php", //the page containing php script to check filter Acct grp based on business unit
                    type: "post", //request type,
                    data: {BusinessUnit:bunit,AccountGroup: Agrp},
                    success: function(response) { 
                        if (!response.includes("No data")){
                             var res= $.parseJSON(response);
                           //  console.log(res);
                           $('#sltSalesExecutiveCode').empty();
                           $('#sltSalesExecutiveCode').append('<option value="" selected>- Choose SalesExecutiveCode -</option><option value="">ALL</option>');
                           for(var i=0; i<res.length;i++)
                            {
                               $('#sltSalesExecutiveCode').append('<option >'+res[i]+' </option>');
                            }
                          }
                        
                        }
                });
            }
            else{
                        alert("Select The Account Group");
                        $('select[name="sltSalesExecutiveCode"]').empty();
                        ;
            
            }        
    });

    $('#dpAsOnDate').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,
        Default: true,
        pickDate: true,
        startDate: new Date(((new Date).getFullYear()- 1),3, 1),
        endDate : '+0d',
       
    }).change(function(){
      // $('#CRetreport').empty();
      $('#tablediv').hide();
      $('#tableNoRecdiv').hide();
       
    });

    $( "#sltSalesExecutiveCode" ).change(function() {  
        //$('#CRetreport').empty();
        $('#tablediv').hide();
        $('#tableNoRecdiv').hide();
    });

    
$( "#findCheque" ).click(function() {  
   var Agrp = $("#sltAccountGroup option:selected").text();
   var bunit = $("#sltBusinessUnit option:selected").text();
   var SExeCode = $("#sltSalesExecutiveCode option:selected").text();
   var asDate = $("#txtAsOnDate").val();
   var newdate = asDate.split("-").reverse().join("-");
   console.log(bunit,Agrp,SExeCode,newdate);
      if((SExeCode != null && SExeCode != "") && (newdate!=null && newdate != "")){
            $.ajax({
                   url:"fetchChequeReturnReport.php", //the page containing php script to check 
                   type: "post", //request type,
                   data: {BusinessUnit:bunit,AccountGroup: Agrp,AssignedSalesExecCode:SExeCode,AsOnDate:newdate},
                   success: function(data) { 
                       if (!data.includes("No Data")){
                        $('#tableNoRecdiv').hide();
                         //  console.log(data);
                           var response= $.parseJSON(data);
                           var CRreport =[];
                               for(var i=0; i<response.length; i++){
                                   var report = [];
                                   var ActGrp = response[i].AccountGroup;
                                   var Dlrs = response[i].Particulars;
                                   var SEcode=response[i].AssignedSalesExecCode;
                                   var Day30 = response[i].Dy30;
                                   var At30 = response[i].Amt30; // denotes total amount of cheques for 30 days
                                   var Day90 = response[i].Dy90; // denotes the number cheques for 90 days
                                   var At90 = response[i].Amt90;
                                   var Day120 = response[i].Dy120;
                                   var At120 = response[i].Amt120;
                                   var Day365 = response[i].Dy365;
                                   var At365 = response[i].Amt365;
                                   var Total = At30+At90+At120+At365;
                                   var Bunit = response[i].BusinessUnit;
                                   report = [ActGrp,Dlrs,SEcode,At30,At90,At120,At365,i,Bunit,Day30,Day90,Day120,Day365]; 
           
                                   CRreport.push(report);
                               } 
                              // console.log(CRreport);
                            $('#tablediv').show();
                           $('#CRetreport').empty();
                           $('#CRetreport').DataTable( {
                               data: CRreport,
                               bDestroy:true,
                               responsive: true,
                               processing: true,
                               dom: 'Blfrtip',
                               buttons: [ 'csv', 'excel'],
                               columns: [
                                 
                                   { title: "AccountGroup"},
                                   { title: "Dealer" },
                                   { title: "Sales Executive"},
                                   { title: "Cheque Returned in last 30 Days",
                                    "render": function (row, data, type, meta) {
                                       if(type[3] != '0.00'){
                                           var row1=$.fn.dataTable.render.number(',','.',2).display(type[3]), // function- decimal point and comma seperator for amount
                                           data = '<a id=  \'crbefore30-' + type[7] + '\' onclick="fetchChequeDetail(\'' + type[8] + '\' , \'' + type[0] + '\' , \'' + type[1]+ ' \', \'' + 30 + '\', \'crbefore30-' + type[7] + '\');">'+row1+'  ('+type[9]+')' +' </a>'; // to get individual cheque details
                                       }else{
                                           data = "-";
                                           }
                                        return data;
                                       }
                                   },
                                   { title: "Cheque Returned in last 90 Days",
                                    "render": function (row, data, type, meta) {
                                  
                                           if(type[4] != '0.00'){
                                               var row1=$.fn.dataTable.render.number(',','.',2).display(type[4]),
                                               data = '<a id=  \'crbefore90-' + type[7] + '\' onclick="fetchChequeDetail(\'' + type[8] + '\' , \'' + type[0] + '\' , \'' + type[1]+ ' \', \'' + 90 + '\', \'crbefore90-' + type[7] + '\');">'+row1+'  ('+type[10]+')' +' </a>';;
                                           }else{
                                               data = "-";
                                               }
                                            return data;
                                           }
                                   },
                                   { title: "Cheque Returned in last 120 Days" ,
                                    "render": function (row, data, type, meta) {
                                     
                                      if(type[5] != '0.00'){
                                       var row1=$.fn.dataTable.render.number(',','.',2).display(type[5]),
                                       data = '<a id=  \'crbefore120-' + type[7] + '\' onclick="fetchChequeDetail(\'' + type[8] + '\' , \'' + type[0] + '\' , \'' + type[1]+ ' \', \'' + 120 + '\', \'crbefore120-' + type[7] + '\');">'+row1+'  ('+type[11]+')' +' </a>';;
                                       }else{
                                       data = "-";
                                       }
                                       return data;
                                        }
                                   },
                                   { title: "Cheque Returned > 120 Days" ,
                                    "render": function (row, data, type, meta) {
                                  
                                      if(type[6] != '0.00'){
                                       var row1 =$.fn.dataTable.render.number(',','.',2).display(type[6]),
                                       data = '<a id=  \'crbefore365-' + type[7] + '\' onclick="fetchChequeDetail(\'' + type[8] + '\' , \'' + type[0] + '\' , \'' + type[1]+ ' \', \'' + 365 + '\', \'crbefore365-' + type[7] + '\');">'+row1+'  ('+type[12]+')' +' </a>';;
                                       }else{
                                       data = "-";
                                       }
                                       return data;
                                       }
                                   }

                               ]
                           } );
                       }
                       else{
                           $('#tablediv').hide();
                           $('#tableNoRecdiv').show();
                           $('#tableNoRecdiv').html("No Records");

                       }
                   }
               });
           }
        else  {
              alert("Choose all the fields")
          }  
                   
});

});


function fetchChequeDetail(unit,agp,dlr,dy, id){
    var asDate = $("#txtAsOnDate").val();
    var newdate = asDate.split("-").reverse().join("-");
    debugger;
	 console.log(unit,agp,dlr,dy);
	    $.ajax ({
        url: "fetchChequeDetails.php",
        type: 'POST',
        data: {BusinessUnit:unit,AccountGroup:agp, Dealers:dlr, day:dy, rowid:id,onDate:newdate},
        success: function(data) { 
            if (!data.includes("No data")){
                var response= $.parseJSON(data);
                console.log(response);
               var CDreport =[];
               for(var i=0; i< response.length; i++){
                   var report = [];
                   var Bunit = response[i].BusinessUnit;
                   var ActGrp = response[i].AccountGroup;
                   var Dlrs = response[i].Particulars;
                   var vNumber=response[i].VoucherNumber;
                   var vDate=response[i].VoucherDate;
                   var Amt=response[i].DebitAmount;
                   var days=response[i].days;
                   report = [ActGrp,Dlrs,vNumber,vDate,Amt,days]; 
                   CDreport.push(report);
                } 
                    $('#chequeDetailTable').empty();
                    $('#chequeDetailTable').DataTable( {
                        data: CDreport,
                        bDestroy: true,
                        paging  : false,
                        ordering: false,
                        info    : false,
                        bFilter : false,
                        columns: [
                            { title: "AccountGroup"},
                            { title: "Dealer" },
                            { title: "Voucher Number"},
                            { title: "Voucher Date"},
                            {title: "Amount"},
                            {title: "Days"}
                        ]
                    } );
                   $("#chequeDetailModal").modal('show')
            }
               
        }
        
       
    });
	
}
