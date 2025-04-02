<!-- Footer -->
</div> <!-- End of main content wrapper -->
</div> <!-- End of content -->

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- JS Libraries and Scripts -->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/js/ruang-admin.min.js')}}"></script>
<script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>

<!-- Custom Scripts -->
<script>
  async function categorizeComplaint() {
    const text = document.getElementById("complaintInput").value;
    try {
        const response = await fetch("http://192.168.100.100:1010/categorize_complaint/", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `text=${encodeURIComponent(text)}`
        });

        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }

        const result = await response.json();  
        document.getElementById("result").innerText = formatResult(result);  
    } catch (error) {
        console.error("Error occurred:", error);
        document.getElementById("result").innerText = "Error occurred while processing the complaint.";
    }
}

function formatResult(result) {
    return `${result.category}`;
}
</script>
<script>
function downloadFile(outputFilePath) {
    let filename = outputFilePath.split('/').pop();
   console.log(filename);
    let downloadUrl = `http://192.168.100.100:8008/download/${filename}`;  

    fetch(downloadUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to fetch the file.");
            }
            return response.blob();  
        })
        .then(blob => {
           
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;  
            document.body.appendChild(a);
            a.click();
            a.remove();  
            document.getElementById('status').innerText = "Download completed!"; 
        })
        .catch(error => {
            console.error("Download error:", error);
            document.getElementById('status').innerText = "Download failed.";
        });
}
</script>
<script>
 $(document).ready(function () {
    $('.previewBtn').on('click', function () {
        var filePath = $(this).data('file-path');
        console.log("File Path:", filePath);
        if (filePath) {
            $.ajax({
                url: filePath, 
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'  
                },
                success: function (response) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var data = new Uint8Array(e.target.result);  
                        var workbook = XLSX.read(data, { type: 'array' }); 
                        var sheetName = workbook.SheetNames[0];
                        var sheet = workbook.Sheets[sheetName];
                        var html = XLSX.utils.sheet_to_html(sheet);  
                        $('#previewContent').html(html);
                        $('#previewModal').modal('show');  
                    };
                    reader.readAsArrayBuffer(response);
                },
                error: function () {
                    console.error('Error loading the Excel file.');
                    alert('Error loading the Excel file.');
                }
            });
        } else {
            alert('No file path available.');
        }
    });
});

</script>

<script>
  function confirmDelete() {
    return confirm('Are you sure you want to delete this role? If you delete this role, the user will be deleted automatically.');
  }
</script>


<script>
  function xclconfirmDelete() {
    return confirm('Are you sure you want to delete this file? ');
  }
</script>



<script>
  function confirmDeleteUser() {
    return confirm('Are you sure you want to delete this User?');
  }
</script>
<script>
  $(document).ready(function () {
    $('.predictBtn').on('click', function () {
   
        var $button = $(this);  
        var fileId = $button.data('file-id');  
        var filePath = $button.data('file-path'); 
        var fileName = $button.data('file-name'); 
        $button.text('Processing...').attr('disabled', true);
        fetch(filePath)  
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch the file.');
                }
                return response.blob();  
            })
            .then(blob => {
                var formData = new FormData();
                formData.append('file', blob, fileName);  
                return fetch('http://192.168.100.100:8008/classify_complaints/', {
                    method: 'POST',
                    headers: {
                        'accept': 'application/json',
                    },
                    body: formData,  
                });
            })
            .then(response => response.json())  
            .then(data => {
                if (data && data.output_file_path) 
                {
                    const outputFilePath = data.output_file_path; 
                    $.ajax({
                            url: '{{ route('store.prediction.result') }}',  
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'), 
                                file_id: fileId,  
                                result_file_path: outputFilePath,  
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Prediction result stored successfully!');
                                    location.reload();  
                                } else {
                                    alert('Error storing prediction result.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log('AJAX Error:', error);
                                alert('Error while storing prediction result.');
                            },
                            complete: function() {
                                $button.text('Predict').attr('disabled', false);  
                            }
                        });

                } 

                else {
                    throw new Error('No file path in response from classify API.');
                }
            })
            .then(storeResponse => storeResponse.json())  
            .then(storeData => {
                if (storeData.success) {
                    alert('Prediction stored successfully!');
                    location.reload(); 
                } else {
                    alert('Error storing prediction result.');
                    $button.text('Predict').attr('disabled', false);  
                }
            })
       
            .finally(() => {
                $button.text('Predict').attr('disabled', false);
            });
    });
  });
</script>


<script>
    $(document).ready(function () {
        $('#userDropdown').on('click', function (e) {
            $(this).next('.dropdown-menu').toggle(); 
        });
    });
</script>
</body>
</html>
