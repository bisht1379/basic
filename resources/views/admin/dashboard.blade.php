@extends('admin.layouts.master')

	@section('content')
<style>
    /* Custom styles */
    .form-group {
        display: flex;
        gap: 20px;
    }
    .text-primary {
    color: #3a3a3e !important;
}
    textarea {
        width: 48%;
        height: 200px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .upload-btn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color:  #3a3a3e !important;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .upload-btn:hover {
        background-color: #0056b3;
    }

    /* Responsive table styling */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f4f4f4;
    }

    @media (max-width: 768px) {
        table, th, td {
            font-size: 14px;
        }
    }


</style>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Text Predict </h6>
                </div>
                 <div class="card-body">
                <form> 

                     <div class="form-group">
       
                      <textarea  id="complaintInput"  placeholder="Enter content here..."></textarea>


                      <textarea id="result" placeholder="API response will be shown here..." readonly></textarea>
                     </div>

    
      <button type="button" onclick="categorizeComplaint()" class="btn" style="background-color: #254260; border-color: #254260; color: white;">Predict</button>


                 </form>


                </div>
              </div>

       
            <div class="card mb-4" style=width:95%;>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> Predict File Upload </h6>
                </div>
                @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                 <div class="card-body">
                 <form  id="fileUploadForm"  method="POST" enctype="multipart/form-data" action="{{ route('file.upload') }}">
                        @csrf
                
                    <input type="file"name="complaint_file" id="complaint_file " class="form-control @error('complaint_file') is-invalid @enderror">
                    @error('complaint_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror 
                    <br>
                    <button type="submit" class="btn btn-secondary" style="background-color: #254260; border-color: #254260; color: white;">Upload</button>
                </form>
                <br>
       
                
                      <!-- Display Existing Files Section -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Uploaded Files</h6>
            </div>
            <!-- Modal for preview -->
<!-- Modal for Excel Preview -->
<!-- Modal for Excel Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content" style=" width: 179%;margin-left: -177px;" >
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Excel Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="previewContent" >
                <!-- Excel table content will be inserted here -->
            </div>
        </div>
    </div>
</div>


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>File Name</th>
                            <!-- <th>Result</th> -->

                            <th>Predict</th>
                            <th>Preview</th>
                            <th>Download</th>
                            <th>Delete</th>
                        </tr>
                    
                    </thead>
                    <tbody>
                        @if(count($files )>0)
                        @foreach($files as $index => $file)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $file->complaint_file_name }}</td>
                                <!-- <td>{{ $file->result_file_path }}</td> -->
                                <td><button class="btn btn-secondary predictBtn" data-file-id="{{ $file->id }}" data-file-name="{{ $file->complaint_file_name }}" data-file-path="{{ $file->complaint_file_path }}" style="background-color: #254260; border-color: #254260; color: white;">Predict</button></td>
                                <td>
                    @if($file->result_file_path)
                    <?php
$result_file_name = basename($file->result_file_path);
//  echo $result_file_name;  

 ?>
                        <button class="btn btn-primary previewBtn" data-file-path="{{ Storage::url('uploads/output_directory/' .$result_file_name) }}" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Preview</button>
                     
                        @else
                        <span></span>  <!-- Show text if there's no result file path -->
                    @endif
                </td>

                @if($file->result_file_path)
                                <td>
         <button class="btn btn-success" onclick="downloadFile('{{ asset($file->result_file_path) }}')" style="background-color:rgb(22, 83, 147); border-color:rgb(24, 58, 94); color: white;">Download</button>
                                </td>
                                @else
                                <span></span>  <!-- Show text if there's no result file path -->
                                @endif

                          
                @if($file->result_file_path)      
                        <td>
                        <form action="{{route('file.delete',[$file->id])}}" method="POST" onsubmit="return xclconfirmDelete() ">@csrf
                          {{method_field('DELETE')}}
                          <button class="btn btn btn-danger">Delete</button>

                        </form>
                      </td>
                      @else
                                <span></span>  <!-- Show text if there's no result file path -->
                                @endif
                            </tr>
                        @endforeach
                        @else
                        <td></td>
                        @endif


                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
<!---Container Fluid-->
</div>

@endsection

@push('script')
<!-- jQuery -->
<!-- Bootstrap 5 (no jQuery required) -->
<!-- jQuery -->

<script>
    $(document).ready(function () {
        // Handle the file upload form submission via AJAX
        $('#fileUploadForm').on('submit', function (e) {
            e.preventDefault();  // Prevent form from submitting in the default way

            var formData = new FormData(this);  // Get form data, including the file

            $.ajax({
                url: "{{ route('file.upload') }}",  // POST route
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        // Show the uploaded file's details in the display section
                        $('#uploadedFileName').text(response.fileName);
                        $('#uploadedFilePath').text(response.filePath);
                        $('#uploadedFileLink').attr('href', response.filePath);  // Set download link

                        // Make the file details section visible
                        $('#uploadedFileSection').show();

                        // Optionally, append the new file to the table dynamically (without page reload)
                        var newRow = `
                            <tr>
                                <td>${response.sno}</td>
                                <td>${response.fileName}</td>
                                <td><a href="${response.filePath}" target="_blank" class="btn btn-secondary">Preview</a></td>
                                <td><a href="${response.filePath}" target="_blank" class="btn btn-success">Download</a></td>
                                <td><a href="${response.filePath}" class="btn btn-danger">Delete</a></td>
                            </tr>`;

                        $('table tbody').prepend(newRow);  // Prepend new file to the table

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