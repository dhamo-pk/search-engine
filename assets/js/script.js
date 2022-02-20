$(document).ready(function () {
  $(".result").on("click", function () {
   
    var id = $(this).attr("data-linkid"); 
   var url = $(this).attr("href");
    

    if (!id) {
      alert("data-linkid not found");
    }

    increaseLinkClicks(id, url);

    return false;
  });

    var grid =$(".imageResults");
    grid.masonry({
        itemSelector: ".gridItem",
        columnWidth: 200,
        gutter: 5,
        // TransitionDuration: 0
        isInitLayout: false
    });

});

function loadImage(src) {
    var image = $("<img>");
    image.on("load", function () {
        

    })

    image.on("error", function () {
        

    })

    image.attr("src", src);

}

function increaseLinkClicks(linkid, url) {
   $.post("ajax/updateLinkCount.php", { linkid: linkid })
    .done(function (result) {
    console.log(result);
    if (result != "") {
      alert(result);
      return;
    }
    window.location.href = url;
  });
}
