<h1>Chatting App</h1>

<div id="chat_viewport">
  
</div>

<div id="chat_input">
  <input type="text" name="chat_message" id="chat_message" value="" tabindex="1" />
  <?php echo anchor('#', 'Say it', array('title' => 'Send this chat message', 'id' => 'submit_message')); ?>
  <div class="clearer"></div>
</div>