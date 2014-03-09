

$(document).ready(function() {

  console.log("Start");
  createStoryJS({
      width: "100%",
      height:  "100%",
      debug: false,
      source:  'welcome.json',
      font:  'compiled/css/themes/font/Bevan-PotanoSans.css',
      start_at_end: false,
      type:       'timeline',
      embed_id:   'timeline-embed',
      js:         'compiled/js/timeline.js',
      start_zoom_adjust:  '2'
  });

  // Navbar scrollTo
  $(".navbar .nav a, [data-scroll='true']").click(function (e) {
    
    var $target = $(this);
    href = $target.attr("href");
    hash = href.substring(href.lastIndexOf('#') + 1);
    hash = "#"+hash;
    $destination = $(hash);
    offset = $(".navbar").height() || 0
    scrollTop = $destination.offset().top - 30;

    $("body,html").animate({scrollTop: scrollTop}, 350);

    return false;
  });

  // More Options
  $(".show-options").click(function (e) {
    $(this).hide();

    $(".more-options").slideDown();

    return false;
  });

  // Preview
  $("#iframe-preview-button").click(function () {
    var $embed = $("#preview");

    $embed.show();
    $("body,html").animate({scrollTop: $embed.offset().top - 60}, 250);
  });


  $('#resize').click(function(){
    $(".myModal").animate({"width":"200px"},600,'linear');
//<a href=\"index.html#timeline-embed\" data-scroll=\"true\" onclick=\"openWindow();\">Link</a>
}
);
  

  // Embed Generator
  updateEmbedCode();
  $("#embed_code").click(function() { $(this).select(); });
  $('#embed-width').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-wordpressplugin').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-font').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-height').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-maptype').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-googlemapkey').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-source-url').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-language').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-startatend').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-hashbookmark').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-startatslide').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-startzoomadjust').change(function(evt) { updateEmbedCode(evt); });
  $('#embed-debug').change(function(evt) { updateEmbedCode(evt); });
});

function goToPage(x){
  timeline.goToPage(x);
}

function openWindow(){
  console.log("Open Window");
  $("#myModal").load("testPage.html");
  $('#myModal').modal('show');
}
