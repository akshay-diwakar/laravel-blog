@extends('Backend.Admin.DashBoard')
@section('content')
 <section class="content-header">
      <h1>
        Add Blog		
        <small>Dashboard</small>
      </h1>
</section>
<section class="content">
  <div class="box with-border" >
    <div class="box-body">
    @include('Backend.Admin.alert-message')

        {!!Form::open(['url'=>'admin/Blog/edit-save', 'enctype' => 'multipart/form-data', 'method'=>'post']) !!}    
          {!! Form::hidden('id',$Blog->id) !!}      

              @csrf
            <div class="form-group">
              <div class="col-md-12">
                  <div class="col-md-12">
	                {!!Form::label('Blog Title') !!} <span style="color:red;">*</span>
	             
	                {!!Form::text('Blog_title',$Blog->blog_title,['class' => 'form-control','placeholder' => 'Blog Title','required' => 'required']) !!}  
		              </div>
              </div>
              <div class="col-md-12">
                  <div class="col-md-12">
                     <!-- https://stackoverflow.com/questions/46905575/laravel-when-edit-the-link-for-the-file-upload-does-not-show -->
                         <!-- You can't pre-fill the value of a <input> tag. If you want to show the current value to the user, think about displaying in a <div> before the input for example. -->
                        {!!Form::label('Blog Image') !!} {{ $Blog->file_path }}<span style="color:red;">*</span>
                          <input type="file" name="Image" value="{{$Blog->file_path}}" class="form-control">
                          
                  </div>
              </div>
              <div class="col-md-12">
                  <div class="col-md-12">
                       {!!Form::label('Blog Description') !!} <span style="color:red;">*</span>
                		 <textarea id="description" class="ckeditor form-control" value="" type="text" name="description">{{$Blog->blog_descripiton}}</textarea>
                  </div>
              </div>
        		  <div class="col-md-12" style="margin-top: 20px; float:right;">
                <div class="row">
                    <div class="col-md-1 ">
                      {!! Form::submit('Save',array('class'=>'btn btn-primary')) !!}
                    </div>
                </div>    
              </div>  
            </div>  
        {!!Form::close()!!}
    </div>
  </div>        
</section>  
@endsection
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript"></script>
<!-- link for ckeditor --> 
  <!-- https://hdtuto.com/article/laravel-install-and-use-ckeditor-example -->
<script type="text/javascript">

    $(document).ready(function() {

       $('.ckeditor').ckeditor();

    });

</script>
