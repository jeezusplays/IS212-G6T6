<!DOCTYPE html>
<html>
<head>
    <title>Role Listing Withdrawn Confirmation</title>
</head>
<body>
    <p>Dear Applicant {{ $staff_name }} (Staff ID: {{ $staff_id }}),</p>

    <p>We wanted to inform you that your recent application for the role of {{ $role_name }} ({{ $work_arrangement }}) has been successfully withdrawn.</p>

    <p>Here are the details of your withdrawn application:</p>

    <ul>
        <li><strong>Application ID:</strong> {{ $application_id }}</li>
        <li><strong>Role Withdrawn From:</strong> {{ $role_name }}</li>
        <li><strong>Withdrawn Date:</strong> {{ $application_withdraw_date }}</li>
    </ul>

    <p>If you have any questions or need further assistance, please feel free to contact our support team.</p>

    <p>Thank you for considering our organization, and we hope to see you apply for future opportunities.</p>

    <p>Best regards,<br>HR Staff</p>
</body>
</html>
