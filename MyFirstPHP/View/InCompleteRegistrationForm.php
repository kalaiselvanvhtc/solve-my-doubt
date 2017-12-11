<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="IncompleteRegForm" class="modal fade container" role="dialog" aria-hidden="true">
	<div class="modal-dialog row">
    <div class="modal-content col-xs-12 col-sm-12 col-md-10">    
               
		<form id="login-form" method="post" class="modal-body form-signin" action="?p=Registration&amp;a=updateMissingField">
                    <h2 class="modal-title tagline">Please provide the following information</h2>
                    <?php require 'inc/msg.php' ?>
				<div class="form-group">
                        <select name="field" id="field" tabindex="0" required="required" title="Select Field" class="form-control">
                            
 <?php foreach ($this->oFields as $oPost): ?>
                            <option value="<?=$oPost->FieldId?>"><?=htmlspecialchars($oPost->FieldName)?></option>
    <?php endforeach ?>
		</select>
                                </div>
			
					<div class="form-group">
                     <select name="degree" required="required" id="degree" tabindex="0" required="required" title="Select Degree" class="form-control">
                            <option value="-1">Other</option>
		</select></div> 
                    
				
					<div class="form-group">
                                           <input name="specialization" id="specialization"   type="text" class="form-control input-lg" placeholder="Specialization" /> 
                                            
					</div>
                    <div class="form-group">
                                            <input name="topicsgoodat" id="topicsgoodat" type="text" class="form-control input-lg" placeholder="Topics you are good at" /> 
                                           
                                            
					</div>
                    <div class="form-group">
                                            <input name="topicsneed" id="topicsneed"  type="text" class="form-control input-lg" placeholder="Topics you need help with" /> 
                                           
                                            
					</div>
                    <div class="form-group">
                     <select name="year" id="year" tabindex="0" required="required" title="Select Year" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
		</select></div> 
                    <div class="form-group">
                     <select name="sem" id="sem" tabindex="0" required="required" title="Select Sem" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
		</select></div> 
                     <div class="form-group col-xs-12 col-sm-12 col-md-12 paddingR0 paddingL0">
                            <button class="btn btn-block bt-login btn-affermative" id="IncompleteRegFormSubmit" type="submit">Submit</button>
                        </div>
		
				
			</div>
                    
             <input type="hidden" name="specializationHidden" id="specializationHidden" />
              <input type="hidden" name="topicGoodHidden" id="topicGoodHidden" />
               <input type="hidden" name="topicHelpHidden" id="topicHelpHidden" />
               <input type="hidden" name="fieldHidden" id="fieldHidden" />
               <input type="hidden" name="degreeHidden" id="degreeHidden" />
                       
           
            </form>
            
<!-- HTML for displaying user details -->

        </div>   
	</div>
