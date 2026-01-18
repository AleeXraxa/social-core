<?php 
include '../config/db.php';
include '../auth/auth.check.php';
include '../includes/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Friends</title>

    <style>
        

        body {
            background: #f5f7fb;
        
        }

        .friends-container {
            margin: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .friends-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .friends-section h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #1f2937;
        }

        .friend-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9fafb;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: 0.2s ease;
        }

        .friend-card:hover {
            background: #f3f4f6;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .info {
            flex: 1;
            margin-left: 12px;
        }

        .name {
            display: block;
            font-weight: 600;
            color: #111827;
        }

        .meta {
            font-size: 12px;
            color: #6b7280;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 7px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .accept {
            background: #22c55e;
            color: #fff;
        }

        .reject {
            background: #ef4444;
            color: #fff;
        }

        .secondary {
            background: #e5e7eb;
            color: #111827;
        }

        @media (max-width: 900px) {
            .friends-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="friends-container">

    <!-- Friend Requests -->
    <div class="friends-section">
        <h2>Friend Requests</h2>

        <div class="friend-card">
            <div class="avatar">A</div>
            <div class="info">
                <span class="name">Ali Raza</span>
                <span class="meta">Wants to connect</span>
            </div>
            <div class="actions">
                <button class="btn accept">Accept</button>
                <button class="btn reject">Reject</button>
            </div>
        </div>

        <div class="friend-card">
            <div class="avatar">S</div>
            <div class="info">
                <span class="name">Sara Khan</span>
                <span class="meta">Sent you a request</span>
            </div>
            <div class="actions">
                <button class="btn accept">Accept</button>
                <button class="btn reject">Reject</button>
            </div>
        </div>
    </div>

    <!-- Added Friends -->
    <div class="friends-section">
        <h2>Added Friends</h2>

        <div class="friend-card">
            <div class="avatar">A</div>
            <div class="info">
                <span class="name">Ahmed Ali</span>
                <span class="meta">Friends since Jan 2026</span>
            </div>
            <button class="btn secondary">Message</button>
        </div>

        <div class="friend-card">
            <div class="avatar">Z</div>
            <div class="info">
                <span class="name">Zain Malik</span>
                <span class="meta">Friends</span>
            </div>
            <button class="btn secondary">Message</button>
        </div>
    </div>

</div>

</body>
</html>
