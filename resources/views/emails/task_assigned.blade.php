<!DOCTYPE html>
<html>

<head>
    <title>New Task Assigned</title>
</head>

<body>
    <p>Dear {{ $task->user->name }},</p>
    <p>A new task has been assigned to you:</p>
    <p><strong>Title:</strong> {{ $task->name }}</p>
    <p><strong>Description:</strong> {{ $task->description ?? 'No description provided' }}</p>
    <p>Please log in to the dashboard for more details.</p>
</body>

</html>
