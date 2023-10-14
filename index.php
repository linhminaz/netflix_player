<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Demo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!--  Fullscreen Video CSS -->
<style>
  #player {
    position: absolute;
    width: 100% !important;
    height: 100% !important;
  }
</style>

<!-- Player -->
<div id="player"></div>
<!-- partial -->
  <script src='https://cdn.jsdelivr.net/gh/linhminaz/jwplayer@main/jw.8.29.0.js'></script>

  <script>
      const playerInstance = jwplayer("player").setup({
  controls: true,
  sharing: false,
  primary: "hlsjs",
    preload: true,
  displaytitle: false,
  displaydescription: false,
  abouttext: "PhimMoi.Net",
  aboutlink: "",
  hlsjsConfig: {
          debug: false,
          maxBufferSize: 0,
          maxBufferLength: 60,
          liveSyncDurationCount: 40,
          p2pConfig: {
            live: true,
            announceLocation: "vn",
          },
        },

  skin: {
    name: "netflix"
  },

  logo: {
    file: "",
    link: ""
  },

  captions: {
    color: "#FFF",
    fontSize: 14,
    backgroundOpacity: 0,
    edgeStyle: "raised"
  },

  playlist: [
    {
      title: "",
      description: "",
      image: "https://i.ytimg.com/vi/_cMxraX_5RE/maxresdefault.jpg",
      sources: [
        {
          file: "https://uphtml.hhninja.top/hls/dFRENFJiZ1k3NUdibDZHNU5Vd0d1dz09/play",
          label: "1080p",
          type: "hls"
          
        },
        
      ],
      captions: [],
      tracks: []
    }
  ],
  advertising: {
    client: "vast",
    schedule: [
      {
        offset: "pre",
        tag: ""
      }
    ]
  }
});

playerInstance.on("ready", function () {
  const buttonId = "download-video-button";
  const iconPath =
    "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0Ij48cGF0aCBmaWxsPSJub25lIiBkPSJNMCAwaDI0djI0SDB6Ii8+PHBhdGggZD0iTTMgMTloMTh2Mkgzdi0yem0xMC01LjgyOEwxOS4wNzEgNy4xbDEuNDE0IDEuNDE0TDEyIDE3IDMuNTE1IDguNTE1IDQuOTI5IDcuMSAxMSAxMy4xN1YyaDJ2MTEuMTcyeiIgZmlsbD0icmdiYSgyNDcsMjQ3LDI0NywxKSIvPjwvc3ZnPg==";
  const tooltipText = "Download Video";

  // Call the player's `addButton` API method to add the custom button
  playerInstance.addButton(iconPath, tooltipText, buttonClickAction, buttonId);

  // This function is executed when the button is clicked
  function buttonClickAction() {
    const playlistItem = playerInstance.getPlaylistItem();
    const anchor = document.createElement("a");
    const fileUrl = playlistItem.file;
    anchor.setAttribute("href", fileUrl);
    const downloadName = playlistItem.file.split("/").pop();
    anchor.setAttribute("download", downloadName);
    anchor.style.display = "none";
    document.body.appendChild(anchor);
    anchor.click();
    document.body.removeChild(anchor);
  }

  // Move the timeslider in-line with other controls
   const playerContainer = playerInstance.getContainer();
  const buttonContainer = playerContainer.querySelector(".jw-button-container");
  const spacer = buttonContainer.querySelector(".jw-spacer");
  const timeSlider = playerContainer.querySelector(".jw-slider-time");

  // Forward 10 seconds
  const rewindContainer = playerContainer.querySelector(
    ".jw-display-icon-rewind"
  );
  const forwardContainer = rewindContainer.cloneNode(true);
  const forwardDisplayButton = forwardContainer.querySelector(
    ".jw-icon-rewind"
  );
  forwardDisplayButton.style.transform = "scaleX(-1)";
  forwardDisplayButton.ariaLabel = "Forward 10 Seconds";
  const nextContainer = playerContainer.querySelector(".jw-display-icon-next");
  nextContainer.parentNode.insertBefore(forwardContainer, nextContainer);

  // control bar icon
  playerContainer.querySelector(".jw-display-icon-next").style.display = "none"; // hide next button
  const rewindControlBarButton = buttonContainer.querySelector(
    ".jw-icon-rewind"
  );
  const forwardControlBarButton = rewindControlBarButton.cloneNode(true);
  forwardControlBarButton.style.transform = "scaleX(-1)";
  forwardControlBarButton.ariaLabel = "Forward 10 Seconds";
  rewindControlBarButton.parentNode.insertBefore(
    forwardControlBarButton,
    rewindControlBarButton.nextElementSibling
  );

  // add onclick handlers
  [forwardDisplayButton, forwardControlBarButton].forEach((button) => {
    button.onclick = () => {
      playerInstance.seek(playerInstance.getPosition() + 10);
    };
  });
});
  </script>

</body>
</html>
