<!DOCTYPE html>
<html>

<head>
    <title>Task Completed</title>
</head>

<body>
    <p>Dear Admin,</p>
    <p>The following task has been marked as completed:</p>
    <p><strong>Title:</strong> {{ $task->name }}</p>
    <p><strong>Description:</strong> {{ $task->description ?? 'No description provided' }}</p>
    <p><strong>Completed by:</strong> {{ $task->user->name }}</p>
</body>

</html>
