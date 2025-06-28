<?php
include '../config/connection.php';

// Get counts
$getFamilyCount = "SELECT COUNT(*) AS totalFamilyCount FROM family_members WHERE stationID = '$STATION_CODE' AND relation_with_head = 'Head'";
$result = $conn->query($getFamilyCount);
$totalFamilyCount = $result->fetch_assoc()['totalFamilyCount'] ?? 0;

$getMemberCount = "SELECT COUNT(*) AS totalUsers FROM family_members WHERE stationID = '$STATION_CODE'";
$result = $conn->query($getMemberCount);
$totalUsers = $result->fetch_assoc()['totalUsers'] ?? 0;

$baptismCount = $conn->query("SELECT COUNT(*) AS baptismCount FROM baptism WHERE stationID = '$STATION_CODE'")->fetch_assoc()['baptismCount'] ?? 0;
$communionCount = $conn->query("SELECT COUNT(*) AS communionCount FROM eucharist WHERE stationID = '$STATION_CODE'")->fetch_assoc()['communionCount'] ?? 0;
$confirmationCount = $conn->query("SELECT COUNT(*) AS confirmationCount FROM confirmation WHERE stationID = '$STATION_CODE'")->fetch_assoc()['confirmationCount'] ?? 0;
$burialCount = $conn->query("SELECT COUNT(*) AS burialCount FROM burial WHERE stationID = '$STATION_CODE'")->fetch_assoc()['burialCount'] ?? 0;

// Add these queries to get male and female counts
$maleCount = $conn->query("SELECT COUNT(*) AS male FROM family_members WHERE gender='Male' AND stationID = '$STATION_CODE'")->fetch_assoc()['male'] ?? 0;
$femaleCount = $conn->query("SELECT COUNT(*) AS female FROM family_members WHERE gender='Female' AND stationID = '$STATION_CODE'")->fetch_assoc()['female'] ?? 0;

// Active/Inactive families
$activeFamilies = $conn->query("SELECT COUNT(*) AS active FROM family_members WHERE status='ACTIVE'  AND stationID = '$STATION_CODE'")->fetch_assoc()['active'] ?? 0;
$inactiveFamilies = $conn->query("SELECT COUNT(*) AS inactive FROM family_members WHERE status='IN-ACTIVE'  AND stationID = '$STATION_CODE'")->fetch_assoc()['inactive'] ?? 0;

// Example events (replace with DB query if needed)
$events = [
    // ['date' => '2025-05-25', 'title' => 'Parish Council Meeting'],
    // ['date' => '2025-05-28', 'title' => 'Youth Group Gathering'],
    // ['date' => '2025-06-01', 'title' => 'Community Outreach'],
    // ['date' => '2025-05-25', 'title' => 'Parish Council Meeting'],
    // ['date' => '2025-05-28', 'title' => 'Youth Group Gathering'],

];


// Example quick links
$quickLinks = [
    ['icon' => 'fa-users', 'label' => 'Families', 'url' => '../family/family_list.php'],
    ['icon' => 'fa-user-friends', 'label' => 'Members', 'url' => '../family/member_list.php'],
    ['icon' => 'fa-baby', 'label' => 'Baptism', 'url' => '../baptism/baptism_reg.php'],
    ['icon' => 'fa-bread-slice', 'label' => 'Communion', 'url' => '../eucharist/index.php'],
    ['icon' => 'fa-dove', 'label' => 'Confirmation', 'url' => '../confirmation/index.php'],
    ['icon' => 'fa-cross', 'label' => 'Burial', 'url' => '../burial/burial_reg.php'],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/parochialUI.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f4f6f8;
        }


        .parochialsuite-dashboard {
            display: grid;
            grid-template-columns: 0.8fr 2.1fr 0.8fr;
            /* Make center column wider */
            gap: 18px;
            /* Reduce the gap between widgets */
            padding: 16px 16px 0 16px;
            max-width: 1900px;
            margin: 0 auto;
            align-items: start;
        }

        /* ...existing code... */
        @media (max-width: 1300px) {
            .parochialsuite-dashboard {
                grid-template-columns: 1fr;
                padding: 16px 4px 0 4px;
                max-width: 100%;
                gap: 10px;
                /* Reduce gap on small screens too */
            }
        }

        /* ...existing code... */
        .ps-widget {
            background: #fff;
            box-shadow: 0 2px 14px rgba(34, 90, 162, 0.07);
            padding: 0;
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
            border: 1px solid #e6e8eb;
            border-radius: 7px;
        }

        .ps-widget-header {
            padding: 10px 24px 10px 24px;
            border-bottom: 1px solid #e6e8eb;
            font-size: 1rem;
            font-weight: 700;
            color: back;
            background: white;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: 0.5px;

        }

        .ps-widget-header .fa,
        .ps-widget-header .fa-solid {
            color: #225aa2;
            font-size: 1.2em;
            margin-right: 6px;
        }

        .ps-widget-content {
            padding: 18px 18px 10px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .ps-kpi-row {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 0px;
        }

        .ps-kpi {
            flex: 1 1 140px;
            min-width: 160px;
            border-radius: 4px;
            padding: 22px 18px;
            margin-bottom: 8px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            color: #2a3b4d;
            font-weight: 500;
            background: #f6f8fa;
            box-shadow: 0 1px 4px rgba(60, 64, 67, 0.04);
            border: 1px solid #e3e8ee;
            transition: box-shadow 0.15s;
        }

        .ps-kpi:hover {
            box-shadow: 0 4px 16px rgba(34, 90, 162, 0.13);
            transform: translateY(-2px) scale(1.03);
            z-index: 2;
        }

        /* Subtle, professional palette for KPIs (Oracle/Microsoft style) */
        .ps-kpi {
            background: #f6f8fa;
            border-left: 4px solid #225aa2;
        }

        .ps-kpi:nth-child(2) {
            border-left: 4px solid #1976d2;
        }

        .ps-kpi:nth-child(3) {
            border-left: 4px solid #388e3c;
        }

        .ps-kpi:nth-child(4) {
            border-left: 4px solid #b0b8c1;
        }

        .ps-kpi-label {
            color: #2a3b4d !important;
        }

        /* Professional, minimal color palette for KPIs (Oracle/Microsoft style) */
        .ps-widget-header .fa-chart-bar {
            color: #225aa2;
        }

        /* Key Metrics (Sacraments) - blue accent, subtle background */
        .ps-widget .ps-kpi {
            background: #f7f9fb;
            border-left: 4px solid #225aa2;
        }

        .ps-widget .ps-kpi:nth-child(2) {
            border-left: 4px solid #1976d2;
        }

        .ps-widget .ps-kpi:nth-child(3) {
            border-left: 4px solid #388e3c;
        }

        .ps-widget .ps-kpi:nth-child(4) {
            border-left: 4px solid #b0b8c1;
        }

        /* Family & Member Stats KPIs - gray background, different accent colors */
        .ps-widget[data-section="famstats"] .ps-kpi {
            background: #f3f4f6;
        }

        .ps-widget[data-section="famstats"] .ps-kpi.fam-total {
            border-left: 4px solid #607d8b;
        }

        .ps-widget[data-section="famstats"] .ps-kpi.fam-member {
            border-left: 4px solid #455a64;
        }

        .ps-widget[data-section="famstats"] .ps-kpi.fam-male {
            border-left: 4px solid #1565c0;
        }

        .ps-widget[data-section="famstats"] .ps-kpi.fam-female {
            border-left: 4px solid #ad1457;
        }

        .ps-widget[data-section="famstats"] .ps-kpi.fam-active {
            border-left: 4px solid #388e3c;
        }

        .ps-widget[data-section="famstats"] .ps-kpi.fam-inactive {
            border-left: 4px solid #b0b8c1;
        }

        .ps-kpi-label {
            color: #2a3b4d !important;
            font-size: 1.02rem;
            margin-bottom: 4px;
        }

        .ps-kpi-value {
            font-size: 1.35rem;
            font-weight: bold;
            color: #225aa2;
        }

        .ps-list {
            list-style: none;
            padding: 0;
            margin: 0;
            overflow: auto;
            max-height: 320px;
            position: relative;
        }

        .ps-list li {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 1.01rem;
            transition: background 0.13s;
        }

        .ps-list li:last-child {
            border-bottom: none;
        }

        .ps-list .fa,
        .ps-list .fa-solid {
            margin-right: 10px;
            color: #b0b8c1;
            font-size: 1.1rem;
        }

        .ps-list li:hover {
            background: #f5f7fa;
            cursor: pointer;
        }

        .ps-quicklinks {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 8px;
        }

        .ps-quicklink {
            display: flex;
            align-items: center;
            background: white;

            border-radius: 8px;
            padding: 10px 18px;
            text-decoration: none;
            color: #225aa2;
            font-size: 1.04rem;
            font-weight: 600;
            box-shadow: 0 1px 4px rgba(60, 64, 67, 0.04);
            transition: background 0.15s, box-shadow 0.15s;
        }

        .ps-quicklink:hover {
            background: #dde4ed;
            box-shadow: 0 4px 16px rgba(34, 90, 162, 0.10);
        }

        .ps-quicklink .fa {
            margin-right: 10px;
            font-size: 1.15rem;
            color: #1976d2;
        }

        .ps-chart-container {
            width: 100%;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php @include '../nav/app_header_nav.php';
    include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>HOME</h3>
    </div>

    <div class="parochialsuite-dashboard">
        <!-- Left Column -->
        <div>
            <div class="ps-widget" hidden>
                <div class="ps-widget-header"><i class="fa fa-calendar-day"></i> Upcoming Events</div>
                <div class="ps-widget-content">
                    <ul class="ps-list">
                        <?php if (count($events)): ?>
                            <?php foreach ($events as $event): ?>
                                <li>
                                    <i class="fa fa-calendar-day"></i>
                                    <span
                                        style="min-width:90px;display:inline-block;"><?php echo date('M d, Y', strtotime($event['date'])); ?></span>
                                    <span><?php echo htmlspecialchars($event['title']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No upcoming events.</li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>


        </div>
        <!-- Center Column (wider) -->
        <div>
            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-chart-bar"></i> Key Metrics</div>
                <div class="ps-widget-content">
                    <div class="ps-kpi-row">
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Baptism</div>
                            <div class="ps-kpi-value"><?php echo $baptismCount; ?></div>
                        </div>
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Communion</div>
                            <div class="ps-kpi-value"><?php echo $communionCount; ?></div>
                        </div>
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Confirmation</div>
                            <div class="ps-kpi-value"><?php echo $confirmationCount; ?></div>
                        </div>
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Burial</div>
                            <div class="ps-kpi-value"><?php echo $burialCount; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ps-widget" data-section="famstats">
                <div class="ps-widget-header"><i class="fa fa-users"></i> Family & Member Stats</div>
                <div class="ps-widget-content">
                    <div class="ps-kpi-row">
                        <div class="ps-kpi fam-total">
                            <div class="ps-kpi-label">Total Family</div>
                            <div class="ps-kpi-value"><?php echo $totalFamilyCount; ?></div>
                        </div>
                        <div class="ps-kpi fam-member">
                            <div class="ps-kpi-label">Total Member</div>
                            <div class="ps-kpi-value"><?php echo $totalUsers; ?></div>
                        </div>
                        <div class="ps-kpi fam-male">
                            <div class="ps-kpi-label">Male</div>
                            <div class="ps-kpi-value"><?php echo $maleCount; ?></div>
                        </div>
                        <div class="ps-kpi fam-female">
                            <div class="ps-kpi-label">Female</div>
                            <div class="ps-kpi-value"><?php echo $femaleCount; ?></div>
                        </div>
                    </div>
                    <div class="ps-kpi-row">
                        <div class="ps-kpi fam-active">
                            <div class="ps-kpi-label">Active Families</div>
                            <div class="ps-kpi-value"><?php echo $activeFamilies; ?></div>
                        </div>
                        <div class="ps-kpi fam-inactive">
                            <div class="ps-kpi-label">Inactive Families</div>
                            <div class="ps-kpi-value"><?php echo $inactiveFamilies; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-link"></i> Quick Links</div>
                <div class="ps-widget-content">
                    <div class="ps-quicklinks">
                        <?php foreach ($quickLinks as $link): ?>
                            <a class="ps-quicklink" href="<?php echo $link['url']; ?>">
                                <i class="fa <?php echo $link['icon']; ?>"></i>
                                <?php echo htmlspecialchars($link['label']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>


            </div>
        </div>
        <!-- Right Column -->
        <div>
            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-chart-pie"></i> Sacraments Distribution</div>
                <div class="ps-widget-content">
                    <div class="ps-chart-container" style="min-height:120px; max-width:320px; margin:0 auto;">
                        <canvas id="sacramentChart" width="180" height="120" style="max-width:100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-chart-area"></i> Parish Insights Graph</div>
                <div class="ps-widget-content">
                    <div class="ps-chart-container" style="min-height:140px; max-width:340px; margin:0 auto;">
                        <canvas id="parishInsightsChart" width="220" height="140" style="max-width:100%;"></canvas>
                    </div>
                </div>
                <script>
                    // Unique Parish Insights: Polar Area Chart
                    const parishInsightsCtx = document.getElementById('parishInsightsChart').getContext('2d');
                    new Chart(parishInsightsCtx, {
                        type: 'polarArea',
                        data: {
                            labels: [
                                'Active Families',
                                'Inactive Families',
                                'Male Members',
                                'Female Members'
                            ],
                            datasets: [{
                                label: 'Count',
                                data: [
                                    <?php echo $activeFamilies; ?>,
                                    <?php echo $inactiveFamilies; ?>,
                                    <?php echo $maleCount; ?>,
                                    <?php echo $femaleCount; ?>
                                ],
                                backgroundColor: [
                                    'rgba(121, 200, 75, 0.7)',    // Green
                                    'rgba(176, 184, 193, 0.7)',  // Gray
                                    'rgba(21, 101, 192, 0.7)',   // Blue
                                    'rgba(173, 20, 87, 0.7)'     // Pink
                                ],
                                borderColor: [
                                    'rgb(55, 179, 48)',
                                    'rgba(176, 184, 193, 1)',
                                    'rgba(21, 101, 192, 1)',
                                    'rgba(173, 20, 87, 1)'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'bottom' }
                            },
                            scales: {
                                r: {
                                    beginAtZero: true,
                                    ticks: { precision: 0 }
                                }
                            }
                        }
                    });
                </script>

            </div>
        </div>

    </div>
    <script>
        // Doughnut chart for Sacraments
        const ctx = document.getElementById('sacramentChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Baptism', 'Communion', 'Confirmation', 'Burial'],
                datasets: [{
                    data: [
                        <?php echo $baptismCount; ?>,
                        <?php echo $communionCount; ?>,
                        <?php echo $confirmationCount; ?>,
                        <?php echo $burialCount; ?>
                    ],
                    backgroundColor: [
                        'rgba(34, 113, 216, 0.6)',   // Blue
                        'rgba(255, 191, 0, 0.6)',   // Amber
                        'rgba(76, 175, 80, 0.6)',   // Green
                        'rgba(255, 0, 85, 0.6)'    // Pink
                    ],
                    borderColor: [
                        'rgba(34, 90, 162, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(76, 175, 80, 1)',
                        'rgba(233, 30, 99, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '65%'
            }
        });




        // Update server time every second
        // Live server time
        function updateServerTime() {
            const now = new Date();
            document.getElementById('serverTime').textContent =
                now.toLocaleString(undefined, { hour12: false });
        }
        updateServerTime();
        setInterval(updateServerTime, 1000);
    </script>



    <footer style="text-align: center; padding: 10px; font-size: 0.9rem; color: #666;">
        <p>&copy; <?php echo date('Y'); ?> PAROCHIAL Suite. All rights reserved.</p>
        <center>Version <B>NOVA 25.0.0</B></center>


</body>

</html>