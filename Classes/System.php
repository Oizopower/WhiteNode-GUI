<?php
Class System extends Whitenode
{
    static public function getCpuTemp()
    {
        $rawCpuTemp = file_get_contents("/sys/class/thermal/thermal_zone0/temp");

        $cpuTemp1 = ($rawCpuTemp / 1000);
        $cpuTemp2 = ($rawCpuTemp / 100);
        $cpuTempM = (($cpuTemp2 % $cpuTemp1));

        return round($cpuTemp1) . "&deg;C";
    }

    static public function getGpuTemp()
    {
        $rawGpuTemp = file_get_contents("/opt/vc/bin/vcgencmd measure_temp");

        return $rawGpuTemp;
    }

    static public function getLoad()
    {
        $load = sys_getloadavg();
        return $load[0];
    }

    static public function getMemory()
    {
        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2]/$mem[1]*100;

        return $memory_usage;
    }

    static public function getUptime()
    {
        $text = array(
            "days" => "days",
            "hours" => "hours",
            "minutes" => "minutes"
        );

        $fd = fopen('/proc/uptime', 'r');
        $ar_buf = split(' ', fgets($fd, 4096));
        fclose($fd);

        $sys_ticks = trim($ar_buf[0]);

        $min = $sys_ticks / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));

        if ($days != 0) {
            $result = "$days " . $text['days'] . " ";
        }

        if ($hours != 0) {
            $result .= "$hours " . $text['hours'] . " ";
        }
        $result .= "$min " . $text['minutes'];

        return $result;
    }
    static public function getDiskUsage()
    {
        $df=disk_free_space("/");
        $dt=disk_total_space("/");
        $du=$dt - $df;
        $dp=sprintf('%.2f',($du / $dt) * 100);
        $df=Whitenode::humanSize($df);
        $du=Whitenode::humanSize($du);
        $dt=Whitenode::humanSize($dt);

        return array(
            'percentage' => $dp,
            'free' => $df,
            'message' => "NOTICE: Your disk is nearing capacity, it is currently ".$dp."% full, with ".$df." free space remaining"
        );
    }
}
