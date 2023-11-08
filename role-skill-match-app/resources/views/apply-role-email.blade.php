<!DOCTYPE html>
<html>
<head>
    <title>Apply Role Confirmation</title>
</head>
<body>
    <p>Dear Applicant {{ $staff_name }} (Staff ID: {{ $staff_id }}),</p>

    <p>We are pleased to inform you that your application for the role of {{ $role_name }} ({{ $work_arrangement }}) has been successfully submitted.</p>

    <p>Here are the details of your application:</p>

    <ul>
        <li><strong>Application ID:</strong> {{ $application_id }}</li>
        <li><strong>Role Applied For:</strong> {{ $role_name }}</li>
        <li><strong>Application Date:</strong> {{ $application_apply_date }}</li>
    </ul>

    <p>If you have any questions or need further assistance, please feel free to contact our support team.</p>

    <p>Thank you for considering our organization, and we look forward to reviewing your application.</p>

    <p>Best regards,<br>HR Staff</p>
</body>
</html>
