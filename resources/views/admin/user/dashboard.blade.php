@extends('admin.layouts.master')

	@section('content')

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Text Predict </h6>
                </div>
                 <div class="card-body">
                <form id="myForm"  method="POST"> 

                     <div class="form-group">
       
                      <textarea id="editor1" name="editor1" placeholder="Enter content here..."></textarea>


                      <textarea id="responseTextarea" placeholder="API response will be shown here..." readonly></textarea>
                     </div>

    
                  <button type="button" class="btn btn-primary" id="uploadBtn">Predict</button>

                 </form>


                </div>
              </div>

       
            <div class="card mb-4" style=width:50%;>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> Predict File Upload </h6>
                </div>
                 <div class="card-body">
                 <form  id="fileUploadForm"  method="POST" enctype="multipart/form-data" action="{{ route('file.upload') }}">
                        @csrf
                
                    <input type="file"name="complaint_file" id="complaint_file " class="form-control @error('complaint_file') is-invalid @enderror">
                    @error('complaint_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                    <button type="submit" class="btn btn-secondary">Upload</button>
                </form>
                @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('file'))
                        <h4>Uploaded File Details:</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Path</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ session('file')['fileName'] }}</td>
                                    <td>{{ session('file')['filePath'] }}</td>
                                    <td><a href="{{ session('file')['filePath'] }}" target="_blank" class="btn btn-primary">Download</a></td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                </div>
              </div>

       
            </div>

    </div>
        <!---Container Fluid-->
      </div>
      @endsection
      @push('script')
      <script>
      $(document).ready(function () {
    $('#fileUploadForm').on('submit', function (e) {
        e.preventDefault();  // Prevent the form from submitting the default way

        var formData = new FormData(this);  // Get form data, including the file

        $.ajax({
            url: "{{ route('file.upload') }}",  // Your POST route
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    // Update the uploaded file name and path in the display section
                    $('#uploadedFileName').text(response.fileName);  // Display file name
                    $('#uploadedFilePath').text(response.filePath);  // Display file path
                    $('#uploadedFileLink').attr('href', response.filePath);  // Set the link to download the file

                    // Make the file details section visible
                    $('#uploadedFileSection').show();
                } else {
                    alert('Error uploading file');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error uploading file. Please try again.');
            }
        });
    });
});

</script>

      @endpush
 