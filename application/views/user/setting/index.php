<?php echo form_open_multipart('user/setting/'. $this->uri->segment(3)); ?>
<table class="table table-bordered">
    <thead>
        <tr class="bg-primary">
            <th colspan="2">Pengaturan Identitas Diri</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nama Depan</td>
            <td><input type="text" name="first_name" value="<?php echo $record['first_name']; ?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Nama Belakang</td>
            <td><input type="text" name="last_name" value="<?php echo $record['last_name']; ?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $record['email']; ?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" value="<?php echo $record['username']; ?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <input type="text" name="password" value="<?php echo $record['password']; ?>" class="form-control" required>
            </td>
        </tr>
        <tr>
            <td>
                Foto
            </td>
            <td>
            <?php
                if ($photo == 1) {
                    echo '<input type="file" name="userfile">';
                } else {
                    echo '<input type="submit" name="submit_request_photo" value="Ganti">';
                }
            ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm">
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close(); ?>