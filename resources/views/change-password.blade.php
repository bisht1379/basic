<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4a90e2, #50e3c2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Modal styles */
        .modal {
            display: none;  /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);  /* Darkened background */
            padding-top: 100px;
            transition: all 0.3s ease;
        }

        /* Modal content styling */
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;  /* Set maximum width for responsiveness */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .modal h4 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
        }

        /* Input fields styling */
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Button styling */
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Close modal button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Your Dashboard Content Here -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the session contains the 'isTempPassword' flag
            var isTempPassword = @json(session('isTempPassword'));

            // If the user has a temporary password, show the modal
            if (isTempPassword) {
                var modal = document.getElementById('changePasswordModal');
                modal.style.display = "block";  // Show modal
            }
        });

        // Close the modal if the user clicks outside of the modal
        window.onclick = function(event) {
            var modal = document.getElementById('changePasswordModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // Close the modal after form submission
        document.querySelector('form').addEventListener('submit', function() {
            var modal = document.getElementById('changePasswordModal');
            modal.style.display = "none";  // Hide modal
        });
    </script>

    <!-- Modal Structure -->
    <div class="modal" id="changePasswordModal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('changePasswordModal').style.display='none'">&times;</span>
            <h4>Change Your Password</h4>
            <form action="{{ route('update.password') }}" method="POST">
                @csrf
                <input type="password" name="new_password" placeholder="Enter new password" required>
                <input type="password" name="new_password_confirmation" placeholder="Confirm new password" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
