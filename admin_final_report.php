<?php
    /*
        clickable table to edit data
        https://www.youtube.com/watch?v=vYoGKtdl7dQ
    */
    require "connection.php";  

    echo '<html lang="en">';
        echo '<head>' .
            '<meta charset="utf-8">' .
            '<meta http-equiv="X-UA-Compatible" content="IE=edge">' .
            '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
            '<meta name="description" content="">' .
            '<meta name="author" content="">' .

            '<title>Report</title>' .

            '<link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' .
            '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' .
            '<link href="template/css/sb-admin-2.min.css" rel="stylesheet">' .
            '<link href="template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">' .

            '<style>' .
                '@page { size: landscape; }
                table, th, td {
                    border: 2px solid black;
                    border-collapse: collapse;
                  }

                  table, th, td {
                    padding: 15px;
                    text-align: center
                  }
                  .center {
                    margin-left: auto;
                    margin-right: auto;
                  }' .
            '</style>' .
        '</head>';

        $reportId = $_GET["id"];

        $query = "SELECT * FROM complaint WHERE reportID = '$reportId'";
        $result = mysqli_query($link, $query);

        $r = mysqli_fetch_assoc($result);

        echo '<body style="text-align:center">' .
            
        '<h3>' .
            '<img src="KUPTM logo.png" alt="Logo KUPTMs" width="100" height="50">' .
            'BORANG HAZARD IDENTIFICATION, RISK ASSESMENT & RISK CONTROL (HIRARC)' .
        '</h3>' .

            '<table class="center">' .
                '<tr>' .
                    '<th rowspan="2">Lokasi</th>' .
                    '<td rowspan="2" style="width: 30%">' . $r["venue"] . '</td>' .
                    '<td style="width: 5%"></td>' .
                    '<td>Desediakan Oleh</td>' .
                    '<td>Disemakkan Oleh</td>' .
                    '<td>Disahkan Oleh</td>' .
                '</tr>' .
                '<tr>' . 
                    '<td>Nama</td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                '</tr>' .
                '<tr>' .
                    '<th rowspan="2">Proses</th>' .
                    '<td rowspan="2"></td>' .
                    '<td>Tandatangan</td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                '</tr>' .
                '<tr>' . 
                    '<td>Tarikh</td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                '</tr>' .
            '</table>' .

            '<br /><br />';
                
            $query = "SELECT
                        report.*,
                        report_handler.*,
                        hazard.*,
                        risk_analysis.*,
                        risk_control.*,
                        pic.*
                    FROM report
                    JOIN report_handler 
                        ON report.reportID = '$reportId'
                        AND report_handler.reportID = report.reportID
                    JOIN hazard 
                        ON hazard.reportID = report.reportID
                    JOIN risk_analysis 
                        ON risk_analysis.reportID = report.reportID 
                        AND risk_analysis.mitigationID = hazard.mitigationID 
                    JOIN risk_control 
                        ON risk_control.reportID = report.reportID 
                        AND risk_control.mitigationID = hazard.mitigationID
                    JOIN pic
                        ON report_handler.picID = pic.picID";
            $result = mysqli_query($link, $query);

            echo
            '<table>' .
                '<tr>' .
                    '<th></th>' .
                    '<th colspan="3">Kenalpasti Hazard</th>' .
                    '<th colspan="4">Analisa Risiko</th>' .
                    '<th colspan="3">Kawalan Risiko</th>' .
                    '<th>Status</th>' .
                '</tr>' .
                '<tr>' . 
                   '<td>No.</td>' .
                   '<td>Aktiviti</td>' .
                   '<td>Hazard</td>' .
                   '<td>Kesan Hazard</td>' .
                   '<td>Kawalan Sedia Ada (Jika Ada)</td>' .
                   '<td>Kebarangkalian</td>' .
                   '<td>Kesan Risiko</td>' .
                   '<td>Tahap Hazard</td>' .
                   '<td>Rancangan Mitigasi</td>' .
                   '<td>PYB (PIC)</td>' .
                   '<td>Jangkaan Tarikh Siap</td>' .
                   '<td>Open/In Progress/Monitoring/Resolved/Close</td>' .
                '</tr>';
                $counter = 1;
                while($row = mysqli_fetch_assoc($result))
                {
                    $table = 
                    '<tr>' .
                        '<td>' . $counter . '</td>' .
                        '<td>' . $row["hazardActivity"] . '</td>' .
                        '<td>' . $row["hazard"] . '</td>' .
                        '<td>' . $row["hazardImpact"] . '</td>' .
                        '<td>' . $row["existingControl"] . '</td>' .
                        '<td>' . $row["probability"] . '</td>' .
                        '<td>' . $row["impact"] . '</td>' .
                        '<td>' . $row["riskLevel"] . '</td>' .
                        '<td>' . $row["mitigationPlan"] . '</td>' .
                        '<td style="text-transform: capitalize">' . $row["picFullname"] . '</td>' .
                        '<td>' . $row["expectedDateSolved"] . '</td>' .
                        '<td>';
                                if($row['status'] == '0')
                                { 
                                    $table .= 'Open';
                                }
                                else if($row['status'] == '1')
                                { 
                                    $table .= 'In Progress';
                                }
                                else if($row['status'] == '2')
                                { 
                                    $table .= 'Monitoring';
                                }
                                else if($row['status'] == '3')
                                { 
                                    $table .= 'Resolved';
                                }
                                else if($row['status'] == '4')
                                { 
                                    $table .= 'Close';
                                }
                            $table .= '</td>' .
                    '</tr>';

                    echo $table;
                    $counter++;
                }
            echo
            '</table>' .
        '</body>';
    echo '</html>';
?>