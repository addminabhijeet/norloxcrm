<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junior Dashboard</title>
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
            background: linear-gradient(to right, #6366f1, #4f46e5);
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
            color: #4f46e5;
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
            border-left: 4px solid #6366f1;
        }
        
        .stat-title {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #6366f1;
        }
        
        .resumes-table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
        }
        
        .resumes-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        .resumes-table th {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .resumes-table td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .resumes-table tr:last-child td {
            border-bottom: none;
        }
        
        .resumes-table tr {
            transition: background-color 0.2s ease;
        }
        
        .resumes-table tr:hover {
            background-color: #f8fafc;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .status-reviewed {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .status-completed {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-rejected {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .download-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: color 0.2s ease;
        }
        
        .download-link:hover {
            color: #7c3aed;
        }
        
        .download-link i {
            margin-right: 6px;
            font-size: 14px;
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

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #6366f1;
        }

        
        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .upload-btn {
                margin-top: 15px;
            }
            
            .resumes-table {
                display: block;
                overflow-x: auto;
            }
            
            .dashboard-content {
                padding: 20px;
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
            
            .resumes-table th,
            .resumes-table td {
                padding: 12px 10px;
            }
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #2c3e50;
            color: #fff;
        }

        .user-info {
            margin-right: 15px;
            font-size: 0.9em;
        }

        .user-info span {
            margin: 0 5px;
        }

    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>
                <i class="fas fa-user-tie"></i> Junior Dashboard
            </h2>

            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name }}</span> |
                <span class="user-email">{{ Auth::user()->email }}</span>
            </div>

            <!-- Calendar Button -->
            <a href="{{ route('calendar.index') }}" 
            class="calendar-btn"
            style="margin-right: 15px; padding: 6px 12px; background-color: #4f46e5; color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.9em;">
                <i class="fas fa-calendar-alt"></i> Calendar
            </a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:none; border:none; color:#ffffff; cursor:pointer; font-size:inherit;">
                    Logout
                </button>
            </form>
        </div>



            <!-- Statistics Cards -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-title">TOTAL ASSIGNED</div>
                    <div class="stat-value">{{ $resumes->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">PENDING REVIEW</div>
                    <div class="stat-value">{{ $resumes->where('status', 'pending')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">IN REVIEW</div>
                    <div class="stat-value">{{ $resumes->where('status', 'in_review')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">COMPLETED</div>
                    <div class="stat-value">{{ $resumes->where('status', 'completed')->count() }}</div>
                </div>
            </div>

       
            @if($resumes && count($resumes) > 0)
            <div class="resumes-table-container">
                <table class="resumes-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Candidate</th>
                        <th>Status</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resumes as $resume)
                    <tr>
                        <td>{{ $resume->id }}</td>
                        <td>{{ $resume->candidate_name }}</td>
                        <td>
                            <form action="{{ route('resumes.updateStatus', $resume->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="status-badge {{ $resume->status }}">
                                    @php
                                        $statuses = [
                                            'pending_review' => 'Pending Review',
                                            'forwarded_to_senior' => 'Forwarded to Senior',
                                            'customer_confirmation' => 'Customer Confirmation',
                                        ];
                                    @endphp
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ $resume->status === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            <div class="file-actions">
                                <!-- Download button -->
                                    <a href="{{ asset('storage/resumes/' . $resume->resume_file) }}" 
                                    class="download-link" 
                                    download="{{ $resume->candidate_name }}_resume.pdf" 
                                    rel="noopener noreferrer">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                <!-- View button -->
                                <a href="{{ asset('storage/resumes/' . $resume->resume_file) }}" 
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
            @else
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <p>You haven't uploaded any resumes yet.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>