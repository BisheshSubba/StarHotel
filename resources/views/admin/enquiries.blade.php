<!doctype html>
<html lang="en">
    <head>
        @include('admin.head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #4e73df;
                --secondary-color: #f8f9fc;
                --accent-color: #2e59d9;
                --text-color: #5a5c69;
                --light-gray: #f8f9fc;
                --border-color: #e3e6f0;
                --success-color: #1cc88a;
                --warning-color: #f6c23e;
                --danger-color: #e74a3b;
            }

            body {
                background-color: var(--light-gray);
                color: var(--text-color);
                font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            }

            .main {
                margin-left: 14rem;
                padding: 2rem;
                transition: all 0.3s;
            }

            h2 {
                color: var(--primary-color);
                margin-bottom: 1.5rem;
                font-weight: 600;
                border-bottom: 2px solid var(--border-color);
                padding-bottom: 0.5rem;
            }

            .card {
                border: none;
                border-radius: 0.35rem;
                box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
                margin-bottom: 2rem;
            }

            .card-header {
                background-color: #f8f9fc;
                border-bottom: 1px solid var(--border-color);
                padding: 1rem 1.35rem;
                font-weight: 600;
                color: var(--primary-color);
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 1rem;
                background-color: white;
            }

            th {
                background-color: var(--primary-color);
                color: white;
                padding: 1rem;
                text-align: left;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.5px;
            }

            td {
                padding: 1rem;
                border-bottom: 1px solid var(--border-color);
                vertical-align: middle;
            }

            tr:hover {
                background-color: rgba(78, 115, 223, 0.05);
            }

            .badge {
                display: inline-block;
                padding: 0.35em 0.65em;
                font-size: 0.75em;
                font-weight: 700;
                line-height: 1;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0.25rem;
            }

            .badge-warning {
                color: #1f2d3d;
                background-color: var(--warning-color);
            }

            .badge-success {
                color: white;
                background-color: var(--success-color);
            }

            .btn {
                display: inline-block;
                font-weight: 400;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                user-select: none;
                border: 1px solid transparent;
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
                line-height: 1.5;
                border-radius: 0.35rem;
                transition: all 0.15s ease;
            }

            .btn-primary {
                color: #fff;
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .btn-primary:hover {
                background-color: var(--accent-color);
                border-color: var(--accent-color);
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }

            .action-cell {
                white-space: nowrap;
            }

            .message-cell {
                max-width: 250px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .empty-state {
                text-align: center;
                padding: 3rem;
                color: var(--text-color);
            }

            .empty-state i {
                font-size: 3rem;
                color: var(--border-color);
                margin-bottom: 1rem;
            }

            @media (max-width: 768px) {
                .main {
                    margin-left: 0;
                    padding: 1rem;
                }
            }
        </style>
    </head>

    <body class="bg-light">
        @include('admin.navbar')
        <div class="main">
            @include('admin.sidebar')
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Enquiry Management</h5>
                        <div>
                            <span class="badge badge-warning">
                                Total Enquiries: {{ $enquiries->count() }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($enquiries->isEmpty())
                        <div class="empty-state">
                            <i class="far fa-envelope-open"></i>
                            <h3>No Enquiries Found</h3>
                            <p>There are no enquiries to display at this time.</p>
                        </div>
                    @else
                        <div class="table-container">
                            <table class="table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>People</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enquiries as $enquiry)
                                    <tr>
                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->phone }}</td>
                                        <td>{{ $enquiry->checkin_date ? \Carbon\Carbon::parse($enquiry->checkin_date)->format('M d, Y') : 'N/A' }}</td>
                                        <td>{{ $enquiry->checkout_date ? \Carbon\Carbon::parse($enquiry->checkout_date)->format('M d, Y') : 'N/A' }}</td>
                                        <td>{{ $enquiry->total_people }}</td>
                                        <td class="message-cell" title="{{ $enquiry->message ?? 'No message' }}">
                                            {{ $enquiry->message ? Str::limit($enquiry->message, 30) : 'N/A' }}
                                        </td>
                                        <td>
                                            @if($enquiry->response)
                                                <span class="badge badge-success">Replied</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td class="action-cell">
                                            @if(!$enquiry->response)
                                                <a href="{{ route('admin.enquiries.reply', $enquiry->id) }}" 
                                                   class="btn btn-primary btn-sm"
                                                   title="Reply to enquiry">
                                                    <i class="fas fa-reply"></i> Reply
                                                </a>
                                            @else
                                                <button class="btn btn-sm" disabled style="background-color: #e2e6ea;">
                                                    <i class="fas fa-check"></i> Replied
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @include('admin.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const messageCells = document.querySelectorAll('.message-cell');
                messageCells.forEach(cell => {
                    if (cell.offsetWidth < cell.scrollWidth) {
                        cell.setAttribute('data-bs-toggle', 'tooltip');
                        new bootstrap.Tooltip(cell);
                    }
                });
            });
        </script>
    </body>
</html>