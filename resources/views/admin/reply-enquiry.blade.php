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
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .main {
            margin-left: 14rem;
            padding: 2rem;
        }

        .reply-container {
            max-width: 800px;
            margin: 0 auto;
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
            padding: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        .card-body {
            padding: 2rem;
        }

        .enquiry-details {
            background-color: white;
            border-radius: 0.35rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .detail-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .detail-value {
            color: var(--text-color);
        }

        .message-content {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.25rem;
            margin-top: 0.5rem;
            white-space: pre-wrap;
        }

        .reply-form textarea {
            width: 100%;
            min-height: 200px;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.35rem;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s;
            margin-bottom: 1.5rem;
        }

        .reply-form textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.625rem 1.25rem;
            font-size: 0.95rem;
            line-height: 1.5;
            border-radius: 0.35rem;
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .btn-primary {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            transform: translateY(-1px);
        }

        .btn-block {
            display: block;
            width: 100%;
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
        
        <div class="reply-container">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-reply mr-2"></i> Reply to Enquiry
                </div>
                
                <div class="card-body">
                    <div class="enquiry-details">
                        <div class="detail-item">
                            <span class="detail-label">Name</span>
                            <div class="detail-value">{{ $enquiry->name }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <div class="detail-value">{{ $enquiry->email }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Phone</span>
                            <div class="detail-value">{{ $enquiry->phone }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <span class="detail-label">Message</span>
                            <div class="message-content">{{ $enquiry->message }}</div>
                        </div>
                    </div>

                    <form class="reply-form" action="{{ route('admin.enquiries.sendReply', $enquiry->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="response" class="detail-label">Your Response</label>
                            <textarea id="response" name="response" required placeholder="Type your response here..." class="form-control"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-paper-plane mr-2"></i> Send Response
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>