<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parochial Suite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
      <!-- Main Content -->
        <main class="app-content">
        <?php include '../nav/global_nav.php'; ?>

            <div class="content-header">
                <h1>Dashboard Overview</h1>
                <div class="breadcrumbs">
                    <span>Home</span> / <span>Dashboard</span> / <span>Overview</span>
                </div>

            </div>
            
            <div class="dashboard-widgets">
                <!-- KPI Widgets Row -->
                <div class="widget-row">
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Sales This Month</h3>
                            <div class="widget-actions">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value">$124,568</div>
                            <div class="kpi-change positive">
                                <i class="fas fa-arrow-up"></i> 12% from last month
                            </div>
                        </div>
                    </div>
                    
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Open Orders</h3>
                            <div class="widget-actions">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value">42</div>
                            <div class="kpi-change negative">
                                <i class="fas fa-arrow-down"></i> 5% from last month
                            </div>
                        </div>
                    </div>
                    
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Inventory Value</h3>
                            <div class="widget-actions">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value">$356,892</div>
                            <div class="kpi-change neutral">
                                No change
                            </div>
                        </div>
                    </div>
                    
                    <div class="widget kpi-widget">
                        <div class="widget-header">
                            <h3>Gross Profit</h3>
                            <div class="widget-actions">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="kpi-value">$78,450</div>
                            <div class="kpi-change positive">
                                <i class="fas fa-arrow-up"></i> 8% from last month
                            </div>
                        </div>
                    </div>

                </div>
                
                <!-- Chart Widget -->
                <div class="widget-row">
                    <div class="widget chart-widget">
                        <div class="widget-header">
                            <h3>Sales Trend</h3>
                            <div class="widget-actions">
                                <select class="chart-period">
                                    <option>Last 7 Days</option>
                                    <option selected>Last 30 Days</option>
                                    <option>Last Quarter</option>
                                    <option>Last Year</option>
                                </select>
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="widget pie-widget">
                        <div class="widget-header">
                            <h3>Revenue by Category</h3>
                            <div class="widget-actions">
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                        </div>
                        <div class="widget-content">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Transactions -->
                <div class="widget-row">
                    <div class="widget table-widget">
                        <div class="widget-header">
                            <h3>Recent Sales Orders</h3>
                            <div class="widget-actions">
                                <button class="btn-link">View All</button>
                            </div>
                        </div>
                        <div class="widget-content">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SO-10025</td>
                                        <td>Acme Corporation</td>
                                        <td>2023-06-15</td>
                                        <td>$12,450.00</td>
                                        <td><span class="status-badge pending">Pending</span></td>
                                        <td>
                                            <button class="table-action"><i class="fas fa-eye"></i></button>
                                            <button class="table-action"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SO-10024</td>
                                        <td>Globex Inc.</td>
                                        <td>2023-06-14</td>
                                        <td>$8,720.50</td>
                                        <td><span class="status-badge fulfilled">Fulfilled</span></td>
                                        <td>
                                            <button class="table-action"><i class="fas fa-eye"></i></button>
                                            <button class="table-action"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SO-10023</td>
                                        <td>Initech LLC</td>
                                        <td>2023-06-12</td>
                                        <td>$5,340.00</td>
                                        <td><span class="status-badge shipped">Shipped</span></td>
                                        <td>
                                            <button class="table-action"><i class="fas fa-eye"></i></button>
                                            <button class="table-action"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SO-10022</td>
                                        <td>Umbrella Corp</td>
                                        <td>2023-06-10</td>
                                        <td>$23,150.75</td>
                                        <td><span class="status-badge pending">Pending</span></td>
                                        <td>
                                            <button class="table-action"><i class="fas fa-eye"></i></button>
                                            <button class="table-action"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Tasks and Alerts -->
                <div class="widget-row">
                    <div class="widget tasks-widget">
                        <div class="widget-header">
                            <h3>My Tasks</h3>
                            <div class="widget-actions">
                                <button class="btn-link">View All</button>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="task-item">
                                <div class="task-checkbox">
                                    <input type="checkbox" id="task1">
                                </div>
                                <div class="task-details">
                                    <label for="task1">Approve vendor invoices</label>
                                    <div class="task-meta">
                                        <span class="task-due">Due today</span>
                                        <span class="task-priority high">High</span>
                                    </div>
                                </div>
                            </div>
                            <div class="task-item">
                                <div class="task-checkbox">
                                    <input type="checkbox" id="task2">
                                </div>
                                <div class="task-details">
                                    <label for="task2">Follow up on SO-10025</label>
                                    <div class="task-meta">
                                        <span class="task-due">Due tomorrow</span>
                                        <span class="task-priority medium">Medium</span>
                                    </div>
                                </div>
                            </div>
                            <div class="task-item">
                                <div class="task-checkbox">
                                    <input type="checkbox" id="task3">
                                </div>
                                <div class="task-details">
                                    <label for="task3">Process payroll</label>
                                    <div class="task-meta">
                                        <span class="task-due">Jun 20</span>
                                        <span class="task-priority high">High</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="widget alerts-widget">
                        <div class="widget-header">
                            <h3>System Alerts</h3>
                            <div class="widget-actions">
                                <button class="btn-link">View All</button>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="alert-item warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div class="alert-content">
                                    <div class="alert-title">Low Inventory Warning</div>
                                    <div class="alert-description">Product A-100 is below minimum stock level</div>
                                </div>
                            </div>
                            <div class="alert-item info">
                                <i class="fas fa-info-circle"></i>
                                <div class="alert-content">
                                    <div class="alert-title">New Feature Available</div>
                                    <div class="alert-description">Advanced reporting module is now enabled</div>
                                </div>
                            </div>
                            <div class="alert-item danger">
                                <i class="fas fa-times-circle"></i>
                                <div class="alert-content">
                                    <div class="alert-title">Scheduled Maintenance</div>
                                    <div class="alert-description">System will be down Saturday 10PM-12AM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>