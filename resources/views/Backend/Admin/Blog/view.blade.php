@extends('Backend.Admin.DashBoard')
@section('content')
<section class="content-header">
    <h1>
      Blog List
        
    </h1>
    <div class="text-right">
    	<a href="{{ URL('admin/Blog/add') }}"><buttton class="btn btn-primary">Add</buttton></a>
    </div>	
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
	            <div class="card">
		            <div class="card-body">
		                <table id="example2" class="table table-bordered table-striped dataTable">
		               	   	<thead>
			            	    <tr>
			                	    <th>Sno</th>
			                    	<th>Blog Title</th>
			                    	<th>Blog Image</th>
			                    	<th>Blog Description</th>
									<th>Action</th>
			                	</tr>
		                  	</thead>
		                  	<tbody>
                          @foreach($Blogs_description as $no =>$blogs)
                              
                                   <tr>
                                       <td> {{ $no+1}} </td>
                                       <td> {{ $blogs->blog_title}} </td>
                                       <!-- <td><img width="30%" class="img-circle" src="{{ URL('public/file_upload	_images'.$blogs->file_path) }}"></td> -->
                                       <!-- storing images in img tag via fethcing filepath -->
                                       <td><img src="/file_upload_images/{{ $blogs->file_path }}" width="200" height="100"></td>
                                       <!-- using this we will not be able to show tags associated with it -->
						               <td> {!! $blogs->blog_descripiton !!}</td>
                                       <td> 
                                            <a href="{{URL('admin/Blog/edit')}}/{{$blogs->id}}">
                                                {{ Form::submit('Edit',array('class'=>'btn btn-primary')) }}
                                            </a>
                                           <a>
                                           <form action="{{ url('/admin/Blog/delete',[$blogs->id])}}" method="post">
                  								 	@method('delete')
                 									@csrf
		                                            {{ Form::submit('Delete',array('class'=>'btn btn-danger')) }}
                  									<!-- <button class="btn btn-danger" type="submit">Delete</button> -->
                							</form>
                                            </a>
                                        </td>
                                   </tr> 
                           	
		                  @endforeach()		
		                  	</tbody>
                        	
		                </table>
		               		
	              	</div>
	              	<!-- https://www.remotestack.io/how-to-create-pagination-in-laravel-with-bootstrap/ -->
	              		 
						<div class="d-flex justify-content-left">
                			{!! $Blogs_description->links()  !!}
          				</div> 
				</div>

			</div>	
			
		</div>
	</div>
</section>
 
@endsection