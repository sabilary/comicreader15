$(document).ready(function(){
    $('#Users_banned').change(function(){ // where Users_banned is my model & table (model_table)
        $('#hiddenDiv').toggle(); // hiddenDiv replace our Users_ban_reason as model & table (model_table)
    }); 
});