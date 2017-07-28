<?php 
    echo form_open('auth/login');
?>
<table>
  <tbody>
    <tr>
      <td>Username</td>
      <td><input type="text" name="username"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="password"></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="submit" value="Submit"></td>
    </tr>
  </tbody>
</table>
<?php
    echo form_close();
?>