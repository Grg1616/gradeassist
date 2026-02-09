$(document).ready(function() {
    var currentDate = new Date().toLocaleDateString().replace(/\//g, '-');
    var pageTitle = document.title;

    var url = window.location.pathname;
    var fileNameWithExtension = url.substring(url.lastIndexOf('/') + 1);
    var fileName = fileNameWithExtension.split('.').slice(0, -1).join('.');
    console.log(fileName);

    var buttons = [
        '<h3>Export</h3>',
        {
            extend: 'copy',
            className: 'no-export',
            exportOptions: {
                columns: ':not(.no-export)' // Exclude columns with the class "no-export"
            },
            title: '' // Remove the title
        },
        {
            extend: 'csv',
            className: 'no-export',
            exportOptions: {
                columns: ':not(.no-export)' // Exclude columns with the class "no-export"
            },
            title: '' // Remove the title
        },
        {
            extend: 'excel',
            className: 'no-export',
            exportOptions: {
                columns: ':not(.no-export)' // Exclude columns with the class "no-export"
            },
            title: '' // Remove the title
        },
        {
            extend: 'pdfHtml5',
            className: 'no-export',
            exportOptions: {
                columns: ':not(.no-export)' // Exclude columns with the class "no-export"
            },
            title: '' // Remove the title
        },
        {
            extend: 'print',
            className: 'no-export',
            message: '<div style="text-align: center;"><img src="../img/bsu_logo.jpg" style="position: absolute; left: 90px; top: 5.5px; width: 35px;"><p style="font-family: times, serif; font-weight: bold; font-size: 12pt;">Republic of the Philippines</p><p style="font-family: times, serif; font-weight: bold; font-size: 16pt;">BATANGAS STATE UNIVERSITY</p><p style="font-family: helvetica, sans-serif; font-weight: bold; font-size: 12pt; color: rgb(210, 54, 59);">The National Engineering University</p><p style="font-family: times, serif; font-weight: bold; font-size: 12pt;">ARASOF-Nasugbu Campus</p><p style="font-family: times, serif; font-weight: bold; font-size: 10pt;">R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231</p></div><hr style="border: none; border-top: 0.7px solid black;">',
            exportOptions: {
                columns: ':not(.no-export)' // Exclude columns with the class "no-export"
            },
            title: '', // Remove the title
            customize: function (win) {
                $(win.document.body).find('table')
                    .append('<br><br><h6 class="">Noted by:</h6><br><br><h6 class="">Prepared by:</h6>');
            }
        },
        '<h3 class="not-top-heading">Column Visibility</h3>',
        'colvis' // Add 'colvis' button for column visibility
    ];

    buttons.forEach(function(button) {
        if (typeof button === 'object' && button.extend && button.extend !== 'collection') {
            button.filename = pageTitle + ' ' + fileName + ' ' + currentDate;
        }
    });

    var dataTableConfig = {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                className: 'custom-html-collection',
                text: 'Options',
                buttons: buttons
            },
            'pageLength'
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        stateSave: true // Enable state saving
    };

    $('#example').DataTable(dataTableConfig);

    var collectionButton = $('.custom-html-collection');
    collectionButton.attr('data-toggle', 'tooltip');
    collectionButton.attr('title', 'Click to see options for export and column visibility');
    collectionButton.tooltip();
});
