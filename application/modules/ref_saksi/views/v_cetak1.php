<center><table frame="box" border="1" width="500">
    <thead>
        <tr>
            <th><img src="<?= site_url('assets_users/img/gerindra.jpeg')?>" width="100px" height="100px"></th>
            <th>TANDA PENGENAL SAKSI</th>
            <th width="120"><img src="<?= site_url('assets_users/img/pkb.png')?>" width="100px" height="100px"></th>
        </tr>
        <tr>
            <th colspan="3">LUKMAN EDY - HARDIANTO</th>
        </tr>
        <tr>
        <th colspan="3">RIAU BANGKIT DATABASE CENTER (RBDC)</th>
        </tr>
        <tr height="20" class="bordered">
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nama: </td>
            <td colspan="2"><?=$nama?></td>
        </tr>
        <tr>
            <td>No KTP: </td>
            <td colspan="2"><?=$no_ktp?></td>
        </tr>
        <tr>
            <td>Alamat: </td>
            <td colspan="2"><?=$alamat?></td>
        </tr>
        <tr>
            <td>Profil: </td>
            <td colspan="2"><?=$profil?></td>
        </tr>
        <tr>
            <td>NO TPS: </td>
            <td colspan="2"><?=$no_tps?></td>
        </tr>
        <tr style="height:150;">
            <td></td>
            <td><center>Tempelkan Foto Anda</center></td>
            <td></td>
        </tr>
        <tr>
            <td><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$barcode?>.'&choe=UTF-8" width="100px" height="100px"></td>
            <td valign="bottom"><center>TTD SAKSI</center>
            <center>(<?=$nama?>)</center></td>
            <td valign="bottom"><center>VERIFIKASI</td>
        </tr>
    </tbody>
</table></center>
