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
            message: '<img src="../images/icon.png" height="80px" width="100px" style="position: absolute;top:30px;left:200px;"><center><br><br><h5 style="margin-top:-40px;font-style: italic;">Republic of the Philippines</h5><h5>Province of Batangas</h5><h4 style="font-weight: bold;">MUNICIPALITY OF LIAN</h4><br><br><br><h2 style="font-weight: bold;">OFFICE OF THE MUNICIPAL ENVIRONMENT & NATURAL RESOURCES OFFICER</h2></center><br><br><br>',
            exportOptions: {
                columns: ':not(.no-export)' // Exclude columns with the class "no-export"
            },
            title: '', // Remove the title
            customize: function (win) {
                $(win.document.body).find('table')
                    .append('<br><br><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');
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
