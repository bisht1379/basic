<?php

// header("Access-Control-Allow-Origin: *"); // Allow any origin (unsafe for production)
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp3.netcore.co.in';         
        $mail->SMTPAuth   = true;
        $mail->Username   = 'softmail@ccscomputers.co.in';         
        $mail->Password   = 'Cc$45oMs';       
        $mail->SMTPSecure = 'tls';                     
        $mail->Port       = 587;
        
        $mail->setFrom('softmail@ccscomputers.co.in', 'AItech');
        $mail->addReplyTo($email, $name);                                
        $mail->addAddress('nbisht@ccscomputers.co.in', ' Narender');  
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Contact Form';
       $mail->Body = '
  <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; background-color: #f9f9f9;">
    <h2 style="text-align: center; color: #2c3e50;">New Contact Form Submission</h2>
    <table style="width: 100%; font-size: 16px; border-collapse: collapse;">
      <tr>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;"><strong>Name:</strong></td>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;">' . htmlspecialchars($name) . '</td>
      </tr>
      <tr>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;"><strong>Email:</strong></td>
        <td style="padding: 8px; border-bottom: 1px solid #ccc;">' . htmlspecialchars($email) . '</td>
      </tr>
      <tr>
        <td style="padding: 8px; vertical-align: top;"><strong>Message:</strong></td>
        <td style="padding: 8px;">' . nl2br(htmlspecialchars($message)) . '</td>
      </tr>
    </table>
    <p style="font-size: 12px; color: #888; text-align: center; margin-top: 20px;">This message was sent from your website contact form.</p>
  </div>
';


        $mail->send();
        echo "✅ Message sent successfully!";
    } catch (Exception $e) {
        echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
//html content//
      <form id="contact-form" class="contact-form" >
          <!-- <h4 class="text-center mb-4">Contact Us</h4> -->

          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control text-capitalize"  name="name"  placeholder="Enter your full name" required />
          </div>

          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control text-lowercase"  name="email"  placeholder="name@example.com" required />
          </div>

          <div class="form-group">
            <label for="message">Your Message</label>
            <textarea class="form-control" name="message"  rows="4"     placeholder="Write your message here..." required></textarea>
            <small class="form-text text-muted text-right">
            <!-- <span id="charCount">0</span>/1000 characters -->
            </small>
          </div>

          <button type="submit" class="btn btn-dark btn-block btn-custom">Send Message</button>

          <!-- <div class="alert alert-success mt-3 d-none text-center" id="successAlert">
            ✅ Message sent successfully!
          </div> -->
        </form>
        
  <p id="response"></p>
      </div>
    </div>
  </div>
</section>

    <footer id="keshav">
      <div class="container">
        <div class="row2">
          <div class="col-md-4">
            <div class="full" style="margin-top: 23px;">
              <div class="logo_footer">
                <a href="index.html">
                  <img width="70px" height="70px" src="images/Aitech Logo.png" alt="AITECH Logo" />
                </a>
              </div>
              <br />
              <div class="information_f">
                <p><strong>ADDRESS:</strong> 131, Laxmi Bhawan, Nehru Place, New Delhi - 12005</p>
                <p><strong>TELEPHONE:</strong> +91-987-654-3210</p>
                <p><strong>EMAIL:</strong> support@aitechlabs.co.in</p>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row2">
              <div class="col-md-7">
                <div class="row2">
                  <div class="col-md-6">
                    <div class="widget_menu" style="margin-top: 15px;">
                      <h3>Menu</h3>
                      <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="misson.html">Mission & Vision</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="oursupport.html">Our Support</a></li>
                        <li><a href="partners.html">Clients & Partners</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    

  </script>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('load', function () {
    document.getElementById('preloader').style.display = 'none';
  });
</script>
<script>
  document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);

    fetch('send.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(text => {
      document.getElementById('response').textContent = text;
      form.reset();
    })
    .catch(err => {
      document.getElementById('response').textContent = '❌ Error: ' + err;
    });
  });
</script>
  </body>
</html>
