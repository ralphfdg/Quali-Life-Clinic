<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Generation</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            background: white;
            color: black;
            font-family: "Times New Roman", Times, serif;
        }

        .table th {
            background-color: #f8f9fa !important;
            color: #000;
        }

        /* Hide the control bar when actually printing */
        @media print {
            .no-print {
                display: none !important;
            }

            .shadow {
                box-shadow: none !important;
            }

            .card {
                border: none !important;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }

        /* Screen-only styles for the control bar */
        .print-controls {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #333;
            color: white;
            padding: 10px 20px;
            z-index: 9999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Push content down so it isn't hidden by the bar */
        .content-wrapper {
            margin-top: 60px;
        }
    </style>
</head>

<body>

    <div class="print-controls no-print">
        <div>
            <strong>Report Preview</strong>
        </div>
        <div>
            <button onclick="window.print()" class="btn btn-success btn-sm font-weight-bold">
                <i class="fas fa-file-pdf"></i> Save as PDF / Print
            </button>
            <button onclick="window.close()" class="btn btn-danger btn-sm ml-2">
                Close Tab
            </button>
        </div>
    </div>

    <div class="content-wrapper">
        <?php echo $content; ?>
    </div>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script>
        // Wait 500ms for styles to load, then try to print
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>

</body>

</html>