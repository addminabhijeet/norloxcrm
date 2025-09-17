<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .dashboard-header {
            background: linear-gradient(to right, #0ea5e9, #3b82f6);
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
        
        .section-title i {
            margin-right: 10px;
            color: #0ea5e9;
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
            border-left: 4px solid #0ea5e9;
        }
        
        .stat-title {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #0ea5e9;
        }
        
        .payments-table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
        }
        
        .payments-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        .payments-table th {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .payments-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .payments-table tr:last-child td {
            border-bottom: none;
        }
        
        .payments-table tr {
            transition: background-color 0.2s ease;
        }
        
        .payments-table tr:hover {
            background-color: #f8fafc;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            text-transform: capitalize;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .status-completed {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-in_training {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        
        .status-rejected {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .payment-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .payment-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .payment-completed {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .payment-failed {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .amount {
            font-weight: 600;
            color: #0ea5e9;
            margin-top: 4px;
            display: block;
        }
        
        .training-info {
            background-color: #f0f9ff;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: #0c4a6e;
            display: inline-block;
        }
        
        .training-na {
            color: #64748b;
            font-style: italic;
        }
        
        .candidate-name {
            font-weight: 600;
            color: #1e293b;
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
        
        @media (max-width: 1024px) {
            .payments-table-container {
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

        .file-actions {
            display: flex;
            gap: 10px;
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
            
            .payments-table th,
            .payments-table td {
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
            <h2><i class="fas fa-user-tie"></i> Customer Dashboard</h2>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="upload-btn" style="background:none;border:none;color:#ffffff;cursor:pointer;">
                    Logout
                </button>
            </form>
        </div>

        <div class="dashboard-content">

            <!-- Statistics Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-title">TOTAL PAYMENTS</div>
                    <div class="stat-value">${{ number_format($payments->sum('amount'), 2) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">RESUMES PROCESSED</div>
                    <div class="stat-value">{{ $payments->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">IN TRAINING</div>
                    <div class="stat-value">{{ $payments->where('resume.status', 'in_training')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">COMPLETED</div>
                    <div class="stat-value">{{ $payments->where('resume.status', 'completed')->count() }}</div>
                </div>
            </div>

            @if($payments->count() > 0)
            <div class="payments-table-container">
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Training</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            @php
                                $statusClass = match($payment->resume->status) {
                                    'completed' => 'status-completed',
                                    'in_training' => 'status-in_training',
                                    'rejected' => 'status-rejected',
                                    default => 'status-pending',
                                };

                                $paymentStatusClass = match($payment->status) {
                                    'completed' => 'payment-completed',
                                    'failed' => 'payment-failed',
                                    default => 'payment-pending',
                                };
                            @endphp
                            <tr>
                                <td>
                                    <span class="candidate-name">{{ $payment->resume->candidate_name }}</span>                        
                                </td>
                                <td>
                                    <div class="file-actions">
                                    <!-- View button -->
                                    <a href="{{ asset('storage/resumes/' . $payment->resume->resume_file) }}" 
                                    class="view-link" 
                                    target="_blank" 
                                    rel="noopener noreferrer">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">{{ $payment->resume->status }}</span>
                                </td>
                                <td>
                                    <span class="payment-status {{ $paymentStatusClass }}">{{ $payment->status }}</span>
                                    <span class="amount">${{ number_format($payment->amount, 2) }}</span>
                                </td>
                                <td>
                                    @if($payment->resume->status == 'in_training')
                                        <div class="training-info">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $payment->resume->trainings?->first()?->batch_name ?? 'Scheduled' }}
                                        </div>
                                    @else
                                        <span class="training-na">N/A</span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-file-invoice"></i>
                <p>No payment record found.</p>
            </div>
            @endif

        </div>
    </div>
</body>
</html>