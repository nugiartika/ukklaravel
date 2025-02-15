$(document).ready(function () {
  var styles = `
  .blobinator {
    width: 100%;
    height: 100%;
    position: absolute;
    top:0;
    bottom: 0;
    z-index: -1;
    overflow: hidden;
  }
  .blobinator svg {
    position: absolute;
    width: 300px;
    opacity: 0.6;
  }
  `;
  var styleSheet = document.createElement("style");
  styleSheet.type = "text/css";
  styleSheet.innerText = styles;
  document.head.appendChild(styleSheet);

  var blobs = [
    "M44.2,-71.2C54.3,-62.2,57.5,-45,58.7,-30.3C59.9,-15.7,59,-3.7,60.5,11C61.9,25.7,65.7,43,58.9,51.3C52.1,59.5,34.6,58.8,18.7,63.2C2.9,67.7,-11.3,77.2,-26.2,78C-41.1,78.7,-56.6,70.6,-67.1,58.3C-77.6,45.9,-82.9,29.3,-81.3,14.2C-79.6,-1,-70.9,-14.7,-61.4,-24.9C-51.9,-35.1,-41.5,-41.8,-31.1,-50.7C-20.8,-59.6,-10.4,-70.7,3.3,-75.9C17,-81,34,-80.2,44.2,-71.2Z",
    "M42.1,-69.9C53.3,-66.5,60,-52.6,62.8,-39.1C65.6,-25.7,64.3,-12.9,66.3,1.1C68.3,15.2,73.5,30.3,69.5,41.6C65.5,52.8,52.2,60.2,39.1,68C26,75.8,13,84.1,0.7,82.8C-11.5,81.5,-23.1,70.7,-35.3,62.4C-47.5,54,-60.3,48.2,-70,38.2C-79.7,28.2,-86.1,14.1,-81.4,2.7C-76.8,-8.7,-61.1,-17.5,-50.1,-25.1C-39.1,-32.8,-32.8,-39.4,-25.3,-44.8C-17.7,-50.3,-8.9,-54.5,3.3,-60.3C15.5,-66.1,31,-73.3,42.1,-69.9Z",
    "M42.1,-69.9C53.3,-66.5,60,-52.6,62.8,-39.1C65.6,-25.7,64.3,-12.9,66.3,1.1C68.3,15.2,73.5,30.3,69.5,41.6C65.5,52.8,52.2,60.2,39.1,68C26,75.8,13,84.1,0.7,82.8C-11.5,81.5,-23.1,70.7,-35.3,62.4C-47.5,54,-60.3,48.2,-70,38.2C-79.7,28.2,-86.1,14.1,-81.4,2.7C-76.8,-8.7,-61.1,-17.5,-50.1,-25.1C-39.1,-32.8,-32.8,-39.4,-25.3,-44.8C-17.7,-50.3,-8.9,-54.5,3.3,-60.3C15.5,-66.1,31,-73.3,42.1,-69.9Z",
    "M45.2,18.5C42.9,30,14.7,18.9,2.9,1.9C-9,-15.2,-4.5,-38.1,9.6,-32.5C23.7,-27,47.4,7,45.2,18.5Z",
    "M35,-65.2C42.9,-56.1,45.1,-41.7,53.6,-30C62.2,-18.2,77,-9.1,76.6,-0.2C76.1,8.6,60.4,17.2,53.4,31.5C46.4,45.9,48,65.9,40.5,66.8C33,67.8,16.5,49.7,6.3,38.8C-3.9,27.9,-7.9,24.1,-22,27C-36.2,29.9,-60.6,39.5,-64.9,36.1C-69.2,32.7,-53.5,16.3,-44.8,5C-36.1,-6.3,-34.5,-12.6,-33.7,-22.2C-32.9,-31.8,-33.1,-44.6,-27.6,-55.2C-22.1,-65.7,-11.1,-73.9,1.2,-76C13.6,-78.2,27.1,-74.3,35,-65.2Z",
    "M23.5,-45.1C30.7,-36.6,37,-30.8,46.4,-23.7C55.7,-16.7,68.1,-8.3,71.7,2C75.2,12.4,69.9,24.9,60.7,32.1C51.5,39.4,38.3,41.6,27.6,45.3C16.8,49.1,8.4,54.5,0.9,52.9C-6.5,51.3,-13.1,42.6,-24.1,39C-35.2,35.4,-50.7,36.8,-56.4,31.2C-62,25.5,-57.7,12.8,-60.2,-1.4C-62.6,-15.6,-71.9,-31.2,-66.4,-37.2C-61,-43.2,-40.9,-39.6,-27.3,-44.4C-13.8,-49.2,-6.9,-62.5,0.6,-63.6C8.2,-64.7,16.3,-53.5,23.5,-45.1Z"
  ];

  var svg = `<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="" d="" transform="translate(100 100)"></path>
  </svg>`;

  $(".blobinator").each(function () {
    $(this).parent().css("position", "relative");
    var totalBlobs = $(this).data("total") || 5;
    var colors = $(this).data("color") || "#000";
    colors = colors.split(" ");
    var animationTime = $(this).data("animation-duration") || 15;
    var blobContainer = this;
    var maxWidth = $(blobContainer).width();
    var maxHeight = $(blobContainer).height();
    var usedWidth = maxWidth;
    var minBlobSize = 100;
    var maxBlobSize = 500;

    for (let i = 0; i < totalBlobs; i++) {
      var element = $(svg).clone();
      element
        .find("path")
        .attr("d", blobs[Math.floor(Math.random() * blobs.length)]);
      element
        .find("path")
        .attr("fill", colors[Math.floor(Math.random() * colors.length)]);
      $(blobContainer).append(element);

      var width = usedWidth > 0 && usedWidth < maxBlobSize
        ? Math.floor(Math.random() * (usedWidth - minBlobSize)) + minBlobSize
        : usedWidth <= 0
          ? Math.floor(Math.random() * minBlobSize) + minBlobSize
          : Math.floor(Math.random() * (maxBlobSize - minBlobSize)) + minBlobSize;

      usedWidth = usedWidth - width;
      var positionX = Math.floor(Math.random() * (maxHeight - width));
      var positionY = Math.floor(Math.random() * (maxWidth - width));
      $(element).css({ width: width + "px", top: positionX + "px", left: positionY + "px" });

      move(element, animationTime);
    }
  });

  function move(e, animationTime) {
    var container = $(e).parent();
    var maxWidth = $(container).width();
    var maxHeight = $(container).height();
    var width = $(e).width();
    var positionX = Math.floor(Math.random() * (maxHeight - width));
    var positionY = Math.floor(Math.random() * (maxWidth - width));
    $(e).animate({ top: positionX, left: positionY }, animationTime * 1000, function () {
      requestAnimationFrame(() => move(e, animationTime));
    });
  }
});
