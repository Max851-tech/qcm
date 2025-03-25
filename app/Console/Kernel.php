<?php

protected function schedule(Schedule $schedule)
{
$schedule->command('backup:database')->dailyAt('02:00');
}
