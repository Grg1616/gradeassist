<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GradeAssist</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/icon.png" rel="icon">
  <link href="../assets/img/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css">

      <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<style>

/*--------------------------------------------------------------
# datatable
--------------------------------------------------------------*/

div.dt-button-collection {
    width: auto;
}

div.dt-button-collection button.dt-button {
    display: inline-block;
    width: auto;
}

div.dt-button-collection button.buttons-colvis {
    display: inline-block;
    width: auto;
}
div.dt-button-collection h3 {
    margin-top: 5px;
    margin-bottom: 5px;
    font-weight: 100;
    border-bottom: 1px solid rgba(150, 150, 150, 0.5);
    font-size: 1em;
    padding: 0 1em;
    color: #026601;
}

div.dt-button-collection h3.not-top-heading {
    margin-top: 10px;
}

div.dt-buttons > .dt-button,
div.dt-buttons > div.dt-button-split .dt-button {
  position: relative;
  display: inline-block;
  box-sizing: border-box;
  margin-left: 0.167em;
  margin-right: 0.167em;
  margin-bottom: 0.333em;
  padding: 0.25em 0.5em; /* Adjust padding */
  border: #28A745;
  border-radius: 2px;
  cursor: pointer;
  font-size: 0.75em; /* Adjust font-size */
  line-height: 1.2em; /* Adjust line-height */
  color: #ffffff; /* White text color */
  background-color: #28A745; /* Background color */
  white-space: nowrap;
  overflow: hidden;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  text-decoration: none;
  outline: none;
  text-overflow: ellipsis;
}
div.dt-buttons > .dt-button:hover:not(.disabled),
div.dt-buttons > div.dt-button-split .dt-button:hover:not(.disabled) {
  border: 1px solid #28A745;
  background-color: rgb(74, 180, 17); /* Fallback */
  background: linear-gradient(to bottom, rgb(74, 180, 17) 0%, rgb(69, 211, 12) 100%);
 /* filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="rgba(153, 153, 153, 0.1)", EndColorStr="rgba(0, 0, 0, 0.1)");*/
}

/*--------------------------------------------------------------
# sweetalert
--------------------------------------------------------------*/

.my-sweetalert {
    padding-bottom: 40px; /* You can adjust the padding value as needed */

</style>

<body>
