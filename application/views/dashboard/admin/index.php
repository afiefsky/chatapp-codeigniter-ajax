<h2>Daftar User</h2>

<br /><br />

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Username</td>
        <th>Email</td>
        <th>Nama Depan</td>
        <th>Nama Belakang</td>
        <th>Divisi</td>
        <th>Status Keaktifan</td>
        <th>Aksi</td>
    </tr>
    <?php
    $no = 0;
    $aktif_status = '';
    $button_activate = '';
    foreach ($record->result() as $r) {
        if ($r->is_activated == 1) {
            $aktif_status = 'Aktif';
            $button_activate = '';
        } else {
            $aktif_status = 'Belum Aktif';
            $button_activate = anchor('user/activate/'.$r->id, 'Aktifkan!', ['class' => 'btn btn-success btn-sm']);
        }
        $no++;
        echo "<tr>
            <td>$no</td>
            <td>$r->username</td>
            <td>$r->email</td>
            <td>$r->first_name</td>
            <td>$r->last_name</td>
            <td>$r->division</td>
            <td>$aktif_status</td>
            <td>".
                $button_activate
            ."</td>
        </tr>";
    }
    ?>
</table>