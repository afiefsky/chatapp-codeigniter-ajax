<h1>Grup Chat</h1>

<table border="1">
  <tr>
    <!-- td 1 -->
    <td>
      <div id="chat_viewport">
  
      </div>
    </td>
    <!-- End of td 1 -->

  </tr>
  <tr>
    <!-- td 1 -->
    <td>
      <div id="chat_input">
        <!-- <input type="text" name="chat_message" id="chat_message" value="" tabindex="1" /> -->
        <input type="text" name="chat_message" id="chat_message" />
        <?php echo anchor('#', 'Enter', array('title' => 'Send this chat message', 'id' => 'submit_message', 'class' => 'btn btn-default btn-sm')); ?>
        <div class="clearer"></div>
      </div>
    </td>
    <!-- end of td 1 -->
  </tr>
</table>

<script type="text/javascript" charset="utf-8" async defer>
  var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold 'our' video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: '',
    // immediately ask for camera access
    autoRequestMedia: true,
    media: {
        <?php
        if ($video == 0) {
            if ($audio == 0) {
                echo "audio: false,
                  video: false";
            } elseif ($audio == 1) {
                echo "audio: true,
                  video: false";
            }
        } elseif ($video == 1) {
            if ($audio == 0) {
                echo "audio: false,
                  video: true";
            } elseif ($audio == 1) {
                echo "audio: true,
                  video: true";
            }
        }
        ?>
    }
  });

  // a peer video has been added
  webrtc.on('videoAdded', function (video, peer) {
      console.log('video added', peer);
      var remotes = document.getElementById('remotesVideos');
      if (remotes) {
          var container = document.createElement('div');
          container.className = 'videoContainer';
          container.id = 'container_' + webrtc.getDomId(peer);
          container.appendChild(video);

          // suppress contextmenu
          video.oncontextmenu = function () { return false; };

          remotes.appendChild(container);
      }
  });

  // a peer video was removed
  webrtc.on('videoRemoved', function (video, peer) {
      console.log('video removed ', peer);
      var remotes = document.getElementById('remotesVideos');
      var el = document.getElementById(peer ? 'container_' + webrtc.getDomId(peer) : 'localScreenContainer');
      if (remotes && el) {
          remotes.removeChild(el);
      }
  });

  // we have to wait until it's ready
  webrtc.on('readyToCall', function () {
    // you can name it anything
    webrtc.joinRoom('<?php echo $chat_data['topic']; ?>');
  });
</script>