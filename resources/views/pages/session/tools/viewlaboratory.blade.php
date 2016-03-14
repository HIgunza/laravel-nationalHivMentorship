@extends('formmaster')
@section('form-name', 'Mentorship Session Tool')
@section('inline-js')
<script type="text/javascript">
$(document).ready(function(){
	
		$( "#m_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy'
		});
    
    $("#FSForm").submit (function (){
         return validateForm ();
        });
	$(".multiple_choice").change(function(){
        calcscore()
	});
	$("#county").change(function() {
		$.get('../facility/loadsubcat/' + $(this).val(), function(data) {
			$("#subcounty").empty();
            $("#subcounty").append($('<option/>', {text : 'Select Sub-County' }));
            $("#m_facility").empty();
            $('#m_facility').append($('<option/>', {text : 'Select Facility' }));
			
			if (data != null) {
				
				for (var i in data) {
					var f = data[i];
					
						$('#subcounty').append($('<option/>', { 
        				value: f.id,
        				text : f.name 
    					}));
					}
			}
		});	
		
    });

/*adding functionality for sub-county drop-down*/

	$("#subcounty").change(function() {
		$.get('../facility/loadfacility/' + $(this).val(), function(data) {
			if (data != null) {
				$("#m_facility").empty();
				$('#m_facility').append($('<option/>', {text : 'Select Facility' }));
				for (var i in data) {
					var f = data[i];
					
						$('#m_facility').append($('<option/>', { 
        				value: f.id,
        				text : f.name 
    					}));
					}
			}
		});	
		
    });
});	
	function validateForm () {
          var drpDownNames = ['mentor','mentee','subcounty','m_facility'];
            var txtAndTxtAreaIds = ['m_date','self_reported_gap','previous_session_gap','other_gap','session_objectives','mentee_strength','mentee_improvement_areas','session_comments'];
            var sessionIndFieldNames = ['ind_1','ind_2','ind_3','ind_4','ind_22','ind_23','ind_24','ind_25','ind_26','ind_27','ind_28','cme_participation','mdt_participation'];
            var submit = true;
            
            for (var drpInd in drpDownNames) {
                var drpName = drpDownNames[drpInd];
                $("#"+drpName).css('border', function() {
                return $(this).val() == '' ? '1px solid red' : '';
                
                if($(this).val() == '') { submit = false;}
                
                });
               
            }
            for (var ind in sessionIndFieldNames) {
                var indName = sessionIndFieldNames[ind];
                if(!$('input[name='+ indName +']:checked').val()) {
                   $('input[name='+ indName + ']').parent().css({"background-color": "red"});
                    submit = false;
                }
                
            }
            
            for (var txtF in txtAndTxtAreaIds) {
                var txtFid = txtAndTxtAreaIds[txtF];
                $("#"+txtFid).css('border', function() {
                return $(this).val() == '' ? '1px solid red' : '';
                
                if($(this).val() == '') { submit = false;}
            
                });
            }
            if (!submit) {
                $('#msg_container').html('Please fill all required fields before submitting form');
            }
            return submit;
    }
function disablefields() {
         if (document.getElementById('cme_yes').checked == 1) { 
              document.getElementById('cme_topic').disabled=false; 
              document.getElementById('cme_presenter').disabled=false; 
              document.getElementById('cme_topic').value='';
              document.getElementById('cme_presenter').value=''; 
         } else { 
              document.getElementById('cme_topic').disabled=true; 
              document.getElementById('cme_presenter').disabled=true; 
              document.getElementById('cme_topic').value='';
              document.getElementById('cme_presenter').value='';
         } 
     }
function calcscore(){
    var score = 0;
    $(".multiple_choice:checked").each(function(){
        if(parseInt($(this).val(),10)==88){
            score+= 0;
        }
        else{
        score+=parseInt($(this).val(),10);
        }
    });
    $("input[name=totalScore]").val(score)
}

 
    

</script>
@stop
@section('main-nav')
    <li>{!!HTML::link('dash-board','Home')!!}</li>
    <li>{!!HTML::link('my-profile','My Profile')!!}</li>
    <li class='active'>{!!HTML::link('#','Mentorship Session')!!}</li>
    <li>{!!HTML::link('person-home','Mentor/Mentee')!!}</li>
    <li>{!!HTML::link('system-reports','Reporting')!!}</li>
    <li>{!!HTML::link('resource-center','Resource Centre')!!}</li>
    <li>{!!HTML::link('system-admin','Admin')!!}</li>
    <li class='last'>{!!HTML::link('logout','Logout')!!}</li>
@stop
@section('horizontal-nav')
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/session-tool/1','Clinical')!!}
           </div>
       
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/session-tool/3','Counseling')!!}
           </div>
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/session-tool/4','Nutrition')!!} 
           </div>
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/session-tool/5','Pharmacy')!!} 
           </div>
    </h4>
     <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/indicator-list','Mentorship Indicators')!!} 
           </div>
    </h4>
@stop
@section('form-design')

<form method="post" id="FSForm" action="session-create">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="tool_id" value="2">
<!-- BEGIN_ITEMS -->
<div class="form_table">

<div class="clear"></div>

<div id="q7" class="q full_width">
<a class="item_anchor" name="ItemAnchor0"></a>
<div class="segment_header" style="width:auto;text-align:Center;background-repeat:repeat;background-color:transparent;background-image:url('/images/stock/2015/Education/Education03.jpg');background-size: cover;background-position: 50% 50%;"><h1 style="font-size:26px;font-family:'Sanchez',serif;padding:20px 1em ;background-color:rgba(0, 0, 0, 0.290196)">Laboratory</h1></div>
</div>

<div class="clear"></div>

<div>
    <table id="sessionList" width='80%' style="padding-left:10px">
        <tr>
            <td><b>Date</b></td>
            <td><b>Session Type</b></td>
            <td><b>Mentor</b></td>
            <td><b>Mentee</b></td>
            <td><b>Facility</b></td>
        </tr>
        <tr>
            <td>{{date_format($sessionDate, 'Y-m-d')}}</td>
            <td>{{$sessionTool}}</td>
            <td>{{$mentor}}</td>
            <td>{{$mentee}}</td>
            <td>{{$facility}}</td>
        </tr>
        <tr><td colspan="5">&nbsp;</td></tr>
    </table>
</div>

<div class="clear"></div>

<div id="q4" class="q required">

<table>
<tr>
    <th colspan="4" style="text-align:left">Known Gaps</th>
</tr>
<tr>
<td>Data Source</td>
<td colspan="3">Gap</td>
</tr>
<tr>
<td>Self-reported by mentee</td>
<td colspan="3"><input type="text" value="{{$selfReportedGap}}" name="self_reported_gap" size="50"/></td>
</tr>
<tr>
<td>Previous mentoring session</td>
<td colspan="3"><input type="text" value="{{$previousSessGap}}" name="previous_session_gap" size="50"/></td>
</tr>
<tr>
<td>Other:</td>
    <td colspan="3"><input type="text" value="{{$otherGap}}" name="other_gap" size="50"/></td>
</tr>
</table>    
<div class="clear"></div>   

<table>
<tr>
    <th colspan="4" style="text-align:left">Session Objectives</th>
</tr>
<tr>
<td colspan="4"><textarea name="session_objectives"  cols="70">{{$sessionObjectives}}</textarea></td>
</tr>
</table>   
<a class="item_anchor" name="ItemAnchor4"></a>
<span class="question top_question">Please choose the best answer for each question. The mentee...&nbsp;<b class="icon_required" style="color:#FF0000">*</b></span>
<table width="100%" style="background-color:rgba(0, 0, 0, 0.290196)">
    <tr>
        <td colspan="4"><b> Scoring Key</b></td>
    </tr>
    <tr>
        <td>1 = Needs Improvement</td>
        <td>2 = Satisfactory</td>
        <td>3 = Excellent</td>
        <td>4 = Not Applicable</td>
    </tr>
</table>
<table class="matrix">

<tr>
<th scope="col" style="text-align:left">1. Professionalism</th>
    <th scope="col">1</th>
    <th scope="col">2</th>
    <th scope="col">3</th>
    <th scope="col">4</th>
    <th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a. Appearance & demeanor</td>
<td><input type="radio" @if($sessionScore['ind_1']==1) checked @endif name="ind_1" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_1']==2) checked @endif name="ind_1" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_1']==3) checked @endif name="ind_1" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_1']==88) checked @endif name="ind_1" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_1']}}" name="comm_1" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">b. Patient-centered</td>
<td><input type="radio" @if($sessionScore['ind_2']==1) checked @endif name="ind_2" class="multiple_choice" id="freedom-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_2']==2) checked @endif name="ind_2" class="multiple_choice" id="freedom-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_2']==3) checked @endif name="ind_2" class="multiple_choice" id="freedom-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_2']==88) checked @endif name="ind_2" class="multiple_choice" id="freedom-2" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_2']}}" name="comm_2" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c. Time management</td>
<td><input type="radio" @if($sessionScore['ind_3']==1) checked @endif name="ind_3" class="multiple_choice" id="answer_questions-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_3']==2) checked @endif name="ind_3" class="multiple_choice" id="answer_questions-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_3']==3) checked @endif name="ind_3" class="multiple_choice" id="answer_questions-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_3']==88) checked @endif name="ind_3" class="multiple_choice" id="answer_questions-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_3']}}" name="comm_3" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">d. Communication</td>
<td><input type="radio" @if($sessionScore['ind_4']==1) checked @endif name="ind_4" class="multiple_choice" id="clear_communication-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_4']==2) checked @endif name="ind_4" class="multiple_choice" id="clear_communication-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_4']==3) checked @endif name="ind_4" class="multiple_choice" id="clear_communication-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_4']==88) checked @endif name="ind_4" class="multiple_choice" id="clear_communication-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_4']}}" name="comm_4" type="text" size="30"/></td>
</tr>
<tr>
<th scope="col" style="text-align:left">2. Commodity Management</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Correct use of commodity control tools</td>
<td><input type="radio" @if($sessionScore['ind_29']==1) checked @endif name="ind_29" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_29']==2) checked @endif name="ind_29" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_29']==3) checked @endif name="ind_29" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_29']==88) checked @endif name="ind_29" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_29']}}" name="comm_29" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">b.	Correct forecasting</td>
<td><input type="radio" @if($sessionScore['ind_30']==1) checked @endif name="ind_30" class="multiple_choice" id="freedom-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_30']==2) checked @endif name="ind_30" class="multiple_choice" id="freedom-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_30']==3) checked @endif name="ind_30" class="multiple_choice" id="freedom-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_30']==88) checked @endif name="ind_30" class="multiple_choice" id="freedom-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_30']}}" name="comm_30" type="text" size="30"/></td>
</tr>



<tr>
<th scope="col" style="text-align:left">3. Quality Control</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Utilization of daily QC logs & results used for decision making </td>
<td><input type="radio" @if($sessionScore['ind_31']==1) checked @endif name="ind_31" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_31']==2) checked @endif name="ind_31" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_31']==3) checked @endif name="ind_31" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_31']==88) checked @endif name="ind_31" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_31']}}" name="comm_31" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">b.	Bench decontamination </td>
<td><input type="radio" @if($sessionScore['ind_32']==1) checked @endif name="ind_32" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_32']==2) checked @endif name="ind_32" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_32']==3) checked @endif name="ind_32" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_32']==88) checked @endif name="ind_32" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_32']}}" name="comm_32" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c.	Equipment maintenance </td>
<td><input type="radio" @if($sessionScore['ind_33']==1) checked @endif name="ind_33" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_33']==2) checked @endif name="ind_33" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_33']==3) checked @endif name="ind_33" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_33']==88) checked @endif name="ind_33" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_33']}}" name="comm_33" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">d.	Quality control & quality assurance documentation</td>
<td><input type="radio" @if($sessionScore['ind_34']==1) checked @endif name="ind_34" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_34']==2) checked @endif name="ind_34" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_34']==3) checked @endif name="ind_34" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_34']==88) checked @endif name="ind_34" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_34']}}" name="comm_34" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">4. Pre–analytical Procedures</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th>  <th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Proper patient identification & review of request form</td>
<td><input type="radio" @if($sessionScore['ind_35']==1) checked @endif name="ind_35" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_35']==2) checked @endif name="ind_35" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_35']==3) checked @endif name="ind_35" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_35']==88) checked @endif name="ind_35" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_35']}}" name="comm_35" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">b.	Patient welcomed & made comfortable</td>
<td><input type="radio" @if($sessionScore['ind_36']==1) checked @endif name="ind_36" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_36']==2) checked @endif name="ind_36" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_36']==3) checked @endif name="ind_36" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_36']==88) checked @endif name="ind_36" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_36']}}" name="comm_36" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c.	Clarifies with patient what to expect</td>
<td><input type="radio" @if($sessionScore['ind_37']==1) checked @endif name="ind_37" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_37']==2) checked @endif name="ind_37" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_37']==3) checked @endif name="ind_37" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_37']==88) checked @endif name="ind_37" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_37']}}" name="comm_37" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">d.	Use of available SOPs & job aids </td>
<td><input type="radio" @if($sessionScore['ind_38']==1) checked @endif name="ind_38" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_38']==2) checked @endif name="ind_38" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_38']==3) checked @endif name="ind_38" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_38']==88) checked @endif name="ind_38" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_38']}}" name="comm_38" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">e.	General sample collection preparation</td>
<td><input type="radio" @if($sessionScore['ind_39']==1) checked @endif name="ind_39" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_39']==2) checked @endif name="ind_39" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_39']==3) checked @endif name="ind_39" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_39']==88) checked @endif name="ind_39" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_39']}}" name="comm_39" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">f.	Sample collection procedure</td>
<td><input type="radio" @if($sessionScore['ind_40']==1) checked @endif name="ind_40" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_40']==2) checked @endif name="ind_40" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_40']==3) checked @endif name="ind_40" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_40']==88) checked @endif name="ind_40" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_40']}}" name="comm_40" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">g.	Referral of sample if required</td>
<td><input type="radio" @if($sessionScore['ind_41']==1) checked @endif name="ind_41" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_41']==2) checked @endif name="ind_41" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_41']==3) checked @endif name="ind_41" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_41']==88) checked @endif name="ind_41" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_41']}}" name="comm_41" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">5. Analytical Procedures</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Sample received & recorded</td>
<td><input type="radio" @if($sessionScore['ind_42']==1) checked @endif name="ind_42" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_42']==2) checked @endif name="ind_42" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_42']==3) checked @endif name="ind_42" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_42']==88) checked @endif name="ind_42" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_42']}}" name="comm_42" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">b.	Sample preparation for testing</td>
<td><input type="radio" @if($sessionScore['ind_43']==1) checked @endif name="ind_43" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_43']==2) checked @endif name="ind_43" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_43']==3) checked @endif name="ind_43" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_43']==88) checked @endif name="ind_43" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_43']}}" name="comm_43" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c.	Analytical SOPs & job aids used</td>
<td><input type="radio" @if($sessionScore['ind_44']==1) checked @endif name="ind_44" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_44']==2) checked @endif name="ind_44" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_44']==3) checked @endif name="ind_44" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_44']==88) checked @endif name="ind_44" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_44']}}" name="comm_44" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">d.	Testing procedures</td>
<td><input type="radio" @if($sessionScore['ind_45']==1) checked @endif name="ind_45" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_45']==2) checked @endif name="ind_45" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_45']==3) checked @endif name="ind_45" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_45']==88) checked @endif name="ind_45" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_45']}}" name="comm_45" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">e.	Results interpretation</td>
<td><input type="radio" @if($sessionScore['ind_46']==1) checked @endif name="ind_46" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_46']==2) checked @endif name="ind_46" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_46']==3) checked @endif name="ind_46" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_46']==88) checked @endif name="ind_46" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_46']}}" name="comm_46" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">f.	Results documentation</td>
<td><input type="radio" @if($sessionScore['ind_47']==1) checked @endif name="ind_47" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_47']==2) checked @endif name="ind_47" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_47']==3) checked @endif name="ind_47" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_47']==88) checked @endif name="ind_47" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_47']}}" name="comm_47" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">g.	Results TAT</td>
<td><input type="radio" @if($sessionScore['ind_48']==1) checked @endif name="ind_48" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_48']==2) checked @endif name="ind_48" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_48']==3) checked @endif name="ind_48" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_48']==88) checked @endif name="ind_48" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_48']}}" name="comm_48" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">6. Post-analytical Procedures</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th> <th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Results review</td>
<td><input type="radio" @if($sessionScore['ind_49']==1) checked @endif name="ind_49" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_49']==2) checked @endif name="ind_49" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_49']==3) checked @endif name="ind_49" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_49']==88) checked @endif name="ind_49" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_49']}}" name="comm_49" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">b.	Out of range and critical values results prioritized</td>
<td><input type="radio" @if($sessionScore['ind_50']==1) checked @endif name="ind_50" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_50']==2) checked @endif name="ind_50" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_50']==3) checked @endif name="ind_50" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_50']==88) checked @endif name="ind_50" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_50']}}" name="comm_50" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c.	Results dispatch procedures followed</td>
<td><input type="radio" @if($sessionScore['ind_51']==1) checked @endif name="ind_51" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_51']==2) checked @endif name="ind_51" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_51']==3) checked @endif name="ind_51" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_51']==88) checked @endif name="ind_51" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_51']}}" name="comm_51" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">7. Biosafety Procedures</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Bio-safety protocols used</td>
<td><input type="radio" @if($sessionScore['ind_52']==1) checked @endif name="ind_52" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_52']==2) checked @endif name="ind_52" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_52']==3) checked @endif name="ind_52" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_52']==88) checked @endif name="ind_52" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_52']}}" name="comm_52" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">b.	Correct waste segregation and disposal</td>
<td><input type="radio" @if($sessionScore['ind_53']==1) checked @endif name="ind_53" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_53']==2) checked @endif name="ind_53" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_53']==3) checked @endif name="ind_53" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_53']==88) checked @endif name="ind_53" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_53']}}" name="comm_53" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c.	Decontamination of biological waste before disposal</td>
<td><input type="radio" @if($sessionScore['ind_54']==1) checked @endif name="ind_54" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_54']==2) checked @endif name="ind_54" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_54']==3) checked @endif name="ind_54" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_54']==88) checked @endif name="ind_54" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_54']}}" name="comm_54" type="text" size="30"/></td>
</tr>
	<tr><td ><strong>Total Score</strong></td><td colspan="4"> <input name="totalScore" readonly="true" style="text-align: right; width: 75px;" type="text" value="{{$totalScore}}"></td></tr>
</table>
<table>
<tr><th colspan="4" style="text-align:left">Summary of Mentee Strengths</th></tr>
<tr><td colspan="4"><textarea cols="70" name="mentee_strength">{{$menteeStrength}}</textarea></td></tr>
</table>
 
<table>
<tr><th colspan="4" style="text-align:left">Summary of Mentee Areas for Improvement (with specific steps to address each priority area)</th></tr>
<tr><td colspan="4"><textarea cols="70" name="mentee_improvement_areas">{{$improvementAreas}}</textarea></td></tr>
</table>

<table>
<tr><th colspan="4" style="text-align:left">Other Comments</th></tr>
<tr><td colspan="4"><textarea cols="70" name="session_comments">{{$comments}}</textarea></td></tr>
</table>
 <table>
<tr><th colspan="4" style="text-align:left">Participated in CME during this mentorship visit: Yes/No</th>
    <th><input type='radio' @if($cmeTopic != '') checked @endif name='cme_participation' id="cme_yes" value='1' >YES</th>
    <th><input type='radio' @if($cmeTopic == '') checked @endif name='cme_participation' id="cme_no" value='0' >NO</th></tr>
 <tr><td colspan="4" style="width:px;">Topic:</td><td colspan="4" style="width:px;">Presenter:</td></tr>
<tr><td colspan="4"><textarea cols="40" name="cme_topic" id="cme_topic" disabled="true">{{$cmeTopic}}</textarea></td>
    <td colspan="4"><textarea cols="40" name="cme_presenter" id="cme_presenter" disabled="true">{{$cmePresenter}}</textarea></td></tr>
    
</table>

<table>
<tr><th colspan="4" style="text-align:left">Participated in MDT meeting during this mentorship visit: Yes/No</th><th><input type='radio' name='mdt_participation' @if($mdtParticipation == 1) checked @endif id="mdt_yes" value='1'> YES</th><th><input type='radio' name='mdt_participation' @if($mdtParticipation == 0) checked @endif id="mdt_no" value='0'>NO</th></tr>
    
</table> 
</div>
<div class="clear"></div>
<div style="position:relative;font-family:Helvetica,Arial,sans-serif;font-size:12px;line-height:36px;text-align:left;background-color:#fafafa;height:35px;margin-top:10px;overflow:hidden;">

</div>
</div>
<!-- END_ITEMS -->
<div class="outside_container">
<div class="buttons_reverse"><input type="submit" name="Submit" value="Save" class="submit_button" id="FSsubmit" /></div>
</div>

</form>

@stop