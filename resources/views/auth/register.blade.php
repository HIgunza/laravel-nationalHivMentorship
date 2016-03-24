@extends('formmaster')
@section('form-name', 'Register User')
@section('main-nav')
    <li>{!!HTML::link('dash-board','Home')!!}</li>
    <li>{!!HTML::link('my-profile','My Profile')!!}</li>
    <li>{!!HTML::link('mentorship-session','Mentorship Session')!!}</li>
    <li>{!!HTML::link('person-home','Mentor/Mentee')!!}</li>
    <li>{!!HTML::link('system-reports','Reporting')!!}</li>
    <li>{!!HTML::link('resource-center','Resource Centre')!!}</li>
    <li class='active'>{!!HTML::link('#','Admin')!!}</li>
    <li class='last'>{!!HTML::link('logout','Logout')!!}</li>
@stop
@section('horizontal-nav')
        <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/system-setup','Form Indicators setup')!!}
           </div>
       
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/facility-upload','Facility Import')!!}
           </div>
       
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/register','Add User')!!}
           </div>
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/manage-tools','Manage Session Tools')!!}
           </div>
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/indicator-list','Manage Session Indicators')!!}
           </div>
    </h4>
    <h4 class="accordion-toggle" >
           <div id="taccb">
               <div id="taccbi">  &gt; </div>
                   {!!HTML::link('/system-backup','System Backup')!!} 
           </div>
    </h4>
@stop

@section('form-design')
    <div class="col-md-8 col-md-offset-2 form-content">
     
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'/register','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}
        <div class="form-group">
            {!! Form::label('name','Name:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('name',Input::old('name'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('email','Email:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('email',Input::old('email'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password','Password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('password',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation','Confirm Password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="text-center">
            {!!Form::submit('Register',['class'=>'btn btn-default'])!!}
        </div>
        {!!Form::close()!!}

 
@stop