<?php
echo form_open('magazine');
?>
<table class="table table-bordered">
    <tr>
        <td width="92%"><input type="text" name="messages" class="form-control" placeholder="Apa yang anda pikirkan?"></td>
        <td width="8%"><input type="submit" name="submit" value="Broadcast!" class="btn btn-primary btn-sm" /></td>
    </tr>
</table>
<table class="table table-bordered table-condensed table-hover table-responsive">
    <tr bgcolor="silver">
        <th colspan="3"><center />Sticky Notes</th>
    </tr>
    <tr>
        <th><center />Tanggal</th>
        <th><center />Nama</th>
        <th><center />Pesan</th>
    </tr>
    <?php
    foreach ($record->result() AS $r) {
        echo "<tr>
            <td width='13%' align='center'>$r->created_at</td>
            <td width='13%' align='center'>$r->first_name</td>
            <td align='center'>$r->messages</td>
        </tr>";
    }
    ?>
</table>