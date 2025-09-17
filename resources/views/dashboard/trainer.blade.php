<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .dashboard-header {
            background: linear-gradient(to right, #f59e0b, #f97316);
            color: white;
            padding: 25px 30px;
        }
        
        .dashboard-header h2 {
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .dashboard-header h2 i {
            margin-right: 12px;
        }
        
        .dashboard-content {
            padding: 30px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1e293b;
            display: flex;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .download-link, .view-link {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .download-link:hover, .view-link:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        
        .section-title i {
            margin-right: 10px;
            color: #f59e0b;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #f59e0b;
        }
        
        .stat-title {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #f59e0b;
        }
        
        .trainings-table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
        }
        
        .trainings-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }
        
        .trainings-table th {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .trainings-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .trainings-table tr:last-child td {
            border-bottom: none;
        }
        
        .trainings-table tr {
            transition: background-color 0.2s ease;
        }
        
        .trainings-table tr:hover {
            background-color: #f8fafc;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-scheduled {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .status-in_progress {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        
        .status-completed {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .batch-name {
            font-weight: 600;
            color: #1e293b;
        }
        
        .customer-name {
            color: #475569;
            font-weight: 500;
        }
        
        .candidate-name {
            color: #64748b;
        }
        
        .date-cell {
            font-size: 14px;
            color: #475569;
            white-space: nowrap;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .action-btn:hover {
            background: #e2e8f0;
        }
        
        .action-btn i {
            margin-right: 5px;
            font-size: 12px;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #cbd5e1;
        }
        
        .empty-state p {
            font-size: 16px;
        }

        .file-actions {
            display: flex;
            gap: 10px;
        }
        
        @media (max-width: 1024px) {
            .trainings-table-container {
                overflow-x: auto;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-content {
                padding: 20px;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .dashboard-header {
                padding: 20px;
            }
            
            .dashboard-header h2 {
                font-size: 20px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .trainings-table th,
            .trainings-table td {
                padding: 12px 10px;
                font-size: 14px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-value {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2><i class="fas fa-chalkboard-teacher"></i> Trainer Dashboard</h2>

        
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="upload-btn" style="background:none;border:none;color:#ffffff;cursor:pointer;">
                    Logout
                </button>
            </form>
        </div>
            
            <!-- Statistics Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-title">TOTAL BATCHES</div>
                    <div class="stat-value">{{ $trainings->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">IN PROGRESS</div>
                    <div class="stat-value">{{ $trainings->where('status', 'in_progress')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">COMPLETED</div>
                    <div class="stat-value">{{ $trainings->where('status', 'completed')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">UPCOMING</div>
                    <div class="stat-value">{{ $trainings->where('status', 'scheduled')->count() }}</div>
                </div>
            </div>
            
            @if($trainings && count($trainings) > 0)
            <div class="trainings-table-container">
                <table class="trainings-table">
                    <thead>
                        <tr>
                            <th>Batch</th>
                            <th>Customer</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainings as $training)
                        <tr>
                            <td>
                                <span class="batch-name">{{ $training->batch_name }}</span>
                            </td>
                            <td>
                                <span class="customer-name">{{ $training->customer->name }}</span>
                            </td>
                            <td class="date-cell">
                                <i class="fas fa-calendar-alt"></i> 
                                {{ \Carbon\Carbon::parse($training->start_date)->format('M j, Y') }}
                            </td>
                            <td class="date-cell">
                                <i class="fas fa-calendar-alt"></i> 
                                {{ \Carbon\Carbon::parse($training->end_date)->format('M j, Y') }}
                            </td>
                            <td>
                                <form action="{{ route('training.updateStatus', $training->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" 
                                            class="status-badge {{ $training->status }}">
                                        @php
                                            $statuses = [
                                                'paid' => 'Paid',
                                                'in_training' => 'In Training'
                                            ];
                                        @endphp
                                        @foreach($statuses as $key => $label)
                                            <option value="{{ $key }}" {{ $training->status === $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="file-actions">
                                    <!-- View button -->
                                    <a href="{{ asset('storage/invoice/' . $training->invoice_file) }}" 
                                    class="view-link" 
                                    target="_blank" 
                                    rel="noopener noreferrer">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-chalkboard"></i>
                <p>No training batches assigned yet.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>