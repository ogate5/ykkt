<?php
	
	function exec2($s) {exec('sudo sh -c "'.$s.'"');}
	function isRP() {exec("uname -n", $u);return $u[0]=="raspberrypi";}

	function binarySearch($target, &$arr)
	{
		$low = 0;
		$high = count($arr) - 1;
		while ($low <= $high)
		{
			$mid = ($low + $high) >> 1;
			if ($arr[$mid] == $target) return $mid;
			if ($arr[$mid] > $target) $high = $mid - 1; else
			if ($arr[$mid] < $target) $low = $mid + 1;
		}
		return -1;
	}

	function main()
	{
		error_reporting(0);
		header("Content-type:text/html;charset=UTF-8");
		$p = $_REQUEST["p"];
		$v = $_REQUEST["v"];
		if ($p < 4)
		{	// picker 1:refresh 2:save
			$f = $p==0 ? "/home/pi/nginx/maclog.txt" : ($p < 3 ? "/usr/share/fruitywifi/conf/ssid.conf" : "/usr/share/fruitywifi/logs/mdk3.log");
			if ($p == 2) exec2("echo '$v' > $f");
			echo file_get_contents($f);
		} else
		if ($p >3 and $p < 8)
		{	// 4,5:wlan info  6,7:mac select
			include "../config/config.php";
			include "ap/_info_.php";
			exec("ifconfig -a", $r);
			$n = count($r);
			$t = "";
			$b = 0;
			$wlan_ap = "";
			$wlan_mon = "";
			$sSel = "";
			$LTD = array(0x001092,"磊科",0x005a39,"迅捷",0x048d38,"磊科",0x0cd86c,"迅捷",0x1c60de,"水星",0x20f41b,"必联",0x24050f,"MTN",0x28f366,"必联",0x3c3300,"必联",0x44334c,"必联",0x44975a,"迅捷",0x488ad2,"水星",0x502b73,"腾达",0x503aa0,"水星",0x508965,"水星",0x60ee5c,"迅捷",0x640dce,"水星",0x6c5940,"水星",0x704e66,"迅捷",0x7054d2,"和硕",0x74c330,"迅捷",0x78eb14,"迅捷",0x8cf228,"水星",0xaca213,"必联",0xbc5ff6,"水星",0xc83a35,"腾达",0xc8e7d8,"水星",0xd02516,"水星",0xd0fa1d,"360",0xd455be,"迅捷",0xd48304,"迅捷",0xe0b94d,"必联",0xe4beed,"磊科",0xe4f3f5,"水星",0xe84e06,"EDUP",0xf46a92,"迅捷",0xf4ee14,"水星",0xb827eb,"树莓",0xdca632,"树莓");
			for ($i=0; $i<$n; ++$i)
			{
				$s = $r[$i]	;
				if ($s[0] == "w")
				{
					$wlan = substr($s, 0, 5);
					$j = strlen($s);
					if ($s[$j-3] == ":")
						$mac = substr($s, $j-17, 17);
					else
						while (++$i < $n)
						{	// stretch
							$s = $r[$i];
							$j = stripos($s, "ether ");
							if ($j > 0) {$mac = substr($s, $j+6, 17);break;}
						}
					$line = $wlan." ".$mac;
					$m = hexdec($mac[0].$mac[1].$mac[3].$mac[4].$mac[6].$mac[7]);
					//if ($p > 5 and $m == 0xb827eb) continue;
					if ($mod_scatter_bssid != "")
					{
						if ($mod_scatter_bssid == $mac) $b = 1;
						if ($mac == $mod_scatter_bssid and $wlan != $io_in_iface) $wlan_ap = $wlan; else
						if ($mac != $mod_scatter_bssid and $m != 0xb827eb and $m != 0xdca632 and $wlan != $io_in_iface_extra) $wlan_mon = $wlan;
					}
					for ($j=count($LTD)-2; $j>=0; $j-=2)
					if ($m == $LTD[$j])
					{
						$s = $LTD[$j+1];
						$line .= " ".$s;
						break;
					}
					if ($j < 0)
					{
						$TPLINK = array(0x000aeb,0x001478,0x0019e0,0x001d0f,0x002127,0x0023cd,0x002586,0x002719,0x081f71,0x085700,0x0c722c,0x0c8268,0x10feed,0x147590,0x148692,0x14cc20,0x14cf92,0x14e6e4,0x18a6f7,0x18d6c7,0x1c4419,0x1cfa68,0x20dce6,0x246968,0x282cb2,0x28ee52,0x30b49e,0x30b5c2,0x30fc68,0x388345,0x3c46d8,0x40169f,0x403f8c,0x44b32d,0x50bd5f,0x50c7bf,0x50fa84,0x54c80f,0x54e6fc,0x5c63bf,0x5c899a,0x60e327,0x645601,0x6466b3,0x647002,0x6ce873,0x74ea3a,0x78a106,0x808917,0x8416f9,0x882593,0x8c210a,0x8ca6df,0x90ae1b,0x90f652,0x940c6d,0x98ded0,0x9c216a,0xa0f3c1,0xa42bb0,0xa8154d,0xa8574e,0xb0487a,0xb0958e,0xbc4699,0xbcd177,0xc025e9,0xc04a00,0xc06118,0xc0e42d,0xc46e1f,0xc4e984,0xcc3429,0xd0c7c0,0xd4016d,0xd46e0e,0xd8150d,0xd85d4c,0xdc0077,0xe005c5,0xe4d332,0xe894f6,0xe8de27,0xec086b,0xec172f,0xec26ca,0xec888f,0xf0f336,0xf483cd,0xf4ec38,0xf4f26d,0xf81a67,0xf8d111,0xfcd733);
						$NETGEAR = array(0x00095b,0x000fb5,0x00146c,0x00184d,0x001b2f,0x001e2a,0x001f33,0x00223f,0x0024b2,0x0026f2,0x008ef2,0x04a151,0x08bd43,0x100d7f,0x10da43,0x200cc8,0x204e7f,0x20e52a,0x28c68e,0x2c3033,0x2cb05d,0x30469a,0x405d82,0x4494fc,0x4c60de,0x504a6e,0x506a03,0x6cb0ce,0x744401,0x803773,0x841b5e,0x9c3dcf,0x9cd36d,0xa00460,0xa021b7,0xa06391,0xa42b8c,0xb07fb9,0xb0b98a,0xc03f0e,0xc0ffd4,0xc40415,0xc43dc7,0xdcef09,0xe0469a,0xe091f5,0xe4f4c6,0xe8fcaf,0xf87394);
						$DLINK = array(0x00055d,0x000d88,0x000f3d,0x001195,0x001346,0x0015e9,0x00179a,0x00195b,0x001b11,0x001cf0,0x001e58,0x002191,0x0022b0,0x002401,0x00265a,0x0050ba,0x0080c8,0x1062eb,0x10bef5,0x14d64d,0x1c5f2b,0x1c7ee5,0x1caff7,0x1cbdb9,0x28107b,0x340804,0x3c1e04,0x48ee0c,0x54b80a,0x5cd998,0x6c198f,0x6c7220,0x7062b8,0x78542e,0x84c9b2,0x908d78,0x9094e4,0x9cd643,0xa0ab1b,0xacf1df,0xb0c554,0xb8a386,0xbcf685,0xc0a0bb,0xc412f5,0xc4a81d,0xc8be19,0xc8d3a3,0xccb255,0xd8fee3,0xe46f13,0xe8cc18,0xec2280,0xf07d68,0xf8e903,0xfc7516);
						if (binarySearch($m, $TPLINK) >= 0) $line .= " 普联"; else
						if (binarySearch($m, $NETGEAR) >= 0) $line .= " 网件"; else
						if (binarySearch($m, $DLINK) >= 0) $line .= " 友讯"; else $line .= " 未知";
					}
					if ($wlan == $io_in_iface) $line .= " (AP)";
					if ($wlan == $io_in_iface_extra) $line .= " (mon)";
					$sSel .= $line."\n";
					$t .= $line."\n";
				}
			}
			if ($p > 5) echo $t; else
			if ($p == 4)
			{
				echo $t."\n";
				if ($b) echo ($wlan_ap != "" or $wlan_mon != "") ? "wlan settings need to be adjusted, please press OK to adjust!" : "The wlan order is correct!";// else echo "\"AP-Worker-Rogue BSSID\"Should be set to the MAC of the NIC of the AP!";
			} else
			if ($b)
			{	
				$s = "";
				if ($wlan_ap != "") $s = "io_in_iface=".$wlan_ap;
				if ($wlan_mon != "") $s .= "&io_in_iface_extra=".$wlan_mon."&iface=wifi_extra";
				echo $s != "" ? "/scripts/config_iface.php?".$s : "";
			}
		} else
		if ($p == 100) exec2("systemctl stop nginx;sync;sync;reboot"); else
		if ($p == 101) exec2("systemctl stop nginx;sync;sync;poweroff"); else
		if ($p == 102) exec2("chmod 666 /home/pi/nginx/logs/*.log;>/home/pi/nginx/logs/access.log;>/home/pi/nginx/logs/error.log;sync"); else
		if ($p == 99)
		{
			if (!isRP()) echo "不是树莓！"; else
			if (exec("grep 'brcmfmac' /etc/modprobe.d/raspi-blacklist.conf") == "")
			{
				exec2("echo 'blacklist brcmfmac\nblacklist brcmutil' >> /etc/modprobe.d/raspi-blacklist.conf");
				if (exec("grep 'btbcm' /etc/modprobe.d/raspi-blacklist.conf") == "") exec2("echo 'blacklist btbcm\nblacklist hci_uart' >> /etc/modprobe.d/raspi-blacklist.conf");
				echo "已屏蔽板载无线网卡和蓝牙！重启后生效。";
			} else
			{
				exec2("sed -i '/blacklist brcmfmac\|blacklist brcmutil/d' /etc/modprobe.d/raspi-blacklist.conf");
				echo "板载无线网卡已解除屏蔽！重启后生效。";
			}
		} else
		if ($p == 98 || $p == 97)
		{
			if ($p == 98) exec("sudo date -s '$v'".(isRP() ? "" : "\nsudo hwclock -w"));
			$r = explode(" ", exec("date -R"));
			$n = array_search($r[2], array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")) + 1;
			echo "时间已设为 ".$r[3].'-'.($n > 9 ? $n : '0'.$n).'-'.$r[1].' '.$r[4];
		} else
		if ($p == 96)
		{
			exec(isRP() ? "vcgencmd measure_temp" : "sensors", $r);
			echo implode("\n", $r);
		} else
				// DOI NOI DUNG //
		if ($p == 9696)
		{
			exec2("sed -E -i 's/(index index)(...|).html;/index index-cn.html;/g' ~pi/nginx/conf/nginx.conf"); 
			exec2("sed -E -i 's/=200.*/=200 \/index-cn.html;/g' /home/pi/nginx/conf/nginx.conf");
			exec2("sudo service nginx restart");
		} else
		if ($p == 9697)
		{
			exec2("sed -E -i 's/(index index)(...|).html;/index index-vi.html;/g' ~pi/nginx/conf/nginx.conf");
			exec2("sed -E -i 's/=200.*/=200 \/index-vi.html;/g' /home/pi/nginx/conf/nginx.conf");
			exec2("sudo service nginx restart");
		} else
		if ($p == 9698)
		{
			exec2("sed -E -i 's/(index index)(...|).html;/index index-en.html;/g' ~pi/nginx/conf/nginx.conf");
			exec2("sed -E -i 's/=200.*/=200 \/index-en.html;/g' /home/pi/nginx/conf/nginx.conf");
			exec2("sudo service nginx restart");
		} else
		if ($p == 9699)
		{
			exec2("sed -E -i 's/(index index)(...|).html;/index index.html;/g' ~pi/nginx/conf/nginx.conf"); 
			exec2("sed -E -i 's/=200.*/=200 \/index.html;/g' /home/pi/nginx/conf/nginx.conf");
			exec2("sudo service nginx restart");
		} else

		// END DOI NOI DUNG //
		// CAI DAT LAI //
		
		if ($p == 9800)
		{
			exec2("sudo rm -r /usr/share/fruitywifi");
			exec2("sudo cp -a -r /usr/share/fruitywifi_backup /usr/share/fruitywifi");
		} else
		// END CAI DAT LAI //

		if ($p == 95)
		{
			if (!isRP())
				echo "不是树莓！";
			else
			{
				if (is_dir("/home/pi/ar9271"))
				{
					$n = filesize("/lib/firmware/htc_9271.fw");
					$n1 =  filesize("/home/pi/ar9271/1/htc_9271.fw");
					$n2 =  filesize("/home/pi/ar9271/2/htc_9271.fw");
					if ($n == $n1 || $n == $n2)
					{
						if ($n==$n1 ? $v==1 : $v==2)
							echo "无须切换！";
						else
						{
							$cp = "cp /home/pi/ar9271/".($n==$n1 ? "2" : "1");
							exec("uname -r", $u);	// 4.4.50-v7+
							exec2($cp."/*.fw /lib/firmware;".$cp."/*.ko /lib/modules/".$u[0]."/kernel/drivers/net/wireless/ath/ath9k");
							echo "已切换，请重启！";
						}
						return;
					}
				} 
				echo "不可用！";
			}
		}
	}
	main();
?>
