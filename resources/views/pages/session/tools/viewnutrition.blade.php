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
                   {!!HTML::link('/session-tool/2','Laboratory')!!}
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
<input type="hidden" name="tool_id" value="4">
<!-- BEGIN_ITEMS -->
<div class="form_table">

<div class="clear"></div>

<div id="q7" class="q full_width">
<a class="item_anchor" name="ItemAnchor0"></a>
<div class="segment_header" style="width:auto;text-align:Center;background-repeat:repeat;background-color:transparent;background-image:url('/images/stock/2015/Education/Education03.jpg');background-size: cover;background-position: 50% 50%;"><h1 style="font-size:26px;font-family:'Sanchez',serif;padding:20px 1em ;background-color:rgba(0, 0, 0, 0.290196)">Nutrition</h1></div>
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
<th scope="col" style="text-align:left">1. Professionalism</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
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
<td><input type="radio" @if($sessionScore['ind_2']==88) checked @endif name="ind_2" class="multiple_choice" id="freedom-3" value="88" /></td>
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
<th scope="col" style="text-align:left">2. Nutrition Assessment</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Anthropometric assessment</td>
<td><input type="radio" @if($sessionScore['ind_55']==1) checked @endif name="ind_55" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_55']==2) checked @endif name="ind_55" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_55']==3) checked @endif name="ind_55" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_55']==88) checked @endif name="ind_55" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_55']}}" name="comm_55" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">b.	Biochemical assessment</td>
<td><input type="radio" @if($sessionScore['ind_56']==1) checked @endif name="ind_56" class="multiple_choice" id="freedom-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_56']==2) checked @endif name="ind_56" class="multiple_choice" id="freedom-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_56']==3) checked @endif name="ind_56" class="multiple_choice" id="freedom-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_56']==88) checked @endif name="ind_56" class="multiple_choice" id="freedom-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_56']}}" name="comm_56" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">c.	Clinical assessment</td>
<td><input type="radio" @if($sessionScore['ind_57']==1) checked @endif name="ind_57" class="multiple_choice" id="answer_questions-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_57']==2) checked @endif name="ind_57" class="multiple_choice" id="answer_questions-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_57']==3) checked @endif name="ind_57" class="multiple_choice" id="answer_questions-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_57']==88) checked @endif name="ind_57" class="multiple_choice" id="answer_questions-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_57']}}" name="comm_57" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">d.	Dietary assessment</td>
<td><input type="radio" @if($sessionScore['ind_58']==1) checked @endif name="ind_58" class="multiple_choice" id="clear_communication-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_58']==2) checked @endif name="ind_58" class="multiple_choice" id="clear_communication-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_58']==3) checked @endif name="ind_58" class="multiple_choice" id="clear_communication-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_58']==88) checked @endif name="ind_58" class="multiple_choice" id="clear_communication-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_58']}}" name="comm_58" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">e.	Functional assessment</td>
<td><input type="radio" @if($sessionScore['ind_59']==1) checked @endif name="ind_59" class="multiple_choice" id="clear_communication-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_59']==2) checked @endif name="ind_59" class="multiple_choice" id="clear_communication-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_59']==3) checked @endif name="ind_59" class="multiple_choice" id="clear_communication-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_59']==88) checked @endif name="ind_59" class="multiple_choice" id="clear_communication-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_59']}}" name="comm_59" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">f.	Classification of nutritional status</td>
<td><input type="radio" @if($sessionScore['ind_60']==1) checked @endif name="ind_60" class="multiple_choice" id="clear_communication-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_60']==2) checked @endif name="ind_60" class="multiple_choice" id="clear_communication-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_60']==3) checked @endif name="ind_60" class="multiple_choice" id="clear_communication-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_60']==88) checked @endif name="ind_60" class="multiple_choice" id="clear_communication-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_60']}}" name="comm_60" type="text" size="30"/></td>
</tr>
<tr class="matrix_row_dark">
<td class="question" style="width:px;">g.	Management of nutritional status</td>
<td><input type="radio" @if($sessionScore['ind_61']==1) checked @endif name="ind_61" class="multiple_choice" id="clear_communication-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_61']==2) checked @endif name="ind_61" class="multiple_choice" id="clear_communication-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_61']==3) checked @endif name="ind_61" class="multiple_choice" id="clear_communication-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_61']==88) checked @endif name="ind_61" class="multiple_choice" id="clear_communication-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_61']}}" name="comm_61" type="text" size="30"/></td>
</tr>


<tr>
<th scope="col" style="text-align:left">3. Nutrition Counseling & Education</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Uses the 8 critical nutrition practices</td>
<td><input type="radio" @if($sessionScore['ind_62']==1) checked @endif name="ind_62" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_62']==2) checked @endif name="ind_62" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_62']==3) checked @endif name="ind_62" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_62']==88) checked @endif name="ind_62" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_62']}}" name="comm_62" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">4. Infant & Young Child Feeding Counseling in the Context of HIV</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Breastfeeding, replacement feeding, complementary feeding (AFASS)</td>
<td><input type="radio" @if($sessionScore['ind_63']==1) checked @endif name="ind_63" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_63']==2) checked @endif name="ind_63" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_63']==3) checked @endif name="ind_63" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_63']==88) checked @endif name="ind_63" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_63']}}" name="comm_63" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">5. Nutrition Support (Food by Prescription)</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Therapeutic & supplementary feeds</td>
<td><input type="radio" @if($sessionScore['ind_64']==1) checked @endif name="ind_64" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_64']==2) checked @endif name="ind_64" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_64']==3) checked @endif name="ind_64" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_64']==88) checked @endif name="ind_64" class="multiple_choice" id="RESULT_RadioButton-4-0-3" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_64']}}" name="comm_64" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">6. Nutrition Commodity Management</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Quantification, ordering, receiving, storage & dispensing</td>
<td><input type="radio" @if($sessionScore['ind_65']==1) checked @endif name="ind_65" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_65']==2) checked @endif name="ind_65" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_65']==3) checked @endif name="ind_65" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_65']==88) checked @endif name="ind_65" class="multiple_choice" id="RESULT_RadioButton-4-0-4" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_65']}}" name="comm_65" type="text" size="30"/></td>
</tr>

<tr>
<th scope="col" style="text-align:left">7. Data Collection & Reporting</th><th scope="col">1</th><th scope="col">2</th><th scope="col">3</th><th scope="col">4</th><th colspan="2" scope="col">Comment</th>
</tr>
<tr class="matrix_row_light">
<td class="question" style="width:px;">a.	Documentation completeness, accuracy & timeliness</td>
<td><input type="radio" @if($sessionScore['ind_66']==1) checked @endif name="ind_66" class="multiple_choice" id="RESULT_RadioButton-4-0-0" value="1" /></td>
<td><input type="radio" @if($sessionScore['ind_66']==2) checked @endif name="ind_66" class="multiple_choice" id="RESULT_RadioButton-4-0-1" value="2" /></td>
<td><input type="radio" @if($sessionScore['ind_66']==3) checked @endif name="ind_66" class="multiple_choice" id="RESULT_RadioButton-4-0-2" value="3" /></td>
<td><input type="radio" @if($sessionScore['ind_66']==88) checked @endif name="ind_66" class="multiple_choice" id="RESULT_RadioButton-4-0-4" value="88" /></td>
<td colspan="2"><input value="{{$sessionScore['comm_66']}}" name="comm_66" type="text" size="30"/></td>
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