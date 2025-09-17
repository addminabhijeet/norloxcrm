<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background: linear-gradient(to right, #7c3aed, #4f46e5);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
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
        
        .upload-btn {
            display: inline-flex;
            align-items: center;
            background: white;
            color: #7c3aed;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .upload-btn i {
            margin-right: 8px;
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
            color: #7c3aed;
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
            border-left: 4px solid #7c3aed;
        }
        
        .stat-title {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #7c3aed;
        }
        
        .users-table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
        }
        
        .users-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        .users-table th {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .users-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .users-table tr:last-child td {
            border-bottom: none;
        }
        
        .users-table tr {
            transition: background-color 0.2s ease;
        }
        
        .users-table tr:hover {
            background-color: #f8fafc;
        }
        
        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            text-transform: capitalize;
        }
        
        .role-junior {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        
        .role-senior {
            background-color: #ede9fe;
            color: #7c3aed;
        }
        
        .role-customer {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .role-accountant {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .role-trainer {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .role-admin {
            background-color: #f3e8ff;
            color: #9333ea;
        }
        
        .date-cell {
            font-size: 13px;
            color: #64748b;
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
            .users-table-container {
                overflow-x: auto;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .upload-btn {
                margin-top: 15px;
            }
            
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
            
            .users-table th,
            .users-table td {
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
            <h2><i class="fas fa-user-shield"></i> Admin Dashboard</h2>
             
            
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="upload-btn" style="background:none;border:none;color:#ffffff;cursor:pointer;">
                        Logout
                    </button>
                </form>

                <a href="{{ route('dashboard') }}" 
                    class="calendar-btn"
                    style="margin-right: 15px; padding: 6px 12px; background-color: #4f46e5; color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.9em;">
                        <i class="fas fa-calendar-alt"></i> Dashboard
                </a>
            </div>

        @if($logins && count($logins) > 0)
        <div class="users-table-container">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Logged In At</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logins as $login)
                    <tr>
                        <td>{{ $login->id }}</td>
                        <td>{{ $login->user ? $login->user->name : 'Unknown' }} (ID: {{ $login->user_id }})</td>
                        <td>{{ $login->ip_address }}</td>
                        <td style="max-width: 300px; word-wrap: break-word;">
                            {{ Str::limit($login->user_agent, 80) }}
                        </td>
                        <td class="date-cell">{{ \Carbon\Carbon::parse($login->logged_in_at)->format('M j, Y g:i A') }}</td>
                        <td class="date-cell">{{ \Carbon\Carbon::parse($login->created_at)->format('M j, Y g:i A') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-sign-out-alt"></i>
            <p>No login records found.</p>
        </div>
        @endif

    </div>
</body>
</html>