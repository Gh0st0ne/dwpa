<?
define('AIRCRACK', 'aircrack-ng');
define('WPACLEAN', '/var/www/dev/wpa/wpaclean');
define('WPA_CAP', '/var/www/dev/wpa/wpa.cap');

//Execute aircrack-ng and check for solved net
function check_pass($bssid, $pass) {
    $wl = '/tmp/wl';
    $kf = '/tmp/key';

    if (strlen($pass) < 8)
        return false;

    @unlink($kf);
    file_put_contents($wl, $pass."\n");

    $x = AIRCRACK." -b $bssid -w $wl -l $kf ".WPA_CAP;
    exec($x);

    $p = @file_get_contents($kf);

    return ($p == $pass);
}
?>
