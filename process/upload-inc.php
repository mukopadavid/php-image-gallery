<?php
require_once('../db/connection.php');

if (isset($_POST['submit'])) {

  $file = $_FILES['file'];
  $file_name = $file['name'];
  $file_error = $file['error'];
  $file_type = $file['type'];
  $file_tmp_name = $file['tmp_name'];
  $file_size = $file['size'];

  $file_extension = explode('.', $file_name);
  $file_actual_extension = strtolower(end($file_extension));


  $allowed = ['jpeg', 'jpg', 'png', 'gif'];
  $pattern = '/image/i';

  if ($file_error === 0) {
    if (preg_match($pattern, $file_type) == 1) {

      if (in_array($file_actual_extension, $allowed)) {
        if ($file_size < 5000000) {

          $file_name_new = strtolower($file_extension[0]) . '-' . uniqid(time()) . '.' . $file_actual_extension;
          $file_destination = '../uploads/' . $file_name_new;


          if (move_uploaded_file($file_tmp_name, $file_destination)) {

            $name =  $file_extension[0];

            $stmt = mysqli_stmt_init($conn);
            $query = "INSERT INTO images (name, url) VALUES (?,?)";

            if (mysqli_stmt_prepare($stmt, $query)) {
              $file_url = $file_name_new;
              mysqli_stmt_bind_param($stmt, 'ss', $name, $file_url);

              if (mysqli_stmt_execute($stmt)) {
                echo "
                <script>
                  alert('file uploaded successfully')
                </script>
                ";

                header('location:../uploadedImages.php');
              } else {
                echo "an error occured";
              }
            } else {
              echo "An error Occured";
            }
          }
        } else {
          echo "file size is too large to be uploaded";
        }
      } else {
        echo "file type is not allowed";
      }
    } else {
      echo "Only images are allowed for upload";
    }
  } else {
    echo "An error occured";
  }
}
