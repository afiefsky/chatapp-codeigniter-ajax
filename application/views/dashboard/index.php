<h2>Daftar Kontak</h2>
<br>

<table class="table table-bordered">
  <tr>
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
  </tr>
  <tbody>
    <?php
    $no = 0;
    $logged_status = 0;
    foreach ($record->result() as $r) {
        $no++;

        if ($r->is_logged_in == 1) {
            $logged_status = '<b> > <u>Online</b>';
        } else {
            $logged_status = 'Offline';
        }

        echo "<tr>
          <td>$no</td>
          <td>$r->username</td>
          <td>$logged_status</td>
          <td>". anchor('chat/redirect/'.$this->session->userdata('user_id').'/'.$r->id, 'Chat', ['class' => 'btn btn-primary btn-sm']) ."</td>
        </tr>";
    }
    ?>
  </tbody>
</table>
</p>

<script src="<?php echo base_url(); ?>js/dashboard.js" type="text/javascript"></script>