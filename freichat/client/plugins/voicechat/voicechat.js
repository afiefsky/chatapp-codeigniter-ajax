
FreiChat.open_voicechat = function(user, id)
{
    FreiChat.toid = id;
    FreiChat.touser = user;

    var left = (screen.width - 450) / 2;
    var top = (screen.height - 250) / 2;

    FreiChat.is_chatroom = (FreiChat.in_room === id);

    window.open(freidefines.GEN.url + "client/plugins/voicechat/voicechat.php", 'voiceWindow', 'width=450,height=250,top=' + top + ',left=' + left);
};

/*  The MAIL plugin !*/
