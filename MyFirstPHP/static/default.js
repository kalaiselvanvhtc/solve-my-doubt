$(function() {
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var fieldValue='';
var degreeValue='';

    if($("#isUserRegComlete").val()==0){
        $("#IncompleteRegForm").modal(
                {
                    backdrop:'static',
                    keybaord:false
                }
                );
    }
     if($("#isUserLoggedIn").val()==1){
         $(".userprofile").removeClass("hidden");
         $(".logout").removeClass("hidden");
         $(".home").removeClass("hidden");
         $(".askquestion").removeClass("hidden");
         
     }
     
  $("#add_answer").click(function(){
      $("#postAnswerCont").show();
      $(this).hide();
  }); 
   $('#field').selectpicker();
   $('#field').on('hidden.bs.select', function (e) {
       
  $.ajax({
		      			url : 'api.php?p=Blog&a=autoComplete',
		      			dataType: "json",
						data: {
						   fieldId: $('#field').val(),
						   type: 'degree'
						},
						 success: function( data ) {
                                                     $('#degree').children().remove();
							  $.map( data, function( item ) {
                                                             $('#degree').append('<option value="'+item.Id+'">'+item.Name+'</option>');
							});
                                                         $('#degree').append('<option value="-1">Other</option>');
                                                        $('#degree').selectpicker('refresh'); 
						}
		      		});
  
});


$('.bootstrap-select').click(function (e) {
    if($('#field').val()=='')
       $('#field').select(); 
});
var specId_array = new Array();

   $('#degree').selectpicker();
   $('#year').selectpicker();
   $('#sem').selectpicker();
   $("#specialization").autocomplete({
                    minLength: 1,
                    multiselect: true,
            source: function( request, response ) {
		      		$.ajax({
		      			url : 'api.php?p=Blog&a=autoComplete',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
                                                   fieldId: $('#field').val(),
                                                   degreeId: $('#degree').val(),
						   type: 'specialization'
						},
						 success: function( data ) {
							response(  $.map( data, function( item ) {
								return {
									label: item.Name,
									value: item.Id
								}
							}));
						}
		      		});
		      	}
                });
                
                $("#topicsgoodat").autocomplete({
                    minLength: 1,
                    multiselect: true,
            source: function( request, response ) {
                $("#specializationHidden")[0].value='';
                $("#specialization").parent().children("div").each(function(){
                if($("#specializationHidden")[0].value!='')
                $("#specializationHidden")[0].value=$("#specializationHidden")[0].value+','+$(this).find("span")[2].innerHTML;
                else
                    $("#specializationHidden")[0].value=$(this).find("span")[2].innerHTML;
            });
		      		$.ajax({
		      			url : 'api.php?p=Blog&a=autoComplete',
		      			dataType: "json",
						data: {
                                                    
						   name_startsWith: request.term,
                                                   fieldId: $('#field').val(),
                                                   degreeId: $('#degree').val(),
                                                   speciazation:$("#specializationHidden")[0].value,
						   type: 'topics'
						},
						 success: function( data ) {
							response(  $.map( data, function( item ) {
								return {
									label: item.Name,
									value: item.Name
								}
							}));
						}
		      		});
		      	}
                });
                var availableTopics = [];
                $.getJSON(window.location.origin + '/MyFirstPHP/api.php?p=Blog&a=autoComplete&type=userTopics', function (data) {
            for (var i = 0; i < data.length; i++) {
                availableTopics.push(data[i].Name);
            }
			});
            $("#title").bind("keydown", function (event) {
           if (event.keyCode === $.ui.keyCode.TAB &&
               $(this).autocomplete("instance").menu.active) {
               event.preventDefault();
           }
       })
       .autocomplete({
						minLength: 1,
						 source: function (request, response) {
              response($.ui.autocomplete.filter(
                availableTopics, extractLast(request.term)));
          }
					});
                
                
                $("#topicsneed").autocomplete({
                    minLength: 1,
                    multiselect: true,
            source: function( request, response ) {
               $("#specializationHidden")[0].value='';
                $("#specialization").parent().children("div").each(function(){
                if($("#specializationHidden")[0].value!='')
                $("#specializationHidden")[0].value=$("#specializationHidden")[0].value+','+$(this).find("span")[2].innerHTML;
                else
                    $("#specializationHidden")[0].value=$(this).find("span")[2].innerHTML;
            });
		      		$.ajax({
		      			url : 'api.php?p=Blog&a=autoComplete',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
                                                   fieldId: $('#field').val(),
                                                   degreeId: $('#degree').val(),
                                                   speciazation:$("#specializationHidden")[0].value,
						   type: 'topics'
						},
						 success: function( data ) {
							response(  $.map( data, function( item ) {
								return {
									label: item.Name,
									value: item.Name
								}
							}));
						}
		      		});
		      	}
                });
                
                function split(val) {
            return val.split(/,\s*/);
        }
 function extractLast(term) {
            return split(term).pop();
        }
        
        $("#IncompleteRegFormSubmit").click(function(){
             $("#specializationHidden")[0].value='';
             $("#topicGoodHidden")[0].value='';
             $("#topicHelpHidden")[0].value='';
             $("#degreeHidden")[0].value=''
             $("#fieldHidden")[0].value=''
            $("#specialization").parent().children("div").each(function(){
                if($("#specializationHidden")[0].value!='')
                $("#specializationHidden")[0].value=$("#specializationHidden")[0].value+','+$(this).find("span")[1].innerHTML;
                else
                    $("#specializationHidden")[0].value=$(this).find("span")[1].innerHTML;
            });
            $("#topicsgoodat").parent().children("div").each(function(){
            if($("#topicGoodHidden")[0].value!='')
                $("#topicGoodHidden")[0].value=$("#topicGoodHidden")[0].value+','+$(this).find("span")[1].innerHTML;
            else
                $("#topicGoodHidden")[0].value=$(this).find("span")[1].innerHTML;
            });
            $("#topicsneed").parent().children("div").each(function(){
                if($("#topicHelpHidden")[0].value!='')
           $("#topicHelpHidden")[0].value=$("#topicHelpHidden")[0].value+','+$(this).find("span")[1].innerHTML;
            else
           $("#topicHelpHidden")[0].value=$(this).find("span")[1].innerHTML;
            });
             $("#fieldHidden")[0].value=$("#field option:selected").text();
             $("#degreeHidden")[0].value=$("#degree option:selected").text();
            //return false;
            if($("#topicHelpHidden")[0].value.trim()!='' && $("#specializationHidden")[0].value.trim()!='' && $("#topicGoodHidden")[0].value.trim()!='' && $("#fieldHidden")[0].value!='Select Field' && $("#degreeHidden")[0].value!='Select Degree')
            {
                return true;
            }
            else
            {
                if($("#topicHelpHidden")[0].value.trim()=='')
                    $("#topicneedError").show();
                else
                    $("#topicneedError").hide();
                
                if($("#specializationHidden")[0].value.trim()=='')
                    $("#specError").show();
                else
                    $("#specError").hide();
                
                if($("#topicGoodHidden")[0].value.trim()=='')
                    $("#topicgoodError").show();
                else
                    $("#topicgoodError").hide();
                
                if($("#fieldHidden")[0].value=='Select Field')
                    $("#fieldError").show();
                else
                    $("#fieldError").hide();
                
                  if($("#degreeHidden")[0].value=='Select Degree')
                    $("#degreeError").show();
                else
                    $("#degreeError").hide();
                    
             return false;   
            }
        });
    });
    
    function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}