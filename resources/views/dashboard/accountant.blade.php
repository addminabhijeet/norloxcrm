<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant Dashboard</title>
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
            background: linear-gradient(to right, #059669, #10b981);
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
            color: #059669;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #059669;
        }
        
        .stat-title {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #059669;
        }
        
        .payments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
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
        }
        
        .status-completed {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .status-failed {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .amount {
            font-weight: 600;
            color: #059669;
        }
        
        .transaction-id {
            font-family: monospace;
            background-color: #f1f5f9;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
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
            .payments-table {
                display: block;
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
            <h2><i class="fas fa-calculator"></i> Accountant Dashboard</h2>

        
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
                    <div class="stat-title">TOTAL PAYMENTS</div>
                    <div class="stat-value">${{ number_format($payments->sum('amount'), 2) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">COMPLETED PAYMENTS</div>
                    <div class="stat-value">{{ $payments->where('status', 'completed')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">PENDING PAYMENTS</div>
                    <div class="stat-value">{{ $payments->where('status', 'pending')->count() }}</div>
                </div>
            </div>
            
            @if($payments && count($payments) > 0)
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Candidate</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Transaction ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->customer->name }}</td>
                        <td class="amount">${{ number_format($payment->amount, 2) }}</td>
                        <td>
                            <form action="{{ route('payment.updateStatus', $payment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="status-badge {{ $payment->status }}">
                                    @php
                                        $statuses = [
                                            'customer_confirmation' => 'Customer Confirmation',
                                            'paid' => 'Paid'
                                        ];
                                    @endphp
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ $payment->status === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            <span class="transaction-id">{{ $payment->transaction_id ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fas fa-receipt"></i>
                <p>No payment records found.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>