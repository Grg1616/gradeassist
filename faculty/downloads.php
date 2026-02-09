<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_faculty.php');
require '../db_conn.php';
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Downloads</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Downloads</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<section class="section">

<div class="row mb-3">
  <div class="col-sm">
    <input type="text" id="searchInput" class="form-control" placeholder="Search..." size="50">
  </div>
  <div class="col-sm mt-1 text-sm-end">
      <button class="btn btn-sm btn-outline-secondary" onclick="filterDocuments('')">All Files</button>
      <button class="btn btn-sm btn-danger" onclick="filterDocuments('.pdf')">PDF</button>
      <button class="btn btn-sm btn-primary" onclick="filterDocuments('.doc')">Word</button>
      <button class="btn btn-sm btn-success" onclick="filterDocuments('.xls')">Excel</button>
</div>
</div>




  <div class="row align-items-start">
    <div class="col">
      <div class="card shadow">
        <div class="card-body mt-4">
          <div class="table-responsive">
    <?php
$folderPath = "../documents/"; // Path to your folder containing documents
$files = scandir($folderPath); // Get all files in the folder

// Remove "." and ".." from the files array
$files = array_diff($files, array('.', '..'));

// Sort files alphabetically
sort($files);

// Function to format file size
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

?>

<table class="table table-sm table-hover" style="width: 100%;">
    <thead>
        <tr style="white-space: nowrap;">
            <th scope="col"><h6>Name</h6></th>
            <th scope="col"><h6>File Size</h6></th>
            <th scope="col"><h6>Download</h6></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($files as $file) : ?>
            <tr style="white-space: nowrap;">
                <td scope="row">
                    <?php
                    // Determine file extension
                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

                    // Set the appropriate icon based on the file extension
                    switch ($fileExtension) {
                        case 'pdf':
                            $iconPath = '../assets/img/Component 5.png'; // Change to your PDF icon path
                            break;
                        case 'doc':
                        case 'docx':
                            $iconPath = '../assets/img/Component 4.png'; // Change to your Word icon path
                            break;
                        case 'xls':
                        case 'xlsx':
                            $iconPath = '../assets/img/Component 3.png'; // Change to your Excel icon path
                            break;
                        default:
                            $iconPath = '../assets/img/default.png'; // Change to default icon path
                    }
                    ?>
                    <img src="<?php echo $iconPath; ?>" class="fileIcon me-3 img-fluid" style="width: 20px; height: 20px;">
                    <span class="small"><?php echo $file; ?></span>
                </td>

                <td class="fileSize small"><?php echo formatSizeUnits(filesize($folderPath . $file)); ?></td>

                <td scope="row">
                    <a class="downloadLink" href="<?php echo $folderPath . $file; ?>" download>
                        <img src="../assets/img/download.png" class="me-3" style="width:20px; height:20px; margin-left: 25px;">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

      </div>
      </div>
    </div>
    </div>
  </div>

</section>

<script>
  function filterDocuments(extension) {
    var rows = document.querySelectorAll("tbody tr");
    rows.forEach(function(row) {
      var link = row.querySelector(".downloadLink");
      var href = link.getAttribute("href");
      var lowerCaseHref = href.toLowerCase();
      if (extension === '') {
        // Show all files
        row.style.display = "";
      } else if (extension === '.pdf') {
        // Show only PDF files
        if (lowerCaseHref.endsWith(extension)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      } else if (extension === '.xls') {
        // Show only Excel files
        if (lowerCaseHref.endsWith(extension)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      } else if (extension === '.doc' || extension === '.docx') {
        // Show only Word files (.doc and .docx)
        if (lowerCaseHref.endsWith('.doc') || lowerCaseHref.endsWith('.docx')) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      }
    });
  }
</script>

<script>
        var downloadLinks = document.getElementsByClassName('downloadLink');
        for (var i = 0; i < downloadLinks.length; i++) {
            var link = downloadLinks[i];
            var fileSizeElement = link.parentElement.previousElementSibling;
            getFileSize(link.href, fileSizeElement);
        }

        function getFileSize(url, fileSizeElement) {
            var xhr = new XMLHttpRequest();
            xhr.open('HEAD', url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var size = xhr.getResponseHeader('Content-Length');
                        fileSizeElement.textContent = (size / 1024).toFixed(2) + ' KB', 'MB';
                    } else {
                        fileSizeElement.textContent = 'Error getting file size';
                    }
                }
            };
            xhr.send();
        }
    </script>


<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get all the file elements
  var fileElements = document.querySelectorAll('tbody tr');
  // Get the search input element
  var searchInput = document.getElementById('searchInput');

  // Event listener for input change
  searchInput.addEventListener('input', function() {
    var searchText = searchInput.value.toLowerCase().trim();
    // Iterate through each file element
    fileElements.forEach(function(element) {
      var fileName = element.querySelector('td:first-child span').textContent.toLowerCase();
      // If search text is found in the file name, display the row, otherwise hide it
      if (fileName.includes(searchText)) {
        element.style.display = '';
      } else {
        element.style.display = 'none';
      }
    });
  });

  // Remaining JavaScript code remains the same
  // ...
});
</script>
  </main><!-- End #main -->



<?php 
 }else{
    header("Location: ../faculty-portal.php");
    exit();
 }
 ?>
<?php
include('../assets/includes/footer.php');
?>


