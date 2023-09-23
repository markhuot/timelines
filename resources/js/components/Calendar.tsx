export function Calendar({ centerOnString }: { centerOnString: string })
{
    const centerOn = new Date(centerOnString);
    const from = new Date(centerOn.getTime())
    from.setDate(centerOn.getDate() - 1);
    const to = new Date(centerOn.getTime())
    to.setDate(centerOn.getDate() + 1);
    const days = [from, centerOn, to];

    return <div>
        {days.map(date => (
            <ul className="min-h-screen" key={date.getTime()}>
                {[...Array(24).keys()].map(hour => (
                    <li data-date={`${date.getFullYear()}-${date.getMonth()}-${date.getDate()}T${hour}:00:00`} key={`${date.getTime()}${hour}`}>
                        {hour}
                    </li>
                ))}
            </ul>
        ))}
    </div>;
}
