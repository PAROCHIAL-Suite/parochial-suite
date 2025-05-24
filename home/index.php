<?php
include '../config/connection.php';

// Get counts
$getFamilyCount = "SELECT COUNT(*) AS totalFamilyCount FROM family_master_table";
$result = $conn->query($getFamilyCount);
$totalFamilyCount = $result->fetch_assoc()['totalFamilyCount'] ?? 0;

$getMemberCount = "SELECT COUNT(*) AS totalUsers FROM family_member";
$result = $conn->query($getMemberCount);
$totalUsers = $result->fetch_assoc()['totalUsers'] ?? 0;

$baptismCount = $conn->query("SELECT COUNT(*) AS baptismCount FROM baptism")->fetch_assoc()['baptismCount'] ?? 0;
$communionCount = $conn->query("SELECT COUNT(*) AS communionCount FROM eucharist")->fetch_assoc()['communionCount'] ?? 0;
$confirmationCount = $conn->query("SELECT COUNT(*) AS confirmationCount FROM confirmation")->fetch_assoc()['confirmationCount'] ?? 0;
$burialCount = $conn->query("SELECT COUNT(*) AS burialCount FROM burial")->fetch_assoc()['burialCount'] ?? 0;

// Add these queries to get male and female counts
$maleCount = $conn->query("SELECT COUNT(*) AS male FROM family_member WHERE gender='Male'")->fetch_assoc()['male'] ?? 0;
$femaleCount = $conn->query("SELECT COUNT(*) AS female FROM family_member WHERE gender='Female'")->fetch_assoc()['female'] ?? 0;

// Active/Inactive families
$activeFamilies = $conn->query("SELECT COUNT(*) AS active FROM family_master_table WHERE status='ACTIVE'")->fetch_assoc()['active'] ?? 0;
$inactiveFamilies = $conn->query("SELECT COUNT(*) AS inactive FROM family_master_table WHERE status='IN-ACTIVE'")->fetch_assoc()['inactive'] ?? 0;

// Example events (replace with DB query if needed)
$events = [
    ['date' => '2025-05-25', 'title' => 'Parish Council Meeting'],
    ['date' => '2025-05-28', 'title' => 'Youth Group Gathering'],
    ['date' => '2025-06-01', 'title' => 'Community Outreach'],
    ['date' => '2025-05-25', 'title' => 'Parish Council Meeting'],
    ['date' => '2025-05-28', 'title' => 'Youth Group Gathering'],
    ['date' => '2025-06-01', 'title' => 'Community Outreach'],
    ['date' => '2025-05-25', 'title' => 'Parish Council Meeting'],
    ['date' => '2025-05-28', 'title' => 'Youth Group Gathering'],
    ['date' => '2025-06-01', 'title' => 'Community Outreach'],
];

// Example reminders/tasks
$tasks = [
    ['due' => '2025-05-24', 'task' => 'Update Family Records'],
    ['due' => '2025-05-27', 'task' => 'Send Event Reminders'],
    ['due' => '2025-06-02', 'task' => 'Review Baptism Applications'],
];

// Example quick links
$quickLinks = [
    ['icon' => 'fa-users', 'label' => 'Families', 'url' => '../family/family_list.php'],
    ['icon' => 'fa-user-friends', 'label' => 'Members', 'url' => '../family/member_list.php'],
    ['icon' => 'fa-baby', 'label' => 'Baptism', 'url' => '../baptism/baptism_reg.php'],
    ['icon' => 'fa-bread-slice', 'label' => 'Communion', 'url' => '../eucharist/index.php'],
    ['icon' => 'fa-dove', 'label' => 'Confirmation', 'url' => '../confirmation/index.php'],
    ['icon' => 'fa-cross', 'label' => 'Burial', 'url' => '../burial/index.php'],
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
            grid-template-columns: 1fr 2.2fr 1fr;
            /* Center column is much wider */
            gap: 22px;
            padding: 32px 32px 0 32px;
            max-width: 1800px;
            /* Increased from 1400px */
            margin: 0 auto;
            align-items: start;
        }

        @media (max-width: 1300px) {
            .parochialsuite-dashboard {
                grid-template-columns: 1fr;
                padding: 16px 4px 0 4px;
                max-width: 100%;
            }
        }

        .ps-widget {
            background: #fff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            padding: 0;
            display: flex;
            flex-direction: column;
            margin-bottom: 28px;
        }

        /* Use your primary color variable from parochialUI.css for widget icon and title */
        :root {
            --primary: rgb(34, 90, 162);
            /* Adjust this if your primary color is different */
        }

        /* Replace the solid background with a beautiful gradient */
        .ps-widget-header {
            padding: 10px 20px 10px 20px;
            border-bottom: 1px solid #e6e8eb;
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary);
            /* Title uses primary color */
            background: linear-gradient(90deg, #dde4ed 0%, #e3f0ff 100%);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ps-widget-header .fa,
        .ps-widget-header .fa-solid {
            color: var(--primary);
            /* Icon uses primary color */
            font-size: 1.2em;
        }

        .ps-widget-content {
            padding: 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .ps-kpi-row {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            margin-bottom: 0px;
        }

        /* Make KPI widget colors softer and more eye-friendly */
        .ps-kpi {
            flex: 1 1 120px;
            min-width: 160px;
            /* border-radius: 6px; */
            padding: 20px;
            margin-bottom: 8px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            color: #2a3b4d;
            font-weight: 500;
            background: #f6f8fa;
            /* Default soft background */
            box-shadow: 0 1px 4px rgba(60, 64, 67, 0.04);

        }

        .ps-kpi:nth-child(1) {
            background: linear-gradient(135deg, #e3f0ff 70%, #f7fafd 100%);
        }

        .ps-kpi:nth-child(2) {
            background: linear-gradient(135deg, #ffe0b2 70%, #fffde7 100%);
        }

        .ps-kpi:nth-child(3) {
            background: linear-gradient(135deg, #e1f5fe 70%, #e0f7fa 100%);
        }

        .ps-kpi:nth-child(4) {
            background: linear-gradient(135deg, #fce4ec 70%, #f3e5f5 100%);
        }

        .ps-kpi:nth-child(5) {
            background: linear-gradient(135deg, #e8f5e9 70%, #f1f8e9 100%);
        }

        .ps-kpi-label,
        .ps-kpi-sub {
            color: #2a3b4d !important;
        }

        .ps-kpi-value {
            font-size: 1rem;
            font-weight: bold;
            color: #2a3b4d;
        }

        .ps-list {
            list-style: none;
            padding: 0;
            margin: 0;
            overflow: auto;
            max-height: 500px;
            position: relative;
        }

        .ps-list li {
            display: flex;
            align-items: center;
            padding: 7px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.98rem;
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

        .ps-quicklinks {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 8px;

        }

        .ps-quicklink {
            display: flex;
            align-items: center;
            background: #f6f8fa;
            border-radius: 6px;
            padding: 8px 14px;
            text-decoration: none;
            color: #2a3b4d;
            font-size: 0.98rem;
            transition: background 0.15s;
        }

        .ps-quicklink:hover {
            background: #e3eafc;
        }

        .ps-quicklink .fa {
            margin-right: 8px;
            font-size: 1.1rem;
            color: #6c7a89;
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
    <?php include '../nav/global_nav.php'; ?>
    <br><br>
    <div class="pageName">
        <h3>HOME</h3>
    </div>
    <div class="parochialsuite-dashboard">
        <!-- Left Column -->
        <div>
            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-calendar-alt"></i> Upcoming Events</div>
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
            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-bell"></i> Reminders & Tasks</div>
                <div class="ps-widget-content">
                    <ul class="ps-list">
                        <?php if (count($tasks)): ?>
                            <?php foreach ($tasks as $task): ?>
                                <li>
                                    <i class="fa fa-check-circle"></i>
                                    <span
                                        style="min-width:90px;display:inline-block;"><?php echo date('M d, Y', strtotime($task['due'])); ?></span>
                                    <span><?php echo htmlspecialchars($task['task']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No pending tasks.</li>
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
                        <!-- <div class="ps-kpi">
                            <div class="ps-kpi-label">Marriage</div>
                            <div class="ps-kpi-value"><?php echo $marriageCount; ?></div>
                        </div> -->
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Burial</div>
                            <div class="ps-kpi-value"><?php echo $burialCount; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ps-widget">
                <div class="ps-widget-header"><i class="fa fa-chart-bar"></i> Key Metrics</div>
                <div class="ps-widget-content">
                    <div class="ps-kpi-row">
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Total Family</div>
                            <div class="ps-kpi-value"><?php echo $family_count; ?></div>
                        </div>
                        <div class="ps-kpi">
                            <div class="ps-kpi-label">Total Member</div>
                            <div class="ps-kpi-value"><?php echo $total_member; ?></div>
                        </div>

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
                        'rgba(34, 90, 162, 0.6)',   // Blue
                        'rgba(255, 193, 7, 0.6)',   // Amber
                        'rgba(76, 175, 80, 0.6)',   // Green
                        'rgba(233, 30, 99, 0.6)'    // Pink
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
    </script>
</body>

</html>