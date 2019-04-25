$( document ).ready(function() {
   
    var table;
        $.ajax({
            url:"fetchSalesExeMappingTable.php", //the page containing php script to check
            type: "post", //request type,
            success: function(data) { 
               
                 if (!data.includes("No data")){
                 //   console.log(data);
                 var salesExecutivesList = data.split('"]')[0]+'"]';
                 var response = data.split('"]')[1];
                 var salesExecutivesList= $.parseJSON(salesExecutivesList);
                    var response= $.parseJSON(response);
                    var MTreport =[];
                    for(var i=0; i< response.length; i++){
                        var report = [];

                        var ActGrp = response[i].AccountGroup;
                        var Dlrs = response[i].Dealers;
                        var Bunit = response[i].BusinessUnit;
                        var SExec = response[i].AssignedSalesExecCode;
                        var SExecList= salesExecutivesList;
                        var id= response[i].ID;
                        report = [Bunit,ActGrp,Dlrs,SExec,SExecList,id]; 
                        MTreport.push(report);
                    } 
                    $('#mapTable').empty();
                     table = $('#mapTable').DataTable( {
                               data: MTreport,
                               searching: true,
                               bDestroy:true,   
                               responsive:true,
                               processing: true,
                               dom: 'Blfrtip',
                               buttons: ['csv', 'excel'], 
                               columns: [
                                          { title: "BusinessUnit"},
                                          { title: "AccountGroup"},
                                          { title: "Dealer" },
                                          { title: "Sales Executive Code",
                                          "render": function (row, data, type, meta) {
                                            var result="";
                                            result = '<select name="sltSaleExecutive" id="sltSaleExecutive" onchange="myFunction(this);" class="form-control"><option>Choose the Sales Executive Code</option>'; //sltSaleExecutive
                                            for(var i=0;i<type[4].length;i++){
                                                if(type[3] == type[4][i] ){
                                                    result+='<option selected>'+type[4][i]+'</option>';    
                                                }else{
                                                result+='<option>'+type[4][i]+'</option>';  
                                                }
                                              }
                                              result+='</select>';
                                            return result;
                                          }
                                        },
                                        ],
                                columnDefs: [
                                            { "type": "html-input", "targets": [3] }
                                         ] 
                    });
                  
                                         
                }
                else{
                     alert("No Records");
                    }
            }
        });
// update Sales executive code in salesExec-dealer mapping table
    $('#updateRow').click(function(){
        if((updateBunit != "") && (updateAgrp != "") && (updateDlr !="")&& (NewSExeCode!="")&&(OldSExeCode!="")){
            $.ajax ({
                    url: "updateSalesExeMappingTable.php",
                    type: 'POST',
                    data: {BusinessUnit:updateBunit,AccountGroup:updateAgrp, Dealers:updateDlr, NewAssignedSalesExecCode:NewSExeCode,OldAssignedSalesExecCode:OldSExeCode},
                    success: function(data) { 
                        if (!data.includes("Not Updated")){
                           // console.log(data);
                            alert ("Updated  " +updateDlr+ "'s Sales Executive");
                        }else{
                            alert("Not able to Update");
                            }
                        
                    }
                });
        }
        else {
            alert ("Change any field" );
        }
     });
          
});

// seachable for dropdown cloumn

$.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
    return $(value).val();
};

// datatable edit function in salesExec-dealer mapping table
function myFunction(param) {
    var table = $(param).closest("table").DataTable().table();
    var row = table.row($(param).parents('tr'));
    var cell = table.cell($(param).parents('td, th'));
    var columnIndex = cell.index().column;
    var inputField =getInputField(param);
    var oldValue = cell.data(); 
    var newValue = inputField.val();
    cell.data(newValue);
    myCallbackFunction(cell, row, oldValue, newValue);
 };


function fetchSalesExecCode(){

      $.ajax({
        url:"fetchSalesExeCodeDrop.php", //the page containing php script to check filter Acct grp based on business unit
        type: "post", //request type,
        success: function(response) { 
            console.log(response);
            if (!response.includes("No data")){
                 var res= $.parseJSON(response);
               console.log(res);
                $('#sltSalesExecutiveCode').empty();
                $('#sltSalesExecutiveCode').append('<option value="" selected>- Choose Sales Executive Code -</option>');
                for(var i=0; i<res.length;i++)
                  {
                     $('#sltSalesExecutiveCode').append('<option >'+res[i]+' </option>');
                  
                  }
               }
            }
    });
}

function myCallbackFunction(updatedCell, updatedRow, oldValue, newValue) {
    updateBunit = updatedRow.data()[0];
    updateAgrp = updatedRow.data()[1];
    updateDlr = updatedRow.data()[2];
    NewSExeCode = updatedRow.data()[3];
    OldSExeCode = oldValue;
    console.log(updateBunit,updateAgrp,updateDlr,NewSExeCode,OldSExeCode);
}