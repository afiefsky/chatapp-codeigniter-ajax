<h1>Chatting App</h1>

<table border="1">
  <tr>
    <!-- td 1 -->
    <td>
      <div id="chat_viewport">
  
      </div>
    </td>
    <!-- End of td 1 -->

    <!-- td 2  -->
    <td rowspan="2">
      <div id="container">
        <video autoplay="true" id="videoElement">

        </video>
      </div>
    </td>
    <!-- End of td 2 -->

  </tr>
  <tr>
    <!-- td 1 -->
    <td>
      <div id="chat_input">
        <input type="text" name="chat_message" id="chat_message" value="" tabindex="1" />
        <?php echo anchor('#', 'Say it', array('title' => 'Send this chat message', 'id' => 'submit_message')); ?>
        <div class="clearer"></div>
      </div>
    </td>
    <!-- end of td 1 -->
  </tr>
</table>