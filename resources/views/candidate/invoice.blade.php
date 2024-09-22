<h1>Invoice</h1>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Hours Worked</th>
            <th>Earnings</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($timesheets as $timesheet)
            <tr>
                <td>{{ $timesheet->date }}</td>
                <td>{{ $timesheet->hours_worked }}</td>
                <td>{{ $timesheet->daily_earnings }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
